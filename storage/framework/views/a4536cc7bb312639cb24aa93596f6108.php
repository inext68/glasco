<?php $__env->startSection('title', 'Dettagli Assegnazione Ruolo'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Assegnazione Ruolo</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Persona</dt>
                    <dd class="col-sm-9"><?php echo e($personRoleAssignment->person->last_name ?? ''); ?> <?php echo e($personRoleAssignment->person->first_name ?? '-'); ?></dd>
                    <dt class="col-sm-3">Ruolo</dt>
                    <dd class="col-sm-9"><?php echo e($personRoleAssignment->role->name ?? '-'); ?></dd>
                    <dt class="col-sm-3">Entità</dt>
                    <dd class="col-sm-9">
                        <?php if($personRoleAssignment->entity): ?>
                            <?php echo e($personRoleAssignment->entity->name); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </dd>
                    <dt class="col-sm-3">Data Inizio</dt>
                    <dd class="col-sm-9"><?php echo e($personRoleAssignment->start_date ? $personRoleAssignment->start_date->format('d/m/Y') : '-'); ?></dd>
                    <dt class="col-sm-3">Data Fine</dt>
                    <dd class="col-sm-9"><?php echo e($personRoleAssignment->end_date ? $personRoleAssignment->end_date->format('d/m/Y') : '-'); ?></dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('person-role-assignments.index')); ?>" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/person role assignments/show.blade.php ENDPATH**/ ?>