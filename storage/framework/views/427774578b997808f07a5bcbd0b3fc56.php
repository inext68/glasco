<?php $__env->startSection('title', 'Nuova Persona'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuova Persona</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('persons.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="first_name">Nome</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Cognome</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Data di Nascita</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender">Genere</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Seleziona...</option>
                            <option value="M">Maschio</option>
                            <option value="F">Femmina</option>
                            <option value="Altro">Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Note</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                    <a href="<?php echo e(route('persons.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/persons/create.blade.php ENDPATH**/ ?>