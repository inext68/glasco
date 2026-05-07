@extends('adminlte::page')

@section('title', 'Importa Dati')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Importa Dati da CSV</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="type">Tipo dati da importare</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="persons">Persone</option>
                            <option value="contacts">Contatti (richiede ID persona)</option>
                            <option value="associations">Associazioni</option>
                            <option value="groups">Gruppi</option>
                            <option value="diocesi">Diocesi</option>
                            <option value="role_assignments">Assegnazioni Ruoli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File CSV</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".csv" required>
                        <small class="text-muted">Il file deve essere in formato UTF-8 con intestazione nella prima riga</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Importa</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Template CSV</h3>
            </div>
            <div class="card-body">
                <p>Scarica i template per preparare i tuoi file CSV:</p>
                <div class="list-group">
                    <a href="{{ route('import.download', ['type' => 'persons']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Persone
                    </a>
                    <a href="{{ route('import.download', ['type' => 'contacts']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Contatti
                    </a>
                    <a href="{{ route('import.download', ['type' => 'associations']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Associazioni
                    </a>
                    <a href="{{ route('import.download', ['type' => 'groups']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Gruppi
                    </a>
                    <a href="{{ route('import.download', ['type' => 'dioceses']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Diocesi
                    </a>
                    <a href="{{ route('import.download', ['type' => 'role_assignments']) }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Assegnazioni Ruoli
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const link = document.getElementById('template-link');
    if (type) {
        link.href = '/import/template?type=' + type;
    }
});
</script>
@endsection