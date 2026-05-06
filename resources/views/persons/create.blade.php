@extends('adminlte::page')

@section('title', 'Nuova Persona')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Persona</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('persons.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Nome</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Cognome</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Data di Nascita</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender">Genere</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="M">Maschio</option>
                            <option value="F">Femmina</option>
                            <option value="Altro">Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Note</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('persons.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection