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
                            <?php $__currentLoopData = \App\Models\Person::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($person->id); ?>"><?php echo e($person->first_name); ?> <?php echo e($person->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Ruolo</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <?php $__currentLoopData = \App\Models\Role::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_type">Tipo Entità</label>
                        <select name="entity_type" id="entity_type" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="App\Models\Association">Associazione</option>
                            <option value="App\Models\Group">Gruppo</option>
                            <option value="App\Models\Diocese">Diocesi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entity_id">ID Entità</label>
                        <input type="number" name="entity_id" id="entity_id" class="form-control">
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/person role assignments/create.blade.php ENDPATH**/ ?>