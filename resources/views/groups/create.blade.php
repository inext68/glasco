@extends('adminlte::page')

@section('title', 'Nuovo Gruppo')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Gruppo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
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
                            @foreach(\App\Models\Diocese::all() as $diocese)
                            <option value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meeting_place">Luogo di ritrovo</label>
                        <input type="text" name="meeting_place" id="meeting_place" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="meeting_day">Giorno di ritrovo</label>
                        <input type="text" name="meeting_day" id="meeting_day" class="form-control" placeholder="Es. ogni lunedì">
                    </div>
                    <div class="form-group">
                        <label for="meeting_time">Ora del ritrovo</label>
                        <input type="time" name="meeting_time" id="meeting_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="responsible_id">Responsabile</label>
                        <select name="responsible_id" id="responsible_id" class="form-control">
                            <option value="">Seleziona...</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}">{{ $person->surname }} {{ $person->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection