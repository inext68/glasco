<?php $__env->startSection('title', 'Media'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Media</h3>
                <a href="<?php echo e(route('media.create')); ?>" class="btn btn-primary float-right">Nuovo Media</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Anteprima</th>
                            <th>Nome File</th>
                            <th>Tipo MIME</th>
                            <th>Entità</th>
                            <th>Caricato da</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medium): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center" style="width: 100px;">
                                <?php if($medium->isImage()): ?>
                                <img src="<?php echo e($medium->thumbnailUrl() ?? $medium->url()); ?>" alt="preview" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                <?php elseif($medium->isPdf()): ?>
                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                <?php else: ?>
                                <i class="fas fa-file fa-2x text-muted"></i>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($medium->file_name); ?></td>
                            <td><?php echo e($medium->mime_type ?? '-'); ?></td>
                            <td><?php echo e($medium->mediaable_type ?? '-'); ?></td>
                            <td><?php echo e($medium->uploadedBy->surname ?? ''); ?> <?php echo e($medium->uploadedBy->name ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e($medium->url()); ?>" target="_blank" class="btn btn-sm btn-info">Apri</a>
                                <a href="<?php echo e(route('media.show', $medium->id)); ?>" class="btn btn-sm btn-secondary">Dettagli</a>
                                <form action="<?php echo e(route('media.destroy', $medium->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($media->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/media/index.blade.php ENDPATH**/ ?>