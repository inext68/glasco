@extends('adminlte::page')

@section('title', 'Modifica Assegnazione Ruolo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('person-role-assignments.update', $personRoleAssignment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            @foreach(\App\Models\Person::all() as $person)
                            <option value="{{ $person->id }}" {{ $personRoleAssignment->person_id == $person->id ? 'selected' : '' }}>{{ $person->first_name }} {{ $person->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            @foreach(\App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}" {{ $personRoleAssignment->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="App\Models\Association" {{ $personRoleAssignment->entity_type == 'App\Models\Association' ? 'selected' : '' }}>Associazione</option>
                            <option value="App\Models\Group" {{ $personRoleAssignment->entity_type == 'App\Models\Group' ? 'selected' : '' }}>Gruppo</option>
                            <option value="App\Models\Diocese" {{ $personRoleAssignment->entity_type == 'App\Models\Diocese' ? 'selected' : '' }}>Diocesi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">ID Entità</label>
                        <input type="number" name="entity_id" id="entity_id" class="form-control" value="{{ $personRoleAssignment->entity_id }}">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $personRoleAssignment->start_date ? $personRoleAssignment->start_date->format('Y-m-d') : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data Fine</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $personRoleAssignment->end_date ? $personRoleAssignment->end_date->format('Y-m-d') : '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('person-role-assignments.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection