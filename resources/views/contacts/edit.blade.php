@extends('adminlte::page')

@section('title', 'Modifica Contatto')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Contatto</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            @foreach(\App\Models\Person::all() as $person)
                            <option value="{{ $person->id }}" {{ $contact->person_id == $person->id ? 'selected' : '' }}>{{ $person->first_name }} {{ $person->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="phone" {{ $contact->type == 'phone' ? 'selected' : '' }}>Telefono</option>
                            <option value="address" {{ $contact->type == 'address' ? 'selected' : '' }}>Indirizzo</option>
                            <option value="website" {{ $contact->type == 'website' ? 'selected' : '' }}>Sito Web</option>
                            <option value="other" {{ $contact->type == 'other' ? 'selected' : '' }}>Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label">Etichetta</label>
                        <input type="text" name="label" id="label" class="form-control" value="{{ $contact->label }}">
                    </div>
                    <div class="form-group">
                        <label for="value">Valore</label>
                        <input type="text" name="value" id="value" class="form-control" value="{{ $contact->value }}" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1" {{ $contact->is_primary ? 'checked' : '' }}>
                            <label for="is_primary" class="form-check-label">Contatto primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection