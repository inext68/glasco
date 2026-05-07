@extends('adminlte::page')

@section('title', 'Modifica Gruppo')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Gruppo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.update', $group->id) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                    <hr>
                    <h5>Informazioni Ritrovo</h5>
                    <div class="form-group">
                        <label for="meeting_place">Luogo di ritrovo</label>
                        <input type="text" name="meeting_place" id="meeting_place" class="form-control" value="{{ $group->meeting_place }}">
                    </div>
                    <div class="form-group">
                        <label for="meeting_address">Indirizzo</label>
                        <input type="text" name="meeting_address" id="meeting_address" class="form-control" value="{{ $group->meeting_address }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_cap">CAP</label>
                                <input type="text" name="meeting_cap" id="meeting_cap" class="form-control" value="{{ $group->meeting_cap }}" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_city">Città</label>
                                <input type="text" name="meeting_city" id="meeting_city" class="form-control" value="{{ $group->meeting_city }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meeting_province">Provincia</label>
                                <input type="text" name="meeting_province" id="meeting_province" class="form-control" value="{{ $group->meeting_province }}" maxlength="5">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meeting_time">Ora del ritrovo</label>
                                <input type="time" name="meeting_time" id="meeting_time" class="form-control" value="{{ $group->meeting_time }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsible_id">Responsabile</label>
                        <select name="responsible_id" id="responsible_id" class="form-control">
                            <option value="">Seleziona...</option>
                            @foreach($persons as $person)
                            <option value="{{ $person->id }}" {{ $group->responsible_id == $person->id ? 'selected' : '' }}>{{ $person->last_name }} {{ $person->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection