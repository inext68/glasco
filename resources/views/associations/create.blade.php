@extends('adminlte::page')

@section('title', 'Nuova Associazione')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Associazione</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('associations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nation">Nazione</label>
                        <select name="nation" id="nation" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="Italia">Italia</option>
                            <option value="Albania">Albania</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Belgio">Belgio</option>
                            <option value="Brasile">Brasile</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Canada">Canada</option>
                            <option value="Cina">Cina</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Corea del Sud">Corea del Sud</option>
                            <option value="Croazia">Croazia</option>
                            <option value="Danimarca">Danimarca</option>
                            <option value="Egitto">Egitto</option>
                            <option value="Emirati Arabi Uniti">Emirati Arabi Uniti</option>
                            <option value="Filippine">Filippine</option>
                            <option value="Finlandia">Finlandia</option>
                            <option value="Francia">Francia</option>
                            <option value="Germania">Germania</option>
                            <option value="Giappone">Giappone</option>
                            <option value="Grecia">Grecia</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Irlanda">Irlanda</option>
                            <option value="Israele">Israele</option>
                            <option value="Messico">Messico</option>
                            <option value="Norvegia">Norvegia</option>
                            <option value="Nuova Zelanda">Nuova Zelanda</option>
                            <option value="Paesi Bassi">Paesi Bassi</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Perù">Perù</option>
                            <option value="Polonia">Polonia</option>
                            <option value="Portogallo">Portogallo</option>
                            <option value="Regno Unito">Regno Unito</option>
                            <option value="Repubblica Ceca">Repubblica Ceca</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Slovacchia">Slovacchia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Spagna">Spagna</option>
                            <option value="Stati Uniti">Stati Uniti</option>
                            <option value="Svezia">Svezia</option>
                            <option value="Svizzera">Svizzera</option>
                            <option value="Turchia">Turchia</option>
                            <option value="Ucraina">Ucraina</option>
                            <option value="Ungheria">Ungheria</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <textarea name="address" id="address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="religious">Religiosa</option>
                            <option value="charity">Beneficenza</option>
                            <option value="cultural">Culturale</option>
                            <option value="other">Altro</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('associations.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection