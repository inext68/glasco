<?php $__env->startSection('title', 'Gruppi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gruppi</h3>
                <a href="<?php echo e(route('groups.create')); ?>" class="btn btn-primary float-right">Nuovo Gruppo</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Diocesi</th>
                            <th>Ritrovo</th>
                            <th>Indirizzo</th>
                            <th>Giorno/Ora</th>
                            <th>Responsabile</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($group->name); ?></td>
                            <td><?php echo e($group->diocese->name ?? '-'); ?></td>
                            <td><?php echo e($group->meeting_place ?? '-'); ?></td>
                            <td>
                                <?php if($group->meeting_address): ?>
                                    <?php echo e($group->meeting_address); ?>, <?php echo e($group->meeting_cap); ?> <?php echo e($group->meeting_city); ?> (<?php echo e($group->meeting_province); ?>)
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($group->meeting_day ?? '-'); ?> <?php echo e($group->meeting_time ? \Carbon\Carbon::parse($group->meeting_time)->format('H:i') : ''); ?></td>
                            <td><?php echo e($group->responsible->last_name ?? ''); ?> <?php echo e($group->responsible->first_name ?? ''); ?></td>
                            <td>
                                <a href="<?php echo e(route('groups.show', $group->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('groups.edit', $group->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('groups.destroy', $group->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($groups->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/groups/index.blade.php ENDPATH**/ ?>