@extends('adminlte::page')

@section('title', 'Modifica Diocesi')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Diocesi</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('dioceses.update', $diocese->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $diocese->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Paese</label>
                        <input type="text" name="country" id="country" class="form-control" value="{{ $diocese->country }}">
                    </div>
                    <div class="form-group">
                        <label for="region">Regione</label>
                        <input type="text" name="region" id="region" class="form-control" value="{{ $diocese->region }}">
                    </div>
                    <div class="form-group">
                        <label for="city">Città</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $diocese->city }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('dioceses.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection