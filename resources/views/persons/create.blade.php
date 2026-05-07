@extends('adminlte::page')

@section('title', 'Nuova Persona')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Persona</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('persons.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Nome</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Cognome</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Data di Nascita</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gender">Genere</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="M">Maschio</option>
                                    <option value="F">Femmina</option>
                                    <option value="Altro">Altro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Note</label>
                                <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street">Via</label>
                                <input type="text" name="street" id="street" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="postal_code">CAP</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control" maxlength="10">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Città</label>
                                    <input type="text" name="city" id="city" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="province">Sigla Provincia</label>
                                    <input type="text" name="province" id="province" class="form-control" maxlength="2">
                                </div>
                            </div>
                            <hr>
                            <h5>Documento d'identità</h5>
                            <div class="form-group">
                                <label for="document_type">Tipo Documento</label>
                                <select name="document_type" id="document_type" class="form-control">
                                    <option value="">Seleziona...</option>
                                    <option value="Carta d'identità">Carta d'identità</option>
                                    <option value="Patente">Patente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="document_number">Numero Documento</label>
                                <input type="text" name="document_number" id="document_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Contatti</h5>
                    <div id="contacts-container">
                        <div class="row contact-row mb-2">
                            <div class="col-md-3">
                                <select name="contacts[0][type]" class="form-control">
                                    <option value="">Seleziona tipo...</option>
                                    <option value="Email">Email</option>
                                    <option value="Telefono">Telefono</option>
                                    <option value="Cellulare">Cellulare</option>
                                    <option value="Fax">Fax</option>
                                    <option value="Indirizzo">Indirizzo</option>
                                    <option value="Social">Social</option>
                                    <option value="Sito web">Sito web</option>
                                    <option value="Altro">Altro</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="contacts[0][label]" class="form-control" placeholder="Etichetta (es. lavoro)">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="contacts[0][value]" class="form-control" placeholder="Valore">
                            </div>
                            <div class="col-md-1">
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="contacts[0][is_primary]" class="form-check-input" value="1">
                                    <label class="form-check-label">Primario</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-remove-contact" title="Rimuovi">×</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-contact" class="btn btn-secondary btn-sm mb-3">+ Aggiungi contatto</button>
                    <hr>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="{{ route('persons.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let contactIndex = 1;
    
    document.getElementById('add-contact').addEventListener('click', function() {
        const container = document.getElementById('contacts-container');
        const row = document.createElement('div');
        row.className = 'row contact-row mb-2';
        row.innerHTML = `
            <div class="col-md-3">
                <select name="contacts[${contactIndex}][type]" class="form-control">
                    <option value="">Seleziona tipo...</option>
                    <option value="Email">Email</option>
                    <option value="Telefono">Telefono</option>
                    <option value="Cellulare">Cellulare</option>
                    <option value="Fax">Fax</option>
                    <option value="Indirizzo">Indirizzo</option>
                    <option value="Social">Social</option>
                    <option value="Sito web">Sito web</option>
                    <option value="Altro">Altro</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="contacts[${contactIndex}][label]" class="form-control" placeholder="Etichetta (es. lavoro)">
            </div>
            <div class="col-md-4">
                <input type="text" name="contacts[${contactIndex}][value]" class="form-control" placeholder="Valore">
            </div>
            <div class="col-md-1">
                <div class="form-check mt-2">
                    <input type="checkbox" name="contacts[${contactIndex}][is_primary]" class="form-check-input" value="1">
                    <label class="form-check-label">Primario</label>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-remove-contact" title="Rimuovi">×</button>
            </div>
        `;
        container.appendChild(row);
        contactIndex++;
        
        row.querySelector('.btn-remove-contact').addEventListener('click', function() {
            row.remove();
        });
    });
    
    document.querySelectorAll('.btn-remove-contact').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.closest('.contact-row').remove();
        });
    });
});
</script>
@endsection