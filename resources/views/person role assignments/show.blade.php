@extends('adminlte::page')

@section('title', 'Dettagli Assegnazione Ruolo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Persona</dt>
                    <dd class="col-sm-9">{{ $personRoleAssignment->person->last_name ?? '' }} {{ $personRoleAssignment->person->first_name ?? '-' }}</dd>
                    <dt class="col-sm-3">Ruolo</dt>
                    <dd class="col-sm-9">{{ $personRoleAssignment->role->name ?? '-' }}</dd>
                    <dt class="col-sm-3">Entità</dt>
                    <dd class="col-sm-9">
                        @if($personRoleAssignment->entity)
                            {{ $personRoleAssignment->entity->name }}
                        @else
                            -
                        @endif
                    </dd>
                    <dt class="col-sm-3">Data Inizio</dt>
                    <dd class="col-sm-9">{{ $personRoleAssignment->start_date ? $personRoleAssignment->start_date->format('d/m/Y') : '-' }}</dd>
                    <dt class="col-sm-3">Data Fine</dt>
                    <dd class="col-sm-9">{{ $personRoleAssignment->end_date ? $personRoleAssignment->end_date->format('d/m/Y') : '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('person-role-assignments.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection