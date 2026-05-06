@extends('adminlte::page')

@section('title', 'Assegnazioni Ruoli')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assegnazioni Ruoli</h3>
                <a href="{{ route('person-role-assignments.create') }}" class="btn btn-primary float-right">Nuova Assegnazione</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Ruolo</th>
                            <th>Entità</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->person->first_name ?? '-' }} {{ $assignment->person->last_name ?? '' }}</td>
                            <td>{{ $assignment->role->name ?? '-' }}</td>
                            <td>{{ $assignment->entity_type ?? '-' }}</td>
                            <td>{{ $assignment->start_date ? $assignment->start_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $assignment->end_date ? $assignment->end_date->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('person-role-assignments.show', $assignment->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('person-role-assignments.edit', $assignment->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('person-role-assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $assignments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection