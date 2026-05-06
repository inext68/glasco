@extends('adminlte::page')

@section('title', 'Modifica Associazione')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Associazione</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('associations.update', $association->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $association->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nation">Nazione</label>
                        <select name="nation" id="nation" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="Italia" {{ $association->nation == 'Italia' ? 'selected' : '' }}>Italia</option>
                            <option value="Albania" {{ $association->nation == 'Albania' ? 'selected' : '' }}>Albania</option>
                            <option value="Argentina" {{ $association->nation == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                            <option value="Australia" {{ $association->nation == 'Australia' ? 'selected' : '' }}>Australia</option>
                            <option value="Austria" {{ $association->nation == 'Austria' ? 'selected' : '' }}>Austria</option>
                            <option value="Belgio" {{ $association->nation == 'Belgio' ? 'selected' : '' }}>Belgio</option>
                            <option value="Brasile" {{ $association->nation == 'Brasile' ? 'selected' : '' }}>Brasile</option>
                            <option value="Bulgaria" {{ $association->nation == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                            <option value="Canada" {{ $association->nation == 'Canada' ? 'selected' : '' }}>Canada</option>
                            <option value="Cina" {{ $association->nation == 'Cina' ? 'selected' : '' }}>Cina</option>
                            <option value="Colombia" {{ $association->nation == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                            <option value="Corea del Sud" {{ $association->nation == 'Corea del Sud' ? 'selected' : '' }}>Corea del Sud</option>
                            <option value="Croazia" {{ $association->nation == 'Croazia' ? 'selected' : '' }}>Croazia</option>
                            <option value="Danimarca" {{ $association->nation == 'Danimarca' ? 'selected' : '' }}>Danimarca</option>
                            <option value="Egitto" {{ $association->nation == 'Egitto' ? 'selected' : '' }}>Egitto</option>
                            <option value="Emirati Arabi Uniti" {{ $association->nation == 'Emirati Arabi Uniti' ? 'selected' : '' }}>Emirati Arabi Uniti</option>
                            <option value="Filippine" {{ $association->nation == 'Filippine' ? 'selected' : '' }}>Filippine</option>
                            <option value="Finlandia" {{ $association->nation == 'Finlandia' ? 'selected' : '' }}>Finlandia</option>
                            <option value="Francia" {{ $association->nation == 'Francia' ? 'selected' : '' }}>Francia</option>
                            <option value="Germania" {{ $association->nation == 'Germania' ? 'selected' : '' }}>Germania</option>
                            <option value="Giappone" {{ $association->nation == 'Giappone' ? 'selected' : '' }}>Giappone</option>
                            <option value="Grecia" {{ $association->nation == 'Grecia' ? 'selected' : '' }}>Grecia</option>
                            <option value="India" {{ $association->nation == 'India' ? 'selected' : '' }}>India</option>
                            <option value="Indonesia" {{ $association->nation == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Irlanda" {{ $association->nation == 'Irlanda' ? 'selected' : '' }}>Irlanda</option>
                            <option value="Israele" {{ $association->nation == 'Israele' ? 'selected' : '' }}>Israele</option>
                            <option value="Messico" {{ $association->nation == 'Messico' ? 'selected' : '' }}>Messico</option>
                            <option value="Norvegia" {{ $association->nation == 'Norvegia' ? 'selected' : '' }}>Norvegia</option>
                            <option value="Nuova Zelanda" {{ $association->nation == 'Nuova Zelanda' ? 'selected' : '' }}>Nuova Zelanda</option>
                            <option value="Paesi Bassi" {{ $association->nation == 'Paesi Bassi' ? 'selected' : '' }}>Paesi Bassi</option>
                            <option value="Pakistan" {{ $association->nation == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                            <option value="Perù" {{ $association->nation == 'Perù' ? 'selected' : '' }}>Perù</option>
                            <option value="Polonia" {{ $association->nation == 'Polonia' ? 'selected' : '' }}>Polonia</option>
                            <option value="Portogallo" {{ $association->nation == 'Portogallo' ? 'selected' : '' }}>Portogallo</option>
                            <option value="Regno Unito" {{ $association->nation == 'Regno Unito' ? 'selected' : '' }}>Regno Unito</option>
                            <option value="Repubblica Ceca" {{ $association->nation == 'Repubblica Ceca' ? 'selected' : '' }}>Repubblica Ceca</option>
                            <option value="Romania" {{ $association->nation == 'Romania' ? 'selected' : '' }}>Romania</option>
                            <option value="Russia" {{ $association->nation == 'Russia' ? 'selected' : '' }}>Russia</option>
                            <option value="Serbia" {{ $association->nation == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                            <option value="Slovacchia" {{ $association->nation == 'Slovacchia' ? 'selected' : '' }}>Slovacchia</option>
                            <option value="Slovenia" {{ $association->nation == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                            <option value="Spagna" {{ $association->nation == 'Spagna' ? 'selected' : '' }}>Spagna</option>
                            <option value="Stati Uniti" {{ $association->nation == 'Stati Uniti' ? 'selected' : '' }}>Stati Uniti</option>
                            <option value="Svezia" {{ $association->nation == 'Svezia' ? 'selected' : '' }}>Svezia</option>
                            <option value="Svizzera" {{ $association->nation == 'Svizzera' ? 'selected' : '' }}>Svizzera</option>
                            <option value="Turchia" {{ $association->nation == 'Turchia' ? 'selected' : '' }}>Turchia</option>
                            <option value="Ucraina" {{ $association->nation == 'Ucraina' ? 'selected' : '' }}>Ucraina</option>
                            <option value="Ungheria" {{ $association->nation == 'Ungheria' ? 'selected' : '' }}>Ungheria</option>
                            <option value="Venezuela" {{ $association->nation == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                            <option value="Vietnam" {{ $association->nation == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <textarea name="address" id="address" class="form-control" rows="2">{{ $association->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="religious" {{ $association->type == 'religious' ? 'selected' : '' }}>Religiosa</option>
                            <option value="charity" {{ $association->type == 'charity' ? 'selected' : '' }}>Beneficenza</option>
                            <option value="cultural" {{ $association->type == 'cultural' ? 'selected' : '' }}>Culturale</option>
                            <option value="other" {{ $association->type == 'other' ? 'selected' : '' }}>Altro</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('associations.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection