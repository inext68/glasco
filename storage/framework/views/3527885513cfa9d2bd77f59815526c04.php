<?php $__env->startSection('title', 'Dettagli Media'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Media</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nome File</dt>
                    <dd class="col-sm-8"><?php echo e($media->file_name); ?></dd>
                    <dt class="col-sm-4">Tipo MIME</dt>
                    <dd class="col-sm-8"><?php echo e($media->mime_type ?? '-'); ?></dd>
                    <dt class="col-sm-4">Hash</dt>
                    <dd class="col-sm-8"><small class="text-muted"><?php echo e($media->file_hash); ?></small></dd>
                    <dt class="col-sm-4">Caricato da</dt>
                    <dd class="col-sm-8"><?php echo e($media->uploadedBy->surname ?? ''); ?> <?php echo e($media->uploadedBy->name ?? '-'); ?></dd>
                    <dt class="col-sm-4">Entità</dt>
                    <dd class="col-sm-8"><?php echo e($media->mediaable_type ?? '-'); ?></dd>
                </dl>
                <hr>
                <?php if($media->isImage()): ?>
                <div class="text-center">
                    <img src="<?php echo e($media->url()); ?>" alt="<?php echo e($media->file_name); ?>" class="img-fluid" style="max-width: 100%;">
                </div>
                <?php elseif($media->isPdf()): ?>
                <div class="text-center">
                    <a href="<?php echo e($media->url()); ?>" target="_blank" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> Apri PDF
                    </a>
                </div>
                <?php else: ?>
                <div class="text-center">
                    <a href="<?php echo e($media->url()); ?>" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download"></i> Scarica File
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('media.index')); ?>" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/media/show.blade.php ENDPATH**/ ?>