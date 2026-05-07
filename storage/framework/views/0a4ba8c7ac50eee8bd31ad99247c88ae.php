<?php $__env->startSection('title', 'Persone'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Persone</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#columnsModal">
                        <i class="fas fa-cog"></i> Colonne
                    </button>
                    <a href="<?php echo e(route('persons.create')); ?>" class="btn btn-primary btn-sm">Nuova Persona</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <?php if(in_array('unique_code', $visibleColumns)): ?><th>Codice</th><?php endif; ?>
                            <?php if(in_array('first_name', $visibleColumns)): ?><th>Nome</th><?php endif; ?>
                            <?php if(in_array('last_name', $visibleColumns)): ?><th>Cognome</th><?php endif; ?>
                            <?php if(in_array('birth_date', $visibleColumns)): ?><th>Data di Nascita</th><?php endif; ?>
                            <?php if(in_array('gender', $visibleColumns)): ?><th>Genere</th><?php endif; ?>
                            <?php if(in_array('city', $visibleColumns)): ?><th>Città</th><?php endif; ?>
                            <?php if(in_array('contacts', $visibleColumns)): ?><th>Contatti</th><?php endif; ?>
                            <?php if(in_array('created_at', $visibleColumns)): ?><th>Creato il</th><?php endif; ?>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if(in_array('unique_code', $visibleColumns)): ?><td><?php echo e($person->unique_code); ?></td><?php endif; ?>
                            <?php if(in_array('first_name', $visibleColumns)): ?><td><?php echo e($person->first_name); ?></td><?php endif; ?>
                            <?php if(in_array('last_name', $visibleColumns)): ?><td><?php echo e($person->last_name); ?></td><?php endif; ?>
                            <?php if(in_array('birth_date', $visibleColumns)): ?><td><?php echo e($person->birth_date ? $person->birth_date->format('d/m/Y') : '-'); ?></td><?php endif; ?>
                            <?php if(in_array('gender', $visibleColumns)): ?><td><?php echo e($person->gender ?? '-'); ?></td><?php endif; ?>
                            <?php if(in_array('city', $visibleColumns)): ?><td><?php echo e($person->city ?? '-'); ?></td><?php endif; ?>
                            <?php if(in_array('contacts', $visibleColumns)): ?>
                            <td>
                                <?php $primaryContact = $person->contacts->where('is_primary', true)->first() ?>
                                <?php echo e($primaryContact ? $primaryContact->value : ($person->contacts->first()->value ?? '-')); ?>

                            </td>
                            <?php endif; ?>
                            <?php if(in_array('created_at', $visibleColumns)): ?><td><?php echo e($person->created_at ? $person->created_at->format('d/m/Y') : '-'); ?></td><?php endif; ?>
                            <td>
                                <a href="<?php echo e(route('persons.show', $person->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('persons.edit', $person->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('persons.destroy', $person->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($persons->links()); ?>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="columnsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleziona Colonne</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="columnsForm">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <?php $__currentLoopData = $availableColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="<?php echo e($col); ?>" class="form-check-input" id="col_<?php echo e($col); ?>" <?php echo e(in_array($col, $visibleColumns) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="col_<?php echo e($col); ?>"><?php echo e($columnLabels[$col]); ?></label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveColumns">Salva</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    document.getElementById('saveColumns').addEventListener('click', async function() {
        const checkboxes = document.querySelectorAll('input[name="columns[]"]:checked');
        const columns = Array.from(checkboxes).map(cb => cb.value);
        
        if (columns.length === 0) {
            alert('Seleziona almeno una colonna');
            return;
        }
        
        try {
            const url = '<?php echo e(route("profile.update")); ?>';
            console.log('Fetching URL:', url);
            
            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    column_settings: {
                        persons_columns: columns
                    }
                })
            });
            
            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);
            
            if (!response.ok) {
                const errorText = await response.text();
                console.log('Error response:', errorText);
                alert('Errore HTTP ' + response.status + ': ' + errorText);
                return;
            }
            
            const data = await response.json();
            console.log('Data:', data);
            
            if (data.success) {
                location.reload();
            } else {
                alert('Errore durante il salvataggio: ' + (data.message || ''));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Errore durante il salvataggio: ' + error.message);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/persons/index.blade.php ENDPATH**/ ?>