@extends('adminlte::page')

@section('title', 'Diocesi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Diocesi</h3>
                <a href="{{ route('dioceses.create') }}" class="btn btn-primary float-right">Nuova Diocesi</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Paese</th>
                            <th>Regione</th>
                            <th>Città</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dioceses as $diocese)
                        <tr>
                            <td>{{ $diocese->name }}</td>
                            <td>{{ $diocese->country ?? '-' }}</td>
                            <td>{{ $diocese->region ?? '-' }}</td>
                            <td>{{ $diocese->city ?? '-' }}</td>
                            <td>
                                <a href="{{ route('dioceses.show', $diocese->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('dioceses.edit', $diocese->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('dioceses.destroy', $diocese->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $dioceses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection