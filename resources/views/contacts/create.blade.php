@extends('adminlte::page')

@section('title', 'Nuovo Contatto')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Contatto</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('contacts.store') }}" method="POST">
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
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="email">Email</option>
                            <option value="phone">Telefono</option>
                            <option value="address">Indirizzo</option>
                            <option value="website">Sito Web</option>
                            <option value="other">Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label">Etichetta</label>
                        <input type="text" name="label" id="label" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="value">Valore</label>
                        <input type="text" name="value" id="value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1">
                            <label for="is_primary" class="form-check-label">Contatto primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection