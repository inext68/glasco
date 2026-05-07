<?php $__env->startSection('title', 'Crea Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Configura Report</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('reports.generate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="model" value="<?php echo e($modelType); ?>">

                    <div class="form-group">
                        <label>Seleziona modello</label>
                        <select name="model" id="modelSelect" class="form-control">
                            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($model); ?>" <?php echo e($modelType === $model ? 'selected' : ''); ?>><?php echo e(ucfirst($model)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <?php if(!empty($fields)): ?>
                    <div class="form-group">
                        <label>Campi da visualizzare</label>
                        <div class="row">
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="fields[]" value="<?php echo e($field); ?>" id="field_<?php echo e($field); ?>" class="form-check-input" checked>
                                    <label for="field_<?php echo e($field); ?>" class="form-check-label"><?php echo e($label); ?></label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($relations)): ?>
                    <div class="form-group">
                        <label>Relazioni da includere</label>
                        <div class="row">
                            <?php $__currentLoopData = $relations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="relations[]" value="<?php echo e($relation); ?>" id="rel_<?php echo e($relation); ?>" class="form-check-input">
                                    <label for="rel_<?php echo e($relation); ?>" class="form-check-label"><?php echo e($label); ?></label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($filters)): ?>
                    <div class="form-group">
                        <label>Filtri</label>
                        <div class="row">
                            <?php if(isset($filters['role_id'])): ?>
                            <div class="col-md-4">
                                <select name="filters[role_id]" class="form-control">
                                    <option value="">Tutti i ruoli</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($filters['system_role_id'])): ?>
                            <div class="col-md-4">
                                <select name="filters[system_role_id]" class="form-control">
                                    <option value="">Tutti i ruoli sistema</option>
                                    <?php $__currentLoopData = $systemRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sr->id); ?>"><?php echo e($sr->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($filters['association_id'])): ?>
                            <div class="col-md-4">
                                <select name="filters[association_id]" class="form-control">
                                    <option value="">Tutte le associazioni</option>
                                    <?php $__currentLoopData = $associations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($assoc->id); ?>"><?php echo e($assoc->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($filters['group_id'])): ?>
                            <div class="col-md-4">
                                <select name="filters[group_id]" class="form-control">
                                    <option value="">Tutti i gruppi</option>
                                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($filters['diocese_id'])): ?>
                            <div class="col-md-4">
                                <select name="filters[diocese_id]" class="form-control">
                                    <option value="">Tutte le diocesi</option>
                                    <?php $__currentLoopData = $dioceses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diocese): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($diocese->id); ?>"><?php echo e($diocese->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Genera Report</button>
                    <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
document.getElementById('modelSelect').addEventListener('change', function() {
    window.location.href = '<?php echo e(route('reports.create')); ?>?model=' + this.value;
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/reports/create.blade.php ENDPATH**/ ?>