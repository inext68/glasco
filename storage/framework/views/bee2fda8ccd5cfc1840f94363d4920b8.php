<?php $__env->startSection('title', 'Diocesi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Diocesi</h3>
                <a href="<?php echo e(route('dioceses.create')); ?>" class="btn btn-primary float-right">Nuova Diocesi</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Paese</th>
                            <th>Regione</th>
                            <th>Città</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dioceses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diocese): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($diocese->name); ?></td>
                            <td><?php echo e($diocese->country ?? '-'); ?></td>
                            <td><?php echo e($diocese->region ?? '-'); ?></td>
                            <td><?php echo e($diocese->city ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(route('dioceses.show', $diocese->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('dioceses.edit', $diocese->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('dioceses.destroy', $diocese->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($dioceses->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/dioceses/index.blade.php ENDPATH**/ ?>