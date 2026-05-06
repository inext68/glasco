@extends('adminlte::page')

@section('title', 'Contatti')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contatti</h3>
                <a href="{{ route('contacts.create') }}" class="btn btn-primary float-right">Nuovo Contatto</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Tipo</th>
                            <th>Etichetta</th>
                            <th>Valore</th>
                            <th>Primario</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->person->first_name ?? '-' }} {{ $contact->person->last_name ?? '' }}</td>
                            <td>{{ $contact->type }}</td>
                            <td>{{ $contact->label }}</td>
                            <td>
                                @if($contact->type === 'phone')
                                    <a href="tel:{{ $contact->value }}">{{ $contact->value }}</a>
                                @elseif($contact->type === 'email')
                                    <a href="mailto:{{ $contact->value }}">{{ $contact->value }}</a>
                                @elseif(preg_match('/^(https?:\/\/|ftp:\/\/|whatsapp:|telegram:|tel:|mailto:)/i', $contact->value))
                                    <a href="{{ $contact->value }}" target="_blank" rel="noopener">{{ $contact->value }}</a>
                                @else
                                    {{ $contact->value }}
                                @endif
                            </td>
                            <td>{{ $contact->is_primary ? 'Sì' : 'No' }}</td>
                            <td>
                                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection