<?php $__env->startSection('title', 'Associazioni'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Associazioni</h3>
                <a href="<?php echo e(route('associations.create')); ?>" class="btn btn-primary float-right">Nuova Associazione</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Nazione</th>
                            <th>Tipo</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $associations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $association): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($association->name); ?></td>
                            <td><?php echo e($association->nation ?? '-'); ?></td>
                            <td><?php echo e($association->type ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(route('associations.show', $association->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('associations.edit', $association->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('associations.destroy', $association->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($associations->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/associations/index.blade.php ENDPATH**/ ?>