@extends('adminlte::page')

@section('title', 'Report - ' . ucfirst($modelType))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Report {{ ucfirst($modelType) }}</h3>
                <button onclick="window.print()" class="btn btn-primary float-right">
                    <i class="fas fa-print"></i> Stampa
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="reportTable">
                    <thead>
                        <tr>
                            @foreach($selectedFields as $field)
                            <th>{{ $fieldLabels[$field] ?? $field }}</th>
                            @endforeach
                            @foreach($selectedRelations as $relation)
                            <th>{{ $relationLabels[$relation] ?? $relation }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            @foreach($selectedFields as $field)
                            <td>
                                @switch($field)
                                    @case('first_name')
                                        {{ $item->first_name }}
                                        @break
                                    @case('last_name')
                                        {{ $item->last_name }}
                                        @break
                                    @case('birth_date')
                                        {{ $item->birth_date ? $item->birth_date->format('d/m/Y') : '-' }}
                                        @break
                                    @case('gender')
                                        {{ $item->gender === 'M' ? 'Maschio' : ($item->gender === 'F' ? 'Femmina' : '-') }}
                                        @break
                                    @case('name')
                                        {{ $item->name }}
                                        @break
                                    @case('description')
                                        {{ $item->description ?? '-' }}
                                        @break
                                    @case('fiscal_code')
                                        {{ $item->fiscal_code ?? '-' }}
                                        @break
                                    @case('vat_number')
                                        {{ $item->vat_number ?? '-' }}
                                        @break
                                    @case('diocese_id')
                                        {{ $item->diocese->name ?? '-' }}
                                        @break
                                    @case('meeting_place')
                                        {{ $item->meeting_place ?? '-' }}
                                        @break
                                    @case('meeting_day')
                                        {{ $item->meeting_day ?? '-' }}
                                        @break
                                    @case('meeting_time')
                                        {{ $item->meeting_time ? \Carbon\Carbon::parse($item->meeting_time)->format('H:i') : '-' }}
                                        @break
                                    @case('responsible_id')
                                        {{ $item->responsible->last_name ?? '' }} {{ $item->responsible->first_name ?? '-' }}
                                        @break
                                    @case('primary_contact')
                                        @if($item->primaryContact)
                                            {{ $item->primaryContact->value }}
                                        @else
                                            -
                                        @endif
                                        @break
                                    @default
                                        {{ $item->$field ?? '-' }}
                                @endswitch
                            </td>
                            @endforeach

                            @foreach($selectedRelations as $relation)
                            <td>
                                @switch($relation)
                                    @case('contacts')
                                        @if($item->contacts)
                                            @foreach($item->contacts as $contact)
                                                <span class="badge badge-info">{{ $contact->label }}: {{ $contact->value }}</span>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                        @break
                                    @case('associations')
                                        @if($item->associations && $item->associations->count())
                                            @foreach($item->associations as $assoc)
                                                <span class="badge badge-primary">{{ $assoc->name }}</span>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                        @break
                                    @case('groups')
                                        @if($item->groups && $item->groups->count())
                                            @foreach($item->groups as $group)
                                                <span class="badge badge-success">{{ $group->name }}</span>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                        @break
                                    @case('roles')
                                        @if($item->personRoleAssignments && $item->personRoleAssignments->count())
                                            @foreach($item->personRoleAssignments as $assignment)
                                                <span class="badge badge-warning">{{ $assignment->role->name }}</span>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                        @break
                                    @case('media')
                                        @if($item->media && $item->media->count())
                                            {{ $item->media->count() }} file(s)
                                        @else
                                            -
                                        @endif
                                        @break
                                    @case('diocese')
                                        {{ $item->diocese->name ?? '-' }}
                                        @break
                                    @case('responsible')
                                        {{ $item->responsible->last_name ?? '' }} {{ $item->responsible->first_name ?? '-' }}
                                        @break
                                    @case('persons')
                                        @if($item->persons && $item->persons->count())
                                            {{ $item->persons->count() }} persona(e)
                                        @else
                                            -
                                        @endif
                                        @break
                                    @default
                                        -
                                @endswitch
                            </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($selectedFields) + count($selectedRelations) }}" class="text-center">
                                Nessun elemento trovato
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('reports.create', ['model' => $modelType]) }}" class="btn btn-secondary">Nuovo Report</a>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection