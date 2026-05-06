@extends('adminlte::page')

@section('title', 'Modifica Persona')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Persona</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('persons.update', $person->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="first_name">Nome</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $person->first_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Cognome</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $person->last_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Data di Nascita</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $person->birth_date ? $person->birth_date->format('Y-m-d') : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Genere</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="M" {{ $person->gender == 'M' ? 'selected' : '' }}>Maschio</option>
                            <option value="F" {{ $person->gender == 'F' ? 'selected' : '' }}>Femmina</option>
                            <option value="Altro" {{ $person->gender == 'Altro' ? 'selected' : '' }}>Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Note</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ $person->notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('persons.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection