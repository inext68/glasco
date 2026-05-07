<?php $__env->startSection('title', 'Modifica Ruolo'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('roles.update', $role->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo e($role->name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="context">Contesto</label>
                        <input type="text" name="context" id="context" class="form-control" value="<?php echo e($role->context); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="3"><?php echo e($role->description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1" <?php echo e($role->is_primary ? 'checked' : ''); ?>>
                            <label for="is_primary" class="form-check-label">Ruolo primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/roles/edit.blade.php ENDPATH**/ ?>