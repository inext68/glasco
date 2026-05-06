<?php $__env->startSection('title', 'Nuovo Gruppo'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuovo Gruppo</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('groups.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="diocese_id">Diocesi</label>
                        <select name="diocese_id" id="diocese_id" class="form-control">
                            <option value="">Seleziona...</option>
                            <?php $__currentLoopData = \App\Models\Diocese::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diocese): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($diocese->id); ?>"><?php echo e($diocese->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meeting_place">Luogo di ritrovo</label>
                        <input type="text" name="meeting_place" id="meeting_place" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="meeting_day">Giorno di ritrovo</label>
                        <input type="text" name="meeting_day" id="meeting_day" class="form-control" placeholder="Es. ogni lunedì">
                    </div>
                    <div class="form-group">
                        <label for="meeting_time">Ora del ritrovo</label>
                        <input type="time" name="meeting_time" id="meeting_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="responsible_id">Responsabile</label>
                        <select name="responsible_id" id="responsible_id" class="form-control">
                            <option value="">Seleziona...</option>
                            <?php $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($person->id); ?>"><?php echo e($person->surname); ?> <?php echo e($person->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="<?php echo e(route('groups.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/groups/create.blade.php ENDPATH**/ ?>