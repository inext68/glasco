@extends('adminlte::page')

@section('title', 'Nuovo Gruppo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Gruppo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrizione</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="diocese_id">Diocesi</label>
                                <select name="diocese_id" id="diocese_id" class="form-control">
                                    <option value="">Seleziona...</option>
                                    @foreach($dioceses as $diocese)
                                    <option value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Informazioni Ritrovo</h5>
                            <div class="form-group">
                                <label for="meeting_place">Luogo di ritrovo</label>
                                <input type="text" name="meeting_place" id="meeting_place" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="meeting_address">Indirizzo</label>
                                <input type="text" name="meeting_address" id="meeting_address" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="meeting_cap">CAP</label>
                                    <input type="text" name="meeting_cap" id="meeting_cap" class="form-control" maxlength="10">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meeting_city">Città</label>
                                    <input type="text" name="meeting_city" id="meeting_city" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="meeting_province">Provincia</label>
                                    <input type="text" name="meeting_province" id="meeting_province" class="form-control" maxlength="5">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="meeting_day">Giorno di ritrovo</label>
                                    <select name="meeting_day" id="meeting_day" class="form-control">
                                        <option value="">Seleziona...</option>
                                        <option value="Lunedì">Lunedì</option>
                                        <option value="Martedì">Martedì</option>
                                        <option value="Mercoledì">Mercoledì</option>
                                        <option value="Giovedì">Giovedì</option>
                                        <option value="Venerdì">Venerdì</option>
                                        <option value="Sabato">Sabato</option>
                                        <option value="Domenica">Domenica</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meeting_time">Ora del ritrovo</label>
                                    <input type="time" name="meeting_time" id="meeting_time" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="responsible_id">Responsabile</label>
                                <select name="responsible_id" id="responsible_id" class="form-control">
                                    <option value="">Seleziona...</option>
                                    @foreach($persons as $person)
                                    <option value="{{ $person->id }}">{{ $person->last_name }} {{ $person->first_name }}</option>
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
                                @foreach(\App\Models\Association::orderBy('name')->get() as $association)
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
                            <tr>
                                <td colspan="3" class="text-center">Nessuna associazione collegata</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h5>Persone associate al gruppo</h5>
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <select id="available_persons" class="form-control">
                                <option value="">Seleziona persona...</option>
                                @foreach(\App\Models\Person::orderBy('last_name')->orderBy('first_name')->get() as $person)
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
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">Nessuna persona associata</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('adminlte_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add_person').addEventListener('click', function() {
        const select = document.getElementById('available_persons');
        const personId = select.value;
        if (!personId) return;
        
        const personName = select.options[select.selectedIndex].text;
        const match = personName.match(/^(.+?)\s+(.+?)\s+\((\d+)\)$/);
        const lastName = match ? match[1] : '';
        const firstName = match ? match[2] : personName;
        const personCode = match ? match[3] : '';
        
        const tbody = document.querySelector('#persons_table tbody');
        const emptyRow = tbody.querySelector('tr td[colspan]');
        if (emptyRow) {
            tbody.innerHTML = '';
        }
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${personCode}</td>
            <td>${lastName}</td>
            <td>${firstName}</td>
            <td>
                <a href="/persons/${personId}/show" class="btn btn-sm btn-info">Visualizza</a>
                <button type="button" class="btn btn-sm btn-danger remove_person" data-id="${personId}">Rimuovi</button>
                <input type="hidden" name="persons[]" value="${personId}">
            </td>
        `;
        tbody.appendChild(row);
        
        select.querySelector(`option[value="${personId}"]`).remove();
        select.value = '';
        
        attachRemoveHandler(row);
    });
    
    function attachRemoveHandler(row) {
        row.querySelector('.remove_person').addEventListener('click', function() {
            const personId = this.dataset.id;
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
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nessuna persona associata</td></tr>';
            }
        });
    }
    
    document.querySelectorAll('.remove_person').forEach(attachRemoveHandler);
    
    document.getElementById('add_association').addEventListener('click', function() {
        const select = document.getElementById('available_associations');
        const associationId = select.value;
        if (!associationId) return;
        
        const associationName = select.options[select.selectedIndex].text;
        const match = associationName.match(/^(.+?)\s+\((.+?)\)$/);
        const name = match ? match[1] : associationName;
        const nation = match ? match[2] : '';
        
        const tbody = document.querySelector('#associations_table tbody');
        const emptyRow = tbody.querySelector('tr td[colspan]');
        if (emptyRow) {
            tbody.innerHTML = '';
        }
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${name}</td>
            <td>${nation}</td>
            <td>
                <a href="/associations/${associationId}/show" class="btn btn-sm btn-info">Visualizza</a>
                <button type="button" class="btn btn-sm btn-danger remove_association" data-id="${associationId}">Rimuovi</button>
                <input type="hidden" name="association_ids[]" value="${associationId}">
            </td>
        `;
        tbody.appendChild(row);
        
        select.querySelector(`option[value="${associationId}"]`).remove();
        select.value = '';
        
        attachRemoveAssociationHandler(row);
    });
    
    function attachRemoveAssociationHandler(row) {
        row.querySelector('.remove_association').addEventListener('click', function() {
            const associationId = this.dataset.id;
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
        });
    }
    
    document.querySelectorAll('.remove_association').forEach(attachRemoveAssociationHandler);
});
</script>
@endpush