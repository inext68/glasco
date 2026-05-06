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
                            <option value="App\Models\Person">Persona</option>
                            <option value="App\Models\Association">Associazione</option>
                            <option value="App\Models\Diocese">Diocesi</option>
                            <option value="App\Models\Group">Gruppo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mediaable_id">Entità</label>
                        <select name="mediaable_id" id="mediaable_id" class="form-control" required disabled>
                            <option value="">Seleziona prima il tipo</option>
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