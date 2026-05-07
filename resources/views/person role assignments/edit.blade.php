@extends('adminlte::page')

@section('title', 'Modifica Assegnazione Ruolo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('person-role-assignments.update', $personRoleAssignment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}" {{ $personRoleAssignment->person_id == $person->id ? 'selected' : '' }}>{{ $person->last_name }} {{ $person->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $personRoleAssignment->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Nessuna (ruolo globale)</option>
                            @foreach($entityTypes as $type)
                            <option value="{{ $type }}" {{ class_basename($personRoleAssignment->entity_type) == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">Entità</label>
                        <select name="entity_id" id="entity_id" class="form-control">
                            <option value="">Caricamento...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $personRoleAssignment->start_date }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data Fine</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $personRoleAssignment->end_date }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('person-role-assignments.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
const currentEntityType = '{{ $personRoleAssignment->entity_type ? class_basename($personRoleAssignment->entity_type) : '' }}';
const currentEntityId = '{{ $personRoleAssignment->entity_id }}';

document.getElementById('entity_type').addEventListener('change', function() {
    loadEntities(this.value);
});

function loadEntities(type, selectedId = null) {
    const entitySelect = document.getElementById('entity_id');
    
    if (!type) {
        entitySelect.innerHTML = '<option value="">Seleziona prima il tipo</option>';
        entitySelect.disabled = true;
        return;
    }
    
    entitySelect.innerHTML = '<option value="">Caricamento...</option>';
    entitySelect.disabled = true;
    
    const url = window.location.origin + '/role-assignments/entities?type=' + type;
    
    window.fetch(url, { credentials: 'same-origin' })
        .then(response => response.json())
        .then(data => {
            entitySelect.innerHTML = '<option value="">Seleziona...</option>';
            if (!data || data.length === 0) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Nessuna entità trovata';
                entitySelect.appendChild(opt);
            } else {
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.textContent = item.name;
                    if (item.id == selectedId) opt.selected = true;
                    entitySelect.appendChild(opt);
                });
            }
            entitySelect.disabled = false;
        })
        .catch(err => {
            console.error('Error:', err);
            entitySelect.innerHTML = '<option value="">Errore</option>';
            entitySelect.disabled = false;
        });
}

if (currentEntityType) {
    loadEntities(currentEntityType, currentEntityId);
} else {
    document.getElementById('entity_id').disabled = true;
}
</script>
@endsection