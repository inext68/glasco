<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e(\App\Models\Person::count()); ?></h3>
                    <p>Persone</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>
                </div>
                <a href="<?php echo e(route('persons.index')); ?>" class="small-box-footer">Visualizza <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e(\App\Models\Association::count()); ?></h3>
                    <p>Associazioni</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-building"></i>
                </div>
                <a href="<?php echo e(route('associations.index')); ?>" class="small-box-footer">Visualizza <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e(\App\Models\Group::count()); ?></h3>
                    <p>Gruppi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users-cog"></i>
                </div>
                <a href="<?php echo e(route('groups.index')); ?>" class="small-box-footer">Visualizza <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo e(\App\Models\Diocese::count()); ?></h3>
                    <p>Diocesi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-church"></i>
                </div>
                <a href="<?php echo e(route('dioceses.index')); ?>" class="small-box-footer">Visualizza <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Benvenuto</h3>
                </div>
                <div class="card-body">
                    <p>Benvenuto nel pannello di amministrazione GLASCO.</p>
                    <p>Seleziona una sezione dal menu laterale per iniziare.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/home.blade.php ENDPATH**/ ?>