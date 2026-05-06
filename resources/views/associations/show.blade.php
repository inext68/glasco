@extends('adminlte::page')

@section('title', 'Dettagli Associazione')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Associazione</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $association->name }}</dd>
                    <dt class="col-sm-3">Nazione</dt>
                    <dd class="col-sm-9">{{ $association->nation ?? '-' }}</dd>
                    <dt class="col-sm-3">Indirizzo</dt>
                    <dd class="col-sm-9">{{ $association->address ?? '-' }}</dd>
                    <dt class="col-sm-3">Tipo</dt>
                    <dd class="col-sm-9">{{ $association->type ?? '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('associations.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection