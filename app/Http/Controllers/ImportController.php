<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Association;
use App\Models\Group;
use App\Models\Diocese;
use App\Models\Contact;
use App\Models\PersonRoleAssignment;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    protected $importers = [
        'persons' => [
            'model' => Person::class,
            'fields' => ['first_name', 'last_name', 'birth_date', 'gender', 'notes'],
            'required' => ['first_name', 'last_name'],
        ],
        'contacts' => [
            'model' => Contact::class,
            'fields' => ['person_id', 'type', 'label', 'value', 'is_primary'],
            'required' => ['person_id', 'type', 'value'],
            'foreign_key' => 'person_id',
        ],
        'associations' => [
            'model' => Association::class,
            'fields' => ['name', 'description', 'nation', 'address', 'type', 'diocese_id'],
            'required' => ['name'],
        ],
        'groups' => [
            'model' => Group::class,
            'fields' => ['name', 'description', 'diocese_id', 'meeting_place', 'meeting_day', 'meeting_time', 'responsible_id'],
            'required' => ['name'],
        ],
        'dioceses' => [
            'model' => Diocese::class,
            'fields' => ['name', 'country', 'region', 'city'],
            'required' => ['name'],
        ],
        'role_assignments' => [
            'model' => PersonRoleAssignment::class,
            'fields' => ['person_id', 'role_id', 'entity_id', 'entity_type', 'start_date', 'end_date'],
            'required' => ['person_id', 'role_id'],
        ],
    ];

    public function index()
    {
        return view('import.index', [
            'importers' => array_keys($this->importers),
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys($this->importers)),
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $type = $request->input('type');
        $importer = $this->importers[$type];
        $file = $request->file('file');

        $handle = fopen($file->getRealPath(), 'r');
        $headers = fgetcsv($handle, 1000, ',');

        if ($headers === false) {
            return back()->with('error', 'File CSV non valido');
        }

        $headers = array_map('trim', $headers);
        $headers = array_map([$this, 'normalizeHeader'], $headers);
        
        $rowCount = 0;
        $errorCount = 0;
        $errors = [];

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data = [];
            foreach ($headers as $index => $header) {
                if (isset($row[$index])) {
                    $data[$header] = trim($row[$index]);
                }
            }

            try {
                $this->importRow($type, $data);
                $rowCount++;
            } catch (\Exception $e) {
                $errorCount++;
                $errors[] = "Riga {$rowCount}: " . $e->getMessage();
            }
        }

        fclose($handle);

        if ($errorCount > 0) {
            return back()->with('error', "Importati {$rowCount} record, {$errorCount} errori.")
                ->with('errors', $errors);
        }

        return back()->with('success', "Importati {$rowCount} record con successo");
    }

    protected function normalizeHeader($header)
    {
        $header = strtolower($header);
        $header = str_replace([' ', '-', '__'], '_', $header);
        $header = preg_replace('/_+$/', '', $header);
        
        $map = [
            'cognome' => 'last_name',
            'nome' => 'first_name',
            'datanascita' => 'birth_date',
            'datanascita' => 'birth_date',
            'sesso' => 'gender',
            'genere' => 'gender',
            'note' => 'notes',
            'descrizione' => 'description',
            'nazione' => 'nation',
            'indirizzo' => 'address',
            'tipo' => 'type',
            'diocesi' => 'diocese_id',
            'luogoritrovo' => 'meeting_place',
            'giornoritrovo' => 'meeting_day',
            'oraritrovo' => 'meeting_time',
            'responsabile' => 'responsible_id',
            'regione' => 'region',
            'citta' => 'city',
            'paese' => 'country',
            'persona' => 'person_id',
            'ruolo' => 'role_id',
            'entita' => 'entity_id',
            'datainizio' => 'start_date',
            'datafine' => 'end_date',
            'etichetta' => 'label',
            'valore' => 'value',
            'primario' => 'is_primary',
        ];

        return $map[$header] ?? $header;
    }

    protected function importRow($type, $data)
    {
        $importer = $this->importers[$type];
        $model = $importer['model'];

        foreach ($importer['required'] as $field) {
            if (empty($data[$field])) {
                throw new \Exception("Campo richiesto mancante: {$field}");
            }
        }

        $data = $this->transformData($type, $data);

        if ($type === 'contacts') {
            $person = Person::find($data['person_id']);
            if (!$person) {
                throw new \Exception("Persona non trovata ID: {$data['person_id']}");
            }
            unset($data['person_id']);
            return $person->contacts()->create($data);
        }

        if ($type === 'role_assignments') {
            if (!empty($data['entity_type'])) {
                $map = [
                    'association' => 'App\Models\Association',
                    'group' => 'App\Models\Group',
                    'diocese' => 'App\Models\Diocese',
                ];
                $data['entity_type'] = $map[$data['entity_type']] ?? $data['entity_type'];
            } else {
                unset($data['entity_id']);
                unset($data['entity_type']);
            }
        }

        return $model::create($data);
    }

    protected function transformData($type, $data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
                continue;
            }

            if (in_array($key, ['birth_date', 'start_date', 'end_date'])) {
                try {
                    $data[$key] = \Carbon\Carbon::parse($value)->format('Y-m-d');
                } catch (\Exception $e) {
                    unset($data[$key]);
                }
            }

            if ($key === 'is_primary') {
                $data[$key] = in_array(strtolower($value), ['1', 'yes', 'true', 'si', 'primario']);
            }

            if ($key === 'gender') {
                $data[$key] = strtoupper($value[0] ?? '');
            }
        }

        if ($type === 'groups' && !empty($data['diocese_id'])) {
            $diocese = Diocese::where('name', 'like', '%' . $data['diocese_id'] . '%')->first();
            if ($diocese) {
                $data['diocese_id'] = $diocese->id;
            } else {
                unset($data['diocese_id']);
            }
        }

        if ($type === 'groups' && !empty($data['responsible_id'])) {
            $parts = explode(' ', $data['responsible_id']);
            $lastName = $parts[0] ?? '';
            $firstName = $parts[1] ?? '';
            $person = Person::where('last_name', 'like', '%' . $lastName . '%')
                ->when($firstName, fn($q) => $q->where('first_name', 'like', '%' . $firstName . '%'))
                ->first();
            if ($person) {
                $data['responsible_id'] = $person->id;
            } else {
                unset($data['responsible_id']);
            }
        }

        return $data;
    }

    public function download(Request $request)
    {
        $type = $request->query('type');
        
        if (!isset($this->importers[$type])) {
            return response()->json(['error' => 'Tipo non valido'], 400);
        }

        $importer = $this->importers[$type];
        $headers = $importer['fields'];

        $callback = function() use ($headers) {
            echo implode(',', $headers) . "\n";
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$type}_template.csv",
        ]);
    }
}