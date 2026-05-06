<?php $__env->startSection('title', 'Nuova Diocesi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Diocesi</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('dioceses.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Paese</label>
                        <input type="text" name="country" id="country" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="region">Regione</label>
                        <input type="text" name="region" id="region" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="city">Città</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="<?php echo e(route('dioceses.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/dioceses/create.blade.php ENDPATH**/ ?>