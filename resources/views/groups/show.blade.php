@extends('adminlte::page')

@section('title', 'Dettagli Gruppo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Gruppo</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $group->name }}</dd>
                    <dt class="col-sm-3">Descrizione</dt>
                    <dd class="col-sm-9">{{ $group->description ?? '-' }}</dd>
                    <dt class="col-sm-3">Diocesi</dt>
                    <dd class="col-sm-9">{{ $group->diocese->name ?? '-' }}</dd>
                </dl>
                <hr>
                <h5>Informazioni Ritrovo</h5>
                <dl class="row">
                    <dt class="col-sm-3">Luogo di ritrovo</dt>
                    <dd class="col-sm-9">{{ $group->meeting_place ?? '-' }}</dd>
                    <dt class="col-sm-3">Indirizzo</dt>
                    <dd class="col-sm-9">{{ $group->meeting_address ?? '-' }}</dd>
                    <dt class="col-sm-3">CAP</dt>
                    <dd class="col-sm-9">{{ $group->meeting_cap ?? '-' }}</dd>
                    <dt class="col-sm-3">Città</dt>
                    <dd class="col-sm-9">{{ $group->meeting_city ?? '-' }}</dd>
                    <dt class="col-sm-3">Provincia</dt>
                    <dd class="col-sm-9">{{ $group->meeting_province ?? '-' }}</dd>
                    <dt class="col-sm-3">Giorno di ritrovo</dt>
                    <dd class="col-sm-9">{{ $group->meeting_day ?? '-' }}</dd>
                    <dt class="col-sm-3">Ora del ritrovo</dt>
                    <dd class="col-sm-9">{{ $group->meeting_time ? \Carbon\Carbon::parse($group->meeting_time)->format('H:i') : '-' }}</dd>
                    <dt class="col-sm-3">Responsabile</dt>
                    <dd class="col-sm-9">{{ $group->responsible->last_name ?? '' }} {{ $group->responsible->first_name ?? '-' }}</dd>
                </dl>
                <hr>
                <h5>Associazioni collegate</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Nazione</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($group->associations as $association)
                        <tr>
                            <td>{{ $association->name }}</td>
                            <td>{{ $association->nation ?? '-' }}</td>
                            <td>
                                <a href="{{ route('associations.show', $association->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('associations.edit', $association->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Nessuna associazione collegata</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <hr>
                <h5>Persone associate</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Cognome</th>
                            <th>Nome</th>
                            <th>Stato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($group->persons as $person)
                        <tr>
                            <td>{{ $person->unique_code }}</td>
                            <td>{{ $person->last_name }}</td>
                            <td>{{ $person->first_name }}</td>
                            <td>
                                @if($person->pivot->is_member_of_group)
                                <span class="badge badge-success">Membro</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('persons.show', $person->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('persons.edit', $person->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Nessuna persona associata</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-primary">Modifica</a>
                <a href="{{ route('groups.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection