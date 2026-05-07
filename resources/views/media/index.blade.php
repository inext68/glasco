@extends('adminlte::page')

@section('title', 'Media')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Media</h3>
                <a href="{{ route('media.create') }}" class="btn btn-primary float-right">Nuovo Media</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Anteprima</th>
                            <th>Nome File</th>
                            <th>Tipo MIME</th>
                            <th>Entità</th>
                            <th>Caricato da</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($media as $medium)
                        <tr>
                            <td class="text-center" style="width: 100px;">
                                @if($medium->isImage())
                                <img src="{{ $medium->thumbnailUrl() ?? $medium->url() }}" alt="preview" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                @elseif($medium->isPdf())
                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                @else
                                <i class="fas fa-file fa-2x text-muted"></i>
                                @endif
                            </td>
                            <td>{{ $medium->file_name }}</td>
                            <td>{{ $medium->mime_type ?? '-' }}</td>
                            <td>{{ $medium->mediaable_type ?? '-' }}</td>
                            <td>{{ $medium->uploadedBy->surname ?? '' }} {{ $medium->uploadedBy->name ?? '-' }}</td>
                            <td>
                                <a href="{{ $medium->url() }}" target="_blank" class="btn btn-sm btn-info">Apri</a>
                                <a href="{{ route('media.show', $medium->id) }}" class="btn btn-sm btn-secondary">Dettagli</a>
                                <form action="{{ route('media.destroy', $medium->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $media->links() }}
            </div>
        </div>
    </div>
</div>
@endsection