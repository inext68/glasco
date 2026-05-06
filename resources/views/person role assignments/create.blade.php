@extends('adminlte::page')

@section('title', 'Nuova Assegnazione Ruolo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('person-role-assignments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach(\App\Models\Person::all() as $person)
                            <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach(\App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="App\Models\Association">Associazione</option>
                            <option value="App\Models\Group">Gruppo</option>
                            <option value="App\Models\Diocese">Diocesi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">ID Entità</label>
                        <input type="number" name="entity_id" id="entity_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data Fine</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('person-role-assignments.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection