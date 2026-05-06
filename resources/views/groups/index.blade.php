@extends('adminlte::page')

@section('title', 'Gruppi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gruppi</h3>
                <a href="{{ route('groups.create') }}" class="btn btn-primary float-right">Nuovo Gruppo</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>Diocesi</th>
                            <th>Luogo ritrovo</th>
                            <th>Giorno/Ora ritrovo</th>
                            <th>Responsabile</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->description ?? '-' }}</td>
                            <td>{{ $group->diocese->name ?? '-' }}</td>
                            <td>{{ $group->meeting_place ?? '-' }}</td>
                            <td>{{ $group->meeting_day ?? '-' }} {{ $group->meeting_time ? \Carbon\Carbon::parse($group->meeting_time)->format('H:i') : '' }}</td>
                            <td>{{ $group->responsible->surname ?? '' }} {{ $group->responsible->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('groups.show', $group->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $groups->links() }}
            </div>
        </div>
    </div>
</div>
@endsection