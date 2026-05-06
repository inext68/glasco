@extends('adminlte::page')

@section('title', 'Modifica Ruolo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="context">Contesto</label>
                        <input type="text" name="context" id="context" class="form-control" value="{{ $role->context }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $role->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1" {{ $role->is_primary ? 'checked' : '' }}>
                            <label for="is_primary" class="form-check-label">Ruolo primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection