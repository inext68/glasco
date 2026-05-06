<?php $__env->startSection('title', 'Ruoli'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ruoli</h3>
                <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary float-right">Nuovo Ruolo</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Contesto</th>
                            <th>Descrizione</th>
                            <th>Primario</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($role->name); ?></td>
                            <td><?php echo e($role->context ?? '-'); ?></td>
                            <td><?php echo e($role->description ?? '-'); ?></td>
                            <td><?php echo e($role->is_primary ? 'Sì' : 'No'); ?></td>
                            <td>
                                <a href="<?php echo e(route('roles.show', $role->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('roles.edit', $role->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($roles->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/roles/index.blade.php ENDPATH**/ ?>