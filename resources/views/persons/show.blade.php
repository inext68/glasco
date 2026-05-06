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
                <a href="{{ route('persons.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection