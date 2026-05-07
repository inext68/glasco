<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Association;
use App\Models\Group;
use App\Models\Role;
use App\Models\SystemRole;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $models = [
        'person' => Person::class,
        'association' => Association::class,
        'group' => Group::class,
        'diocese' => \App\Models\Diocese::class,
    ];

    protected $fields = [
        'person' => [
            'first_name' => 'Nome',
            'last_name' => 'Cognome',
            'birth_date' => 'Data nascita',
            'gender' => 'Genere',
            'notes' => 'Note',
            'primary_contact' => 'Contatto principale',
            'updated_by_person_id' => 'Ultimo aggiornamento',
        ],
        'association' => [
            'name' => 'Nome',
            'description' => 'Descrizione',
            'fiscal_code' => 'Codice fiscale',
            'vat_number' => 'Partita IVA',
            'diocese_id' => 'Diocesi',
        ],
        'group' => [
            'name' => 'Nome',
            'description' => 'Descrizione',
            'diocese_id' => 'Diocesi',
            'meeting_place' => 'Luogo ritrovo',
            'meeting_day' => 'Giorno ritrovo',
            'meeting_time' => 'Ora ritrovo',
            'responsible_id' => 'Responsabile',
        ],
    ];

    protected $relations = [
        'person' => [
            'contacts' => 'Contatti',
            'associations' => 'Associazioni',
            'groups' => 'Gruppi',
            'media' => 'Media',
            'roles' => 'Ruoli',
        ],
        'association' => [
            'persons' => 'Persone',
            'groups' => 'Gruppi',
            'diocese' => 'Diocesi',
            'media' => 'Media',
        ],
        'group' => [
            'persons' => 'Persone',
            'associations' => 'Associazioni',
            'diocese' => 'Diocesi',
            'responsible' => 'Responsabile',
            'media' => 'Media',
        ],
    ];

    protected $filters = [
        'person' => [
            'role_id' => 'Ruolo assegnato',
            'system_role_id' => 'Ruolo sistema',
            'association_id' => 'Associazione',
            'group_id' => 'Gruppo',
        ],
        'association' => [
            'diocese_id' => 'Diocesi',
        ],
        'group' => [
            'diocese_id' => 'Diocesi',
            'responsible_id' => 'Responsabile',
        ],
    ];

    public function index()
    {
        return view('reports.index');
    }

    public function create(Request $request)
    {
        $modelType = $request->query('model', 'person');
        return view('reports.create', [
            'modelType' => $modelType,
            'fields' => $this->fields[$modelType] ?? [],
            'relations' => $this->relations[$modelType] ?? [],
            'filters' => $this->filters[$modelType] ?? [],
            'models' => array_keys($this->models),
            'roles' => Role::all(),
            'systemRoles' => SystemRole::all(),
            'dioceses' => \App\Models\Diocese::all(),
            'associations' => Association::all(),
            'groups' => Group::all(),
        ]);
    }

    public function generate(Request $request)
    {
        $modelType = $request->input('model', 'person');
        $selectedFields = $request->input('fields', []);
        $selectedRelations = $request->input('relations', []);
        $selectedFilters = $request->input('filters', []);

        $modelClass = $this->models[$modelType];
        $query = $modelClass::query();

        if (in_array('contacts', $selectedRelations) || in_array('primary_contact', $selectedFields)) {
            $query->with('contacts');
        }

        if (in_array('associations', $selectedRelations)) {
            $query->with('associations');
        }

        if (in_array('groups', $selectedRelations)) {
            $query->with('groups');
        }

        if (in_array('diocese', $selectedRelations)) {
            $query->with('diocese');
        }

        if (in_array('responsible', $selectedRelations)) {
            $query->with('responsible');
        }

        if (in_array('roles', $selectedRelations) || $modelType === 'person') {
            $query->with('personRoleAssignments.role');
        }

        if (in_array('media', $selectedRelations)) {
            $query->with('media');
        }

        $selectedFilters = array_filter($selectedFilters);
        if (!empty($selectedFilters['role_id'])) {
            $query->whereHas('personRoleAssignments', function ($q) use ($selectedFilters) {
                $q->where('role_id', $selectedFilters['role_id']);
            });
        }

        if (!empty($selectedFilters['system_role_id'])) {
            $query->whereHas('personSystemRoles', function ($q) use ($selectedFilters) {
                $q->where('system_role_id', $selectedFilters['system_role_id']);
            });
        }

        if (!empty($selectedFilters['association_id'])) {
            $query->whereHas('associations', function ($q) use ($selectedFilters) {
                $q->where('associations.id', $selectedFilters['association_id']);
            });
        }

        if (!empty($selectedFilters['group_id'])) {
            $query->whereHas('groups', function ($q) use ($selectedFilters) {
                $q->where('groups.id', $selectedFilters['group_id']);
            });
        }

        if (!empty($selectedFilters['diocese_id'])) {
            $query->where('diocese_id', $selectedFilters['diocese_id']);
        }

        if (!empty($selectedFilters['responsible_id'])) {
            $query->where('responsible_id', $selectedFilters['responsible_id']);
        }

        $items = $query->get();

        return view('reports.generate', [
            'items' => $items,
            'modelType' => $modelType,
            'selectedFields' => $selectedFields,
            'selectedRelations' => $selectedRelations,
            'fieldLabels' => $this->fields[$modelType],
            'relationLabels' => $this->relations[$modelType] ?? [],
        ]);
    }
}