<?php $__env->startSection('title', 'Assegnazioni Ruoli'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assegnazioni Ruoli</h3>
                <a href="<?php echo e(route('person-role-assignments.create')); ?>" class="btn btn-primary float-right">Nuova Assegnazione</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Ruolo</th>
                            <th>Entità</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($assignment->person->first_name ?? '-'); ?> <?php echo e($assignment->person->last_name ?? ''); ?></td>
                            <td><?php echo e($assignment->role->name ?? '-'); ?></td>
                            <td><?php echo e($assignment->entity_type ?? '-'); ?></td>
                            <td><?php echo e($assignment->start_date ? $assignment->start_date->format('d/m/Y') : '-'); ?></td>
                            <td><?php echo e($assignment->end_date ? $assignment->end_date->format('d/m/Y') : '-'); ?></td>
                            <td>
                                <a href="<?php echo e(route('person-role-assignments.show', $assignment->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('person-role-assignments.edit', $assignment->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('person-role-assignments.destroy', $assignment->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($assignments->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/person role assignments/index.blade.php ENDPATH**/ ?>