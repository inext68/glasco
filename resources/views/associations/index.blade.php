@extends('adminlte::page')

@section('title', 'Associazioni')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Associazioni</h3>
                <a href="{{ route('associations.create') }}" class="btn btn-primary float-right">Nuova Associazione</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Nazione</th>
                            <th>Tipo</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($associations as $association)
                        <tr>
                            <td>{{ $association->name }}</td>
                            <td>{{ $association->nation ?? '-' }}</td>
                            <td>{{ $association->type ?? '-' }}</td>
                            <td>
                                <a href="{{ route('associations.show', $association->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('associations.edit', $association->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('associations.destroy', $association->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $associations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection