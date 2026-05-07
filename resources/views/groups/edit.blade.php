@extends('adminlte::page')

@section('title', 'Modifica Gruppo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Gruppo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.update', $group->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $group->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrizione</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ $group->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="diocese_id">Diocesi</label>
                                <select name="diocese_id" id="diocese_id" class="form-control">
                                    <option value="">Seleziona...</option>
                                    @foreach($dioceses as $diocese)
                                    <option value="{{ $diocese->id }}" {{ $group->diocese_id == $diocese->id ? 'selected' : '' }}>{{ $diocese->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Informazioni Ritrovo</h5>
                            <div class="form-group">
                                <label for="meeting_place">Luogo di ritrovo</label>
                                <input type="text" name="meeting_place" id="meeting_place" class="form-control" value="{{ $group->meeting_place }}">
                            </div>
                            <div class="form-group">
                                <label for="meeting_address">Indirizzo</label>
                                <input type="text" name="meeting_address" id="meeting_address" class="form-control" value="{{ $group->meeting_address }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="meeting_cap">CAP</label>
                                    <input type="text" name="meeting_cap" id="meeting_cap" class="form-control" value="{{ $group->meeting_cap }}" maxlength="10">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meeting_city">Città</label>
                                    <input type="text" name="meeting_city" id="meeting_city" class="form-control" value="{{ $group->meeting_city }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meeting_province">Provincia</label>
                                    <input type="text" name="meeting_province" id="meeting_province" class="form-control" value="{{ $group->meeting_province }}" maxlength="5">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="meeting_day">Giorno di ritrovo</label>
                                    <select name="meeting_day" id="meeting_day" class="form-control">
                                        <option value="">Seleziona...</option>
                                        <option value="Lunedì" {{ $group->meeting_day == 'Lunedì' ? 'selected' : '' }}>Lunedì</option>
                                        <option value="Martedì" {{ $group->meeting_day == 'Martedì' ? 'selected' : '' }}>Martedì</option>
                                        <option value="Mercoledì" {{ $group->meeting_day == 'Mercoledì' ? 'selected' : '' }}>Mercoledì</option>
                                        <option value="Giovedì" {{ $group->meeting_day == 'Giovedì' ? 'selected' : '' }}>Giovedì</option>
                                        <option value="Venerdì" {{ $group->meeting_day == 'Venerdì' ? 'selected' : '' }}>Venerdì</option>
                                        <option value="Sabato" {{ $group->meeting_day == 'Sabato' ? 'selected' : '' }}>Sabato</option>
                                        <option value="Domenica" {{ $group->meeting_day == 'Domenica' ? 'selected' : '' }}>Domenica</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meeting_time">Ora del ritrovo</label>
                                    <input type="time" name="meeting_time" id="meeting_time" class="form-control" value="{{ $group->meeting_time }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="responsible_id">Responsabile</label>
                                <select name="responsible_id" id="responsible_id" class="form-control">
                                    <option value="">Seleziona...</option>
                                    @foreach($group->persons as $groupPerson)
                                    <option value="{{ $groupPerson->id }}" {{ $group->responsible_id == $groupPerson->id ? 'selected' : '' }}>{{ $groupPerson->last_name }} {{ $groupPerson->first_name }} ({{ $groupPerson->unique_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Associazioni collegate</h5>
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <select id="available_associations" class="form-control">
                                <option value="">Seleziona associazione...</option>
                                @php
                                $groupAssociationIds = $group->associations->pluck('id')->toArray();
                                @endphp
                                @foreach(\App\Models\Association::whereNotIn('id', $groupAssociationIds)->orderBy('name')->get() as $association)
                                <option value="{{ $association->id }}">{{ $association->name }} ({{ $association->nation }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="add_association" class="btn btn-primary btn-block">Aggiungi</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover" id="associations_table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nazione</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($group->associations as $groupAssociation)
                            <tr id="association-row-{{ $groupAssociation->id }}">
                                <td>{{ $groupAssociation->name }}</td>
                                <td>{{ $groupAssociation->nation }}</td>
                                <td>
                                    <a href="{{ route('associations.show', $groupAssociation->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                    <button type="button" class="btn btn-sm btn-danger remove_association" data-id="{{ $groupAssociation->id }}">Rimuovi</button>
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
                    <h5>Persone associate al gruppo</h5>
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <select id="available_persons" class="form-control">
                                <option value="">Seleziona persona...</option>
                                @php
                                $groupPersonIds = $group->persons->pluck('id')->toArray();
                                @endphp
                                @foreach(\App\Models\Person::whereNotIn('id', $groupPersonIds)->orderBy('last_name')->orderBy('first_name')->get() as $person)
                                <option value="{{ $person->id }}">{{ $person->last_name }} {{ $person->first_name }} ({{ $person->unique_code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="add_person" class="btn btn-primary btn-block">Aggiungi</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover" id="persons_table">
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Cognome</th>
                                <th>Nome</th>
                                <th>Iscritto</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($group->persons as $groupPerson)
                            <tr id="person-row-{{ $groupPerson->id }}">
                                <td>{{ $groupPerson->unique_code }}</td>
                                <td>{{ $groupPerson->last_name }}</td>
                                <td>{{ $groupPerson->first_name }}</td>
                                <td>
                                    @if(isset($groupPerson->pivot->is_member_of_group))
                                    <span class="badge badge-success">Membro</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('persons.show', $groupPerson->id) }}" class="btn btn-sm btn-info" title="Visualizza">Visualizza</a>
                                    <button type="button" class="btn btn-sm btn-danger remove_person" data-id="{{ $groupPerson->id }}" title="Rimuovi">Rimuovi</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Nessuna persona associata</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const groupId = {{ $group->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById('add_person').addEventListener('click', async function() {
        const select = document.getElementById('available_persons');
        const personId = select.value;
        if (!personId) return;
        
        const personName = select.options[select.selectedIndex].text;
        const match = personName.match(/^(.+?)\s+(.+?)\s+\((\d+)\)$/);
        const lastName = match ? match[1] : '';
        const firstName = match ? match[2] : personName;
        const personCode = match ? match[3] : '';
        
        try {
            const response = await fetch(`/groups/${groupId}/persons`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ person_id: personId })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const tbody = document.querySelector('#persons_table tbody');
                const emptyRow = tbody.querySelector('tr td[colspan]');
                if (emptyRow) {
                    tbody.innerHTML = '';
                }
                
                const row = document.createElement('tr');
                row.id = `person-row-${personId}`;
                row.innerHTML = `
                    <td>${personCode}</td>
                    <td>${lastName}</td>
                    <td>${firstName}</td>
                    <td><span class="badge badge-success">Membro</span></td>
                    <td>
                        <a href="/persons/${personId}" class="btn btn-sm btn-info">Visualizza</a>
                        <button type="button" class="btn btn-sm btn-danger remove_person" data-id="${personId}">Rimuovi</button>
                    </td>
                `;
                tbody.appendChild(row);
                
                select.querySelector(`option[value="${personId}"]`).remove();
                select.value = '';
                
                attachRemovePersonHandler(row, personId);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante l\'aggiunta della persona');
        }
    });
    
    function attachRemovePersonHandler(row, personId) {
        row.querySelector('.remove_person').addEventListener('click', async function() {
            try {
                const response = await fetch(`/groups/${groupId}/persons/${personId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const availableSelect = document.getElementById('available_persons');
                    const personCell = row.querySelector('td:nth-child(2)');
                    const nameCell = row.querySelector('td:nth-child(3)');
                    const codeCell = row.querySelector('td:first-child');
                    
                    const option = document.createElement('option');
                    option.value = personId;
                    option.text = `${personCell.textContent} ${nameCell.textContent} (${codeCell.textContent})`;
                    availableSelect.add(option);
                    
                    row.remove();
                    
                    const tbody = document.querySelector('#persons_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nessuna persona associata</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione della persona');
            }
        });
    }
    
    document.querySelectorAll('.remove_person').forEach(btn => {
        const personId = btn.dataset.id;
        const row = document.getElementById(`person-row-${personId}`);
        if (row) attachRemovePersonHandler(row, personId);
    });
    
    document.getElementById('add_association').addEventListener('click', async function() {
        const select = document.getElementById('available_associations');
        const associationId = select.value;
        if (!associationId) return;
        
        const associationName = select.options[select.selectedIndex].text;
        const match = associationName.match(/^(.+?)\s+\((.+?)\)$/);
        const name = match ? match[1] : associationName;
        const nation = match ? match[2] : '';
        
        try {
            const response = await fetch(`/groups/${groupId}/associations`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ association_id: associationId })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const tbody = document.querySelector('#associations_table tbody');
                const emptyRow = tbody.querySelector('tr td[colspan]');
                if (emptyRow) {
                    tbody.innerHTML = '';
                }
                
                const row = document.createElement('tr');
                row.id = `association-row-${associationId}`;
                row.innerHTML = `
                    <td>${name}</td>
                    <td>${nation}</td>
                    <td>
                        <a href="/associations/${associationId}" class="btn btn-sm btn-info">Visualizza</a>
                        <button type="button" class="btn btn-sm btn-danger remove_association" data-id="${associationId}">Rimuovi</button>
                    </td>
                `;
                tbody.appendChild(row);
                
                select.querySelector(`option[value="${associationId}"]`).remove();
                select.value = '';
                
                attachRemoveAssociationHandler(row, associationId);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante l\'aggiunta dell\'associazione');
        }
    });
    
    function attachRemoveAssociationHandler(row, associationId) {
        row.querySelector('.remove_association').addEventListener('click', async function() {
            try {
                const response = await fetch(`/groups/${groupId}/associations/${associationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const availableSelect = document.getElementById('available_associations');
                    const nameCell = row.querySelector('td:first-child');
                    const nationCell = row.querySelector('td:nth-child(2)');
                    
                    const option = document.createElement('option');
                    option.value = associationId;
                    option.text = `${nameCell.textContent} (${nationCell.textContent})`;
                    availableSelect.add(option);
                    
                    row.remove();
                    
                    const tbody = document.querySelector('#associations_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="3" class="text-center">Nessuna associazione collegata</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione dell\'associazione');
            }
        });
    }
    
    document.querySelectorAll('.remove_association').forEach(btn => {
        const associationId = btn.dataset.id;
        const row = document.getElementById(`association-row-${associationId}`);
        if (row) attachRemoveAssociationHandler(row, associationId);
    });
});
</script>
@endsection