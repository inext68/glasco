@extends('adminlte::page')

@section('title', 'Nuova Associazione')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Associazione</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('associations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
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
                                <label for="type">Tipo</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="religious">Religiosa</option>
                                    <option value="charity">Beneficenza</option>
                                    <option value="cultural">Culturale</option>
                                    <option value="other">Altro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Indirizzo</h5>
                            <div class="form-group">
                                <label for="address">Via</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cap">CAP</label>
                                    <input type="text" name="cap" id="cap" class="form-control" maxlength="10">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Città</label>
                                    <input type="text" name="city" id="city" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="province">Provincia</label>
                                    <input type="text" name="province" id="province" class="form-control" maxlength="10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Contatti</h5>
                            <div class="form-group">
                                <label for="fiscal_code">Codice Fiscale</label>
                                <input type="text" name="fiscal_code" id="fiscal_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="vat_number">Partita IVA</label>
                                <input type="text" name="vat_number" id="vat_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>&nbsp;</h5>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="website">Sito Web</label>
                                <input type="text" name="website" id="website" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="other">Altro</label>
                                <textarea name="other" id="other" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('associations.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection