@extends('adminlte::page')

@section('title', 'Dettagli Persona')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Persona</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Codice Identificativo</dt>
                    <dd class="col-sm-9">{{ $person->unique_code }}</dd>
                    
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $person->first_name }}</dd>
                    
                    <dt class="col-sm-3">Cognome</dt>
                    <dd class="col-sm-9">{{ $person->last_name }}</dd>
                    
                    <dt class="col-sm-3">Data di Nascita</dt>
                    <dd class="col-sm-9">{{ $person->birth_date ? $person->birth_date->format('d/m/Y') : '-' }}</dd>
                    
                    <dt class="col-sm-3">Genere</dt>
                    <dd class="col-sm-9">{{ $person->gender ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Note</dt>
                    <dd class="col-sm-9">{{ $person->notes ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Via</dt>
                    <dd class="col-sm-9">{{ $person->street ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">CAP</dt>
                    <dd class="col-sm-9">{{ $person->postal_code ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Città</dt>
                    <dd class="col-sm-9">{{ $person->city ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Provincia</dt>
                    <dd class="col-sm-9">{{ $person->province ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Tipo Documento</dt>
                    <dd class="col-sm-9">{{ $person->document_type ?? '-' }}</dd>
                    
                    <dt class="col-sm-3">Numero Documento</dt>
                    <dd class="col-sm-9">{{ $person->document_number ?? '-' }}</dd>
                </dl>
                
                <h4 class="mt-4">Contatti</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Etichetta</th>
                            <th>Valore</th>
                            <th>Primario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($person->contacts as $contact)
                        <tr>
                            <td>{{ $contact->type }}</td>
                            <td>{{ $contact->label }}</td>
                            <td>{{ $contact->value }}</td>
                            <td>{{ $contact->is_primary ? 'Sì' : 'No' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Nessun contatto</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <h4 class="mt-4">Gruppi collegati</h4>
                <table class="table table-bordered table-hover" id="groups_table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Diocesi</th>
                            <th>Giorno ritrovo</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($person->groups as $group)
                        <tr id="group-row-{{ $group->id }}">
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->diocese->name ?? '-' }}</td>
                            <td>{{ $group->meeting_day ?? '-' }}</td>
                            <td>
                                <a href="{{ route('groups.show', $group->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <button type="button" class="btn btn-sm btn-danger remove_group" data-id="{{ $group->id }}">Rimuovi</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Nessun gruppo collegato</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <h4 class="mt-4">Ruoli</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Ruolo</th>
                            <th>Entità</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($person->personRoleAssignments as $assignment)
                        <tr>
                            <td>{{ $assignment->role->name ?? '-' }}</td>
                            <td>{{ $assignment->entity_type ?? '-' }}</td>
                            <td>{{ $assignment->start_date ? $assignment->start_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $assignment->end_date ? $assignment->end_date->format('d/m/Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Nessun ruolo assegnato</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('persons.edit', $person->id) }}" class="btn btn-primary">Modifica</a>
                <a href="{{ route('persons.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const personId = {{ $person->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.remove_group').forEach(btn => {
        const groupId = btn.dataset.id;
        btn.addEventListener('click', async function() {
            if (!confirm('Sei sicuro di voler rimuovere questa persona dal gruppo?')) return;
            
            try {
                const response = await fetch(`/groups/${groupId}/persons/${personId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const row = document.getElementById(`group-row-${groupId}`);
                    if (row) row.remove();
                    
                    const tbody = document.querySelector('#groups_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nessun gruppo collegato</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione');
            }
        });
    });
});
</script>
@endsection
