@extends('adminlte::page')

@section('title', 'Persone')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Persone</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#columnsModal">
                        <i class="fas fa-cog"></i> Colonne
                    </button>
                    <a href="{{ route('persons.create') }}" class="btn btn-primary btn-sm">Nuova Persona</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            @if(in_array('unique_code', $visibleColumns))<th>Codice</th>@endif
                            @if(in_array('first_name', $visibleColumns))<th>Nome</th>@endif
                            @if(in_array('last_name', $visibleColumns))<th>Cognome</th>@endif
                            @if(in_array('birth_date', $visibleColumns))<th>Data di Nascita</th>@endif
                            @if(in_array('gender', $visibleColumns))<th>Genere</th>@endif
                            @if(in_array('city', $visibleColumns))<th>Città</th>@endif
                            @if(in_array('contacts', $visibleColumns))<th>Contatti</th>@endif
                            @if(in_array('created_at', $visibleColumns))<th>Creato il</th>@endif
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persons as $person)
                        <tr>
                            @if(in_array('unique_code', $visibleColumns))<td>{{ $person->unique_code }}</td>@endif
                            @if(in_array('first_name', $visibleColumns))<td>{{ $person->first_name }}</td>@endif
                            @if(in_array('last_name', $visibleColumns))<td>{{ $person->last_name }}</td>@endif
                            @if(in_array('birth_date', $visibleColumns))<td>{{ $person->birth_date ? $person->birth_date->format('d/m/Y') : '-' }}</td>@endif
                            @if(in_array('gender', $visibleColumns))<td>{{ $person->gender ?? '-' }}</td>@endif
                            @if(in_array('city', $visibleColumns))<td>{{ $person->city ?? '-' }}</td>@endif
                            @if(in_array('contacts', $visibleColumns))
                            <td>
                                @php $primaryContact = $person->contacts->where('is_primary', true)->first() @endphp
                                {{ $primaryContact ? $primaryContact->value : ($person->contacts->first()->value ?? '-') }}
                            </td>
                            @endif
                            @if(in_array('created_at', $visibleColumns))<td>{{ $person->created_at ? $person->created_at->format('d/m/Y') : '-' }}</td>@endif
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

<div class="modal fade" id="columnsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleziona Colonne</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="columnsForm">
                    @csrf
                    <div class="form-group">
                        @foreach($availableColumns as $col)
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="{{ $col }}" class="form-check-input" id="col_{{ $col }}" {{ in_array($col, $visibleColumns) ? 'checked' : '' }}>
                            <label class="form-check-label" for="col_{{ $col }}">{{ $columnLabels[$col] }}</label>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveColumns">Salva</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    document.getElementById('saveColumns').addEventListener('click', async function() {
        const checkboxes = document.querySelectorAll('input[name="columns[]"]:checked');
        const columns = Array.from(checkboxes).map(cb => cb.value);
        
        if (columns.length === 0) {
            alert('Seleziona almeno una colonna');
            return;
        }
        
        try {
            const url = '{{ route("profile.update") }}';
            console.log('Fetching URL:', url);
            
            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    column_settings: {
                        persons_columns: columns
                    }
                })
            });
            
            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);
            
            if (!response.ok) {
                const errorText = await response.text();
                console.log('Error response:', errorText);
                alert('Errore HTTP ' + response.status + ': ' + errorText);
                return;
            }
            
            const data = await response.json();
            console.log('Data:', data);
            
            if (data.success) {
                location.reload();
            } else {
                alert('Errore durante il salvataggio: ' + (data.message || ''));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante il salvataggio: ' + error.message);
        }
    });
});
</script>
@endsection