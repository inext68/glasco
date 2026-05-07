@extends('adminlte::page')

@section('title', 'Dettagli Associazione')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Associazione</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $association->name }}</dd>
                    <dt class="col-sm-3">Nazione</dt>
                    <dd class="col-sm-9">{{ $association->nation ?? '-' }}</dd>
                    <dt class="col-sm-3">Tipo</dt>
                    <dd class="col-sm-9">{{ $association->type ?? '-' }}</dd>
                </dl>
                <hr>
                <h5>Indirizzo</h5>
                <dl class="row">
                    <dt class="col-sm-3">Via</dt>
                    <dd class="col-sm-9">{{ $association->address ?? '-' }}</dd>
                    <dt class="col-sm-3">CAP</dt>
                    <dd class="col-sm-9">{{ $association->cap ?? '-' }}</dd>
                    <dt class="col-sm-3">Città</dt>
                    <dd class="col-sm-9">{{ $association->city ?? '-' }}</dd>
                    <dt class="col-sm-3">Provincia</dt>
                    <dd class="col-sm-9">{{ $association->province ?? '-' }}</dd>
                </dl>
                <hr>
                <h5>Contatti</h5>
                <dl class="row">
                    <dt class="col-sm-3">Codice Fiscale</dt>
                    <dd class="col-sm-9">{{ $association->fiscal_code ?? '-' }}</dd>
                    <dt class="col-sm-3">Partita IVA</dt>
                    <dd class="col-sm-9">{{ $association->vat_number ?? '-' }}</dd>
                    <dt class="col-sm-3">Telefono</dt>
                    <dd class="col-sm-9">{{ $association->phone ?? '-' }}</dd>
                    <dt class="col-sm-3">Fax</dt>
                    <dd class="col-sm-9">{{ $association->fax ?? '-' }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $association->email ?? '-' }}</dd>
                    <dt class="col-sm-3">Sito Web</dt>
                    <dd class="col-sm-9">{{ $association->website ?? '-' }}</dd>
                    <dt class="col-sm-3">Altro</dt>
                    <dd class="col-sm-9">{{ $association->other ?? '-' }}</dd>
                </dl>
                <hr>
                <h5>Gruppi collegati</h5>
                <table class="table table-bordered table-hover" id="groups_table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Diocesi</th>
                            <th>Giorno ritrovo</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($association->groups as $group)
                        <tr id="group-row-{{ $group->id }}">
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->diocese->name ?? '-' }}</td>
                            <td>{{ $group->meeting_day ?? '-' }}</td>
                            <td>
                                <a href="{{ route('groups.show', $group->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                                <button type="button" class="btn btn-sm btn-danger remove_group" data-id="{{ $group->id }}">Rimuovi</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Nessun gruppo collegato</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('associations.edit', $association->id) }}" class="btn btn-primary">Modifica</a>
                <a href="{{ route('associations.index') }}" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const associationId = {{ $association->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.remove_group').forEach(btn => {
        const groupId = btn.dataset.id;
        btn.addEventListener('click', async function() {
            if (!confirm('Sei sicuro di voler rimuovere questa associazione dal gruppo?')) return;
            
            try {
                const response = await fetch(`/groups/${groupId}/associations/${associationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const row = document.getElementById(`group-row-${groupId}`);
                    if (row) row.remove();
                    
                    const tbody = document.querySelector('#groups_table tbody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nessun gruppo collegato</td></tr>';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Errore durante la rimozione');
            }
        });
    });
});
</script>
@endsection