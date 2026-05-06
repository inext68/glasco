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
                            <th>Tipo</th>
                            <th>Nome File</th>
                            <th>Url</th>
                            <th>Entità</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($media as $medium)
                        <tr>
                            <td>{{ $medium->type }}</td>
                            <td>{{ $medium->filename }}</td>
                            <td>{{ $medium->url }}</td>
                            <td>{{ $medium->mediaable_type ?? '-' }}</td>
                            <td>
                                <a href="{{ route('media.show', $medium->id) }}" class="btn btn-sm btn-info">Visualizza</a>
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