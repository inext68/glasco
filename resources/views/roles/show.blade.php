@extends('adminlte::page')

@section('title', 'Dettagli Ruolo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Ruolo</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $role->name }}</dd>
                    <dt class="col-sm-3">Contesto</dt>
                    <dd class="col-sm-9">{{ $role->context ?? '-' }}</dd>
                    <dt class="col-sm-3">Descrizione</dt>
                    <dd class="col-sm-9">{{ $role->description ?? '-' }}</dd>
                    <dt class="col-sm-3">Primario</dt>
                    <dd class="col-sm-9">{{ $role->is_primary ? 'Sì' : 'No' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection