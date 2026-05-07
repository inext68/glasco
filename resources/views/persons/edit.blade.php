@extends('adminlte::page')

@section('title', 'Modifica Persona')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Persona</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('persons.update', $person->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Nome</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $person->first_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Cognome</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $person->last_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Data di Nascita</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $person->birth_date ? $person->birth_date->format('Y-m-d') : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Genere</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="M" {{ $person->gender == 'M' ? 'selected' : '' }}>Maschio</option>
                                    <option value="F" {{ $person->gender == 'F' ? 'selected' : '' }}>Femmina</option>
                                    <option value="Altro" {{ $person->gender == 'Altro' ? 'selected' : '' }}>Altro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Note</label>
                                <textarea name="notes" id="notes" class="form-control" rows="3">{{ $person->notes }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street">Via</label>
                                <input type="text" name="street" id="street" class="form-control" value="{{ $person->street }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="postal_code">CAP</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control" maxlength="10" value="{{ $person->postal_code }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Città</label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ $person->city }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="province">Sigla Provincia</label>
                                    <input type="text" name="province" id="province" class="form-control" maxlength="2" value="{{ $person->province }}">
                                </div>
                            </div>
                            <hr>
                            <h5>Documento d'identità</h5>
                            <div class="form-group">
                                <label for="document_type">Tipo Documento</label>
                                <select name="document_type" id="document_type" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="Carta d'identità" {{ $person->document_type == "Carta d'identità" ? 'selected' : '' }}>Carta d'identità</option>
                                    <option value="Patente" {{ $person->document_type == 'Patente' ? 'selected' : '' }}>Patente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="document_number">Numero Documento</label>
                                <input type="text" name="document_number" id="document_number" class="form-control" value="{{ $person->document_number }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Contatti</h5>
                    <div id="contacts-container">
                        <table class="table table-bordered table-hover" id="contacts_table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Etichetta</th>
                                    <th>Valore</th>
                                    <th>Primario</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($person->contacts as $contact)
                                <tr id="contact-row-{{ $contact->id }}">
                                    <td>{{ $contact->type }}</td>
                                    <td>{{ $contact->label ?? '-' }}</td>
                                    <td>{{ $contact->value }}</td>
                                    <td>{{ $contact->is_primary ? 'Sì' : 'No' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove_contact" data-id="{{ $contact->id }}">Rimuovi</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nessun contatto associato</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <select id="contact_type" class="form-control">
                                <option value="">Seleziona tipo...</option>
                                <option value="Email">Email</option>
                                <option value="Telefono">Telefono</option>
                                <option value="Cellulare">Cellulare</option>
                                <option value="Fax">Fax</option>
                                <option value="Indirizzo">Indirizzo</option>
                                <option value="Social">Social</option>
                                <option value="Sito web">Sito web</option>
                                <option value="Altro">Altro</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="contact_label" class="form-control" placeholder="Etichetta (es. lavoro)">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="contact_value" class="form-control" placeholder="Valore">
                        </div>
                        <div class="col-md-1">
                            <div class="form-check mt-2">
                                <input type="checkbox" id="contact_is_primary" class="form-check-input" value="1">
                                <label class="form-check-label">Primario</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="add_contact" class="btn btn-primary btn-block">Aggiungi</button>
                        </div>
                    </div>
                    <hr>
                    <h5>Ruoli</h5>
                    <div id="roles-container">
                        <table class="table table-bordered table-hover" id="roles_table">
                            <thead>
                                <tr>
                                    <th>Ruolo</th>
                                    <th>Contesto</th>
                                    <th>Data Inizio</th>
                                    <th>Data Fine</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($person->personRoleAssignments as $assignment)
                                <tr id="role-row-{{ $assignment->id }}">
                                    <td>{{ $assignment->role->name ?? '-' }}</td>
                                    <td>{{ $assignment->entity_type ?? '-' }}</td>
                                    <td>{{ $assignment->start_date ? $assignment->start_date->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $assignment->end_date ? $assignment->end_date->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove_role" data-id="{{ $assignment->id }}">Rimuovi</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nessun ruolo associato</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <select id="available_roles" class="form-control">
                                <option value="">Seleziona ruolo...</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->context }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="role_context" class="form-control" placeholder="Contesto">
                        </div>
                        <div class="col-md-2">
                            <input type="date" id="role_start_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <input type="date" id="role_end_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="add_role" class="btn btn-primary btn-block">Aggiungi</button>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('persons.show', $person->id) }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const personId = {{ $person->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    document.getElementById('add_contact').addEventListener('click', async function() {
        const type = document.getElementById('contact_type').value;
        const label = document.getElementById('contact_label').value;
        const value = document.getElementById('contact_value').value;
        const isPrimary = document.getElementById('contact_is_primary').checked ? 1 : 0;
        
        if (!type || !value) {
            alert('Seleziona il tipo e inserisci il valore');
            return;
        }
        
        try {
            const response = await fetch(`/persons/${personId}/contacts`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    type: type,
                    label: label,
                    value: value,
                    is_primary: isPrimary
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const tbody = document.querySelector('#contacts_table tbody');
                const emptyRow = tbody.querySelector('tr td[colspan]');
                if (emptyRow) tbody.innerHTML = '';
                
                const row = document.createElement('tr');
                row.id = `contact-row-${data.contact.id}`;
                row.innerHTML = `
                    <td>${type}</td>
                    <td>${label || '-'}</td>
                    <td>${value}</td>
                    <td>${isPrimary ? 'Sì' : 'No'}</td>
                    <td><button type="button" class="btn btn-sm btn-danger remove_contact" data-id="${data.contact.id}">Rimuovi</button></td>
                `;
                tbody.appendChild(row);
                
                document.getElementById('contact_type').value = '';
                document.getElementById('contact_label').value = '';
                document.getElementById('contact_value').value = '';
                document.getElementById('contact_is_primary').checked = false;
                
                attachRemoveContactHandler(row, data.contact.id);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante l\'aggiunta del contatto');
        }
    });
    
    function attachRemoveContactHandler(row, contactId) {
        row.querySelector('.remove_contact').addEventListener('click', async function() {
            if (!confirm('Sei sicuro di voler rimuovere questo contatto?')) return;
            
            try {
                const response = await fetch(`/persons/${personId}/contacts/${contactId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    row.remove();
                    
                    const tbody = document.querySelector('#contacts_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nessun contatto associato</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione del contatto');
            }
        });
    }
    
    document.querySelectorAll('.remove_contact').forEach(function(btn) {
        const contactId = btn.dataset.id;
        const row = document.getElementById(`contact-row-${contactId}`);
        if (row) attachRemoveContactHandler(row, contactId);
    });
    
    document.getElementById('add_role').addEventListener('click', async function() {
        const roleId = document.getElementById('available_roles').value;
        const context = document.getElementById('role_context').value;
        const startDate = document.getElementById('role_start_date').value;
        const endDate = document.getElementById('role_end_date').value;
        
        if (!roleId) {
            alert('Seleziona un ruolo');
            return;
        }
        
        try {
            const response = await fetch(`/person-role-assignments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    person_id: personId,
                    role_id: roleId,
                    entity_id: personId,
                    entity_type: 'person',
                    start_date: startDate || null,
                    end_date: endDate || null
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const tbody = document.querySelector('#roles_table tbody');
                const emptyRow = tbody.querySelector('tr td[colspan]');
                if (emptyRow) tbody.innerHTML = '';
                
                const roleName = document.getElementById('available_roles').options[document.getElementById('available_roles').selectedIndex].text;
                
                const row = document.createElement('tr');
                row.id = `role-row-${data.assignment.id}`;
                row.innerHTML = `
                    <td>${roleName.split(' (')[0]}</td>
                    <td>${context || '-'}</td>
                    <td>${startDate || '-'}</td>
                    <td>${endDate || '-'}</td>
                    <td><button type="button" class="btn btn-sm btn-danger remove_role" data-id="${data.assignment.id}">Rimuovi</button></td>
                `;
                tbody.appendChild(row);
                
                document.getElementById('available_roles').value = '';
                document.getElementById('role_context').value = '';
                document.getElementById('role_start_date').value = '';
                document.getElementById('role_end_date').value = '';
                
                attachRemoveRoleHandler(row, data.assignment.id);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante l\'aggiunta del ruolo');
        }
    });
    
    function attachRemoveRoleHandler(row, assignmentId) {
        row.querySelector('.remove_role').addEventListener('click', async function() {
            if (!confirm('Sei sicuro di voler rimuovere questo ruolo?')) return;
            
            try {
                const response = await fetch(`/person-role-assignments/${assignmentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    row.remove();
                    
                    const tbody = document.querySelector('#roles_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nessun ruolo associato</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione del ruolo');
            }
        });
    }
    
    document.querySelectorAll('.remove_role').forEach(function(btn) {
        const assignmentId = btn.dataset.id;
        const row = document.getElementById(`role-row-${assignmentId}`);
        if (row) attachRemoveRoleHandler(row, assignmentId);
    });
});
</script>
@endsection