@extends('adminlte::page')

@section('title', 'Persone')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Persone</h3>
                <a href="{{ route('persons.create') }}" class="btn btn-primary float-right">Nuova Persona</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Data di Nascita</th>
                            <th>Genere</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persons as $person)
                        <tr>
                            <td>{{ $person->first_name }}</td>
                            <td>{{ $person->last_name }}</td>
                            <td>{{ $person->birth_date ? $person->birth_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $person->gender ?? '-' }}</td>
                            <td>
                                <a href="{{ route('persons.show', $person->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('persons.edit', $person->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('persons.destroy', $person->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $persons->links() }}
            </div>
        </div>
    </div>
</div>
@endsection