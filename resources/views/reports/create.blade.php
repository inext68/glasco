@extends('adminlte::page')

@section('title', 'Crea Report')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Configura Report</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="model" value="{{ $modelType }}">

                    <div class="form-group">
                        <label>Seleziona modello</label>
                        <select name="model" id="modelSelect" class="form-control">
                            @foreach($models as $model)
                            <option value="{{ $model }}" {{ $modelType === $model ? 'selected' : '' }}>{{ ucfirst($model) }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(!empty($fields))
                    <div class="form-group">
                        <label>Campi da visualizzare</label>
                        <div class="row">
                            @foreach($fields as $field => $label)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="fields[]" value="{{ $field }}" id="field_{{ $field }}" class="form-check-input" checked>
                                    <label for="field_{{ $field }}" class="form-check-label">{{ $label }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(!empty($relations))
                    <div class="form-group">
                        <label>Relazioni da includere</label>
                        <div class="row">
                            @foreach($relations as $relation => $label)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="relations[]" value="{{ $relation }}" id="rel_{{ $relation }}" class="form-check-input">
                                    <label for="rel_{{ $relation }}" class="form-check-label">{{ $label }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(!empty($filters))
                    <div class="form-group">
                        <label>Filtri</label>
                        <div class="row">
                            @if(isset($filters['role_id']))
                            <div class="col-md-4">
                                <select name="filters[role_id]" class="form-control">
                                    <option value="">Tutti i ruoli</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if(isset($filters['system_role_id']))
                            <div class="col-md-4">
                                <select name="filters[system_role_id]" class="form-control">
                                    <option value="">Tutti i ruoli sistema</option>
                                    @foreach($systemRoles as $sr)
                                    <option value="{{ $sr->id }}">{{ $sr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if(isset($filters['association_id']))
                            <div class="col-md-4">
                                <select name="filters[association_id]" class="form-control">
                                    <option value="">Tutte le associazioni</option>
                                    @foreach($associations as $assoc)
                                    <option value="{{ $assoc->id }}">{{ $assoc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if(isset($filters['group_id']))
                            <div class="col-md-4">
                                <select name="filters[group_id]" class="form-control">
                                    <option value="">Tutti i gruppi</option>
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            @if(isset($filters['diocese_id']))
                            <div class="col-md-4">
                                <select name="filters[diocese_id]" class="form-control">
                                    <option value="">Tutte le diocesi</option>
                                    @foreach($dioceses as $diocese)
                                    <option value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Genera Report</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('modelSelect').addEventListener('change', function() {
    window.location.href = '{{ route('reports.create') }}?model=' + this.value;
});
</script>
@endsection