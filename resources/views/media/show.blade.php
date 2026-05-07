@extends('adminlte::page')

@section('title', 'Dettagli Media')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Media</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nome File</dt>
                    <dd class="col-sm-8">{{ $media->file_name }}</dd>
                    <dt class="col-sm-4">Tipo MIME</dt>
                    <dd class="col-sm-8">{{ $media->mime_type ?? '-' }}</dd>
                    <dt class="col-sm-4">Hash</dt>
                    <dd class="col-sm-8"><small class="text-muted">{{ $media->file_hash }}</small></dd>
                    <dt class="col-sm-4">Caricato da</dt>
                    <dd class="col-sm-8">{{ $media->uploadedBy->surname ?? '' }} {{ $media->uploadedBy->name ?? '-' }}</dd>
                    <dt class="col-sm-4">Entità</dt>
                    <dd class="col-sm-8">{{ $media->mediaable_type ?? '-' }}</dd>
                </dl>
                <hr>
                @if($media->isImage())
                <div class="text-center">
                    <img src="{{ $media->url() }}" alt="{{ $media->file_name }}" class="img-fluid" style="max-width: 100%;">
                </div>
                @elseif($media->isPdf())
                <div class="text-center">
                    <a href="{{ $media->url() }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> Apri PDF
                    </a>
                </div>
                @else
                <div class="text-center">
                    <a href="{{ $media->url() }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download"></i> Scarica File
                    </a>
                </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('media.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection