<?php $__env->startSection('title', 'Modifica Contatto'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifica Contatto</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('contacts.update', $contact->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="person_id">Persona</label>
                        <select name="person_id" id="person_id" class="form-control" required>
                            <?php $__currentLoopData = \App\Models\Person::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($person->id); ?>" <?php echo e($contact->person_id == $person->id ? 'selected' : ''); ?>><?php echo e($person->first_name); ?> <?php echo e($person->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="email" <?php echo e($contact->type == 'email' ? 'selected' : ''); ?>>Email</option>
                            <option value="phone" <?php echo e($contact->type == 'phone' ? 'selected' : ''); ?>>Telefono</option>
                            <option value="address" <?php echo e($contact->type == 'address' ? 'selected' : ''); ?>>Indirizzo</option>
                            <option value="website" <?php echo e($contact->type == 'website' ? 'selected' : ''); ?>>Sito Web</option>
                            <option value="other" <?php echo e($contact->type == 'other' ? 'selected' : ''); ?>>Altro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label">Etichetta</label>
                        <input type="text" name="label" id="label" class="form-control" value="<?php echo e($contact->label); ?>">
                    </div>
                    <div class="form-group">
                        <label for="value">Valore</label>
                        <input type="text" name="value" id="value" class="form-control" value="<?php echo e($contact->value); ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" value="1" <?php echo e($contact->is_primary ? 'checked' : ''); ?>>
                            <label for="is_primary" class="form-check-label">Contatto primario</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                    <a href="<?php echo e(route('contacts.index')); ?>" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/contacts/edit.blade.php ENDPATH**/ ?>