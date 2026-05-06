@extends('adminlte::page')

@section('title', 'Dettagli Contatto')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Contatto</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Persona</dt>
                    <dd class="col-sm-9">{{ $contact->person->first_name ?? '-' }} {{ $contact->person->last_name ?? '' }}</dd>
                    <dt class="col-sm-3">Tipo</dt>
                    <dd class="col-sm-9">{{ $contact->type }}</dd>
                    <dt class="col-sm-3">Etichetta</dt>
                    <dd class="col-sm-9">{{ $contact->label ?? '-' }}</dd>
                    <dt class="col-sm-3">Valore</dt>
                    <dd class="col-sm-9">
                        @if($contact->type === 'phone')
                            <a href="tel:{{ $contact->value }}">{{ $contact->value }}</a>
                        @elseif($contact->type === 'email')
                            <a href="mailto:{{ $contact->value }}">{{ $contact->value }}</a>
                        @elseif(preg_match('/^(https?:\/\/|ftp:\/\/|whatsapp:|telegram:|tel:|mailto:)/i', $contact->value))
                            <a href="{{ $contact->value }}" target="_blank" rel="noopener">{{ $contact->value }}</a>
                        @else
                            {{ $contact->value }}
                        @endif
                    </dd>
                    <dt class="col-sm-3">Primario</dt>
                    <dd class="col-sm-9">{{ $contact->is_primary ? 'Sì' : 'No' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection