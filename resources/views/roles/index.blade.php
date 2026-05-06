@extends('adminlte::page')

@section('title', 'Ruoli')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ruoli</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-primary float-right">Nuovo Ruolo</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Contesto</th>
                            <th>Descrizione</th>
                            <th>Primario</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->context ?? '-' }}</td>
                            <td>{{ $role->description ?? '-' }}</td>
                            <td>{{ $role->is_primary ? 'Sì' : 'No' }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection