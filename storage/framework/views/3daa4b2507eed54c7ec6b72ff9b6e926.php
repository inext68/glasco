<?php $__env->startSection('title', 'Nuovo Ruolo'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Ruolo</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('roles.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="context">Contesto</label>
                        <input type="text" name="context" id="context" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1">
                            <label for="is_primary" class="form-check-label">Ruolo primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/roles/create.blade.php ENDPATH**/ ?>