@extends('adminlte::page')

@section('title', 'Nuova Assegnazione Ruolo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('person-role-assignments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}">{{ $person->last_name }} {{ $person->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Nessuna (ruolo globale)</option>
                            @foreach($entityTypes as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">Entità</label>
                        <select name="entity_id" id="entity_id" class="form-control" disabled>
                            <option value="">Seleziona prima il tipo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data Fine</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('person-role-assignments.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('entity_type').addEventListener('change', function() {
    const type = this.value;
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
                    entitySelect.appendChild(opt);
                });
            }
            entitySelect.disabled = false;
        })
        .catch(err => {
            console.error('Error:', err);
            entitySelect.innerHTML = '<option value="">Errore nel caricamento</option>';
            entitySelect.disabled = false;
        });
});
</script>
@endsection