<?php $__env->startSection('title', 'Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Genera Report</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="<?php echo e(route('reports.create', ['model' => 'person'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-users"></i> Report Persone
                    </a>
                    <a href="<?php echo e(route('reports.create', ['model' => 'association'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-building"></i> Report Associazioni
                    </a>
                    <a href="<?php echo e(route('reports.create', ['model' => 'group'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-users"></i> Report Gruppi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/reports/index.blade.php ENDPATH**/ ?>