@extends('adminlte::page')

@section('title', 'Dettagli Diocesi')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Diocesi</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $diocese->name }}</dd>
                    <dt class="col-sm-3">Paese</dt>
                    <dd class="col-sm-9">{{ $diocese->country ?? '-' }}</dd>
                    <dt class="col-sm-3">Regione</dt>
                    <dd class="col-sm-9">{{ $diocese->region ?? '-' }}</dd>
                    <dt class="col-sm-3">Città</dt>
                    <dd class="col-sm-9">{{ $diocese->city ?? '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('dioceses.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection