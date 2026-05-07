@extends('adminlte::page')

@section('title', 'Nuovo Media')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Media</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="mediaable_type">Tipo Entità</label>
                        <select name="mediaable_type" id="mediaable_type" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="person">Persona</option>
                            <option value="association">Associazione</option>
                            <option value="diocese">Diocesi</option>
                            <option value="group">Gruppo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mediaable_id">Entità</label>
                        <select name="mediaable_id" id="mediaable_id" class="form-control" required disabled>
                            <option value="">Seleziona prima il tipo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="uploaded_by_person_id">Caricato da</label>
                        <select name="uploaded_by_person_id" id="uploaded_by_person_id" class="form-control">
                            <option value="">Seleziona...</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}">{{ $person->surname }} {{ $person->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Carica</button>
                    <a href="{{ route('media.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('mediaable_type').addEventListener('change', function() {
    const type = this.value;
    const select = document.getElementById('mediaable_id');
    select.innerHTML = '<option value="">Caricamento...</option>';
    select.disabled = true;

    if (!type) {
        select.innerHTML = '<option value="">Seleziona prima il tipo</option>';
        return;
    }

    fetch('/media/entities?type=' + type)
        .then(res => res.json())
        .then(data => {
            select.innerHTML = '<option value="">Seleziona...</option>';
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.label;
                select.appendChild(option);
            });
            select.disabled = false;
        });
});
</script>
@endsection