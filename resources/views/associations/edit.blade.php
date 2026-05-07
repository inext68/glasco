@extends('adminlte::page')

@section('title', 'Modifica Associazione')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Associazione</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('associations.update', $association->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
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
                                <label for="type">Tipo</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="religious" {{ $association->type == 'religious' ? 'selected' : '' }}>Religiosa</option>
                                    <option value="charity" {{ $association->type == 'charity' ? 'selected' : '' }}>Beneficenza</option>
                                    <option value="cultural" {{ $association->type == 'cultural' ? 'selected' : '' }}>Culturale</option>
                                    <option value="other" {{ $association->type == 'other' ? 'selected' : '' }}>Altro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Indirizzo</h5>
                            <div class="form-group">
                                <label for="address">Via</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $association->address }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cap">CAP</label>
                                    <input type="text" name="cap" id="cap" class="form-control" maxlength="10" value="{{ $association->cap }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Città</label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ $association->city }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="province">Provincia</label>
                                    <input type="text" name="province" id="province" class="form-control" maxlength="10" value="{{ $association->province }}">
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
                                <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{ $association->fiscal_code }}">
                            </div>
                            <div class="form-group">
                                <label for="vat_number">Partita IVA</label>
                                <input type="text" name="vat_number" id="vat_number" class="form-control" value="{{ $association->vat_number }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $association->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control" value="{{ $association->fax }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>&nbsp;</h5>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $association->email }}">
                            </div>
                            <div class="form-group">
                                <label for="website">Sito Web</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ $association->website }}">
                            </div>
                            <div class="form-group">
                                <label for="other">Altro</label>
                                <textarea name="other" id="other" class="form-control" rows="3">{{ $association->other }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="{{ route('associations.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection