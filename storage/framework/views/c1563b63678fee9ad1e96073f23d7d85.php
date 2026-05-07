<?php $__env->startSection('title', 'Nuova Assegnazione Ruolo'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('person-role-assignments.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <?php $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($person->id); ?>"><?php echo e($person->last_name); ?> <?php echo e($person->first_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Nessuna (ruolo globale)</option>
                            <?php $__currentLoopData = $entityTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>"><?php echo e(ucfirst($type)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">Entità</label>
                        <select name="entity_id" id="entity_id" class="form-control" disabled>
                            <option value="">Seleziona prima il tipo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data Fine</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="<?php echo e(route('person-role-assignments.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
document.getElementById('entity_type').addEventListener('change', function() {
    const type = this.value;
    const entitySelect = document.getElementById('entity_id');
    
    if (!type) {
        entitySelect.innerHTML = '<option value="">Seleziona prima il tipo</option>';
        entitySelect.disabled = true;
        return;
    }
    
    entitySelect.innerHTML = '<option value="">Caricamento...</option>';
    entitySelect.disabled = true;
    
    const url = window.location.origin + '/role-assignments/entities?type=' + type;
    
    window.fetch(url, { credentials: 'same-origin' })
        .then(response => response.json())
        .then(data => {
            entitySelect.innerHTML = '<option value="">Seleziona...</option>';
            if (!data || data.length === 0) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Nessuna entità trovata';
                entitySelect.appendChild(opt);
            } else {
                data.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.textContent = item.name;
                    entitySelect.appendChild(opt);
                });
            }
            entitySelect.disabled = false;
        })
        .catch(err => {
            console.error('Error:', err);
            entitySelect.innerHTML = '<option value="">Errore nel caricamento</option>';
            entitySelect.disabled = false;
        });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/person role assignments/create.blade.php ENDPATH**/ ?>