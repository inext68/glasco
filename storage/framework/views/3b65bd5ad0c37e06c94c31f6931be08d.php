<?php $__env->startSection('title', 'Contatti'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contatti</h3>
                <a href="<?php echo e(route('contacts.create')); ?>" class="btn btn-primary float-right">Nuovo Contatto</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Tipo</th>
                            <th>Etichetta</th>
                            <th>Valore</th>
                            <th>Primario</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($contact->person->first_name ?? '-'); ?> <?php echo e($contact->person->last_name ?? ''); ?></td>
                            <td><?php echo e($contact->type); ?></td>
                            <td><?php echo e($contact->label); ?></td>
                            <td>
                                <?php if($contact->type === 'phone'): ?>
                                    <a href="tel:<?php echo e($contact->value); ?>"><?php echo e($contact->value); ?></a>
                                <?php elseif($contact->type === 'email'): ?>
                                    <a href="mailto:<?php echo e($contact->value); ?>"><?php echo e($contact->value); ?></a>
                                <?php elseif(preg_match('/^(https?:\/\/|ftp:\/\/|whatsapp:|telegram:|tel:|mailto:)/i', $contact->value)): ?>
                                    <a href="<?php echo e($contact->value); ?>" target="_blank" rel="noopener"><?php echo e($contact->value); ?></a>
                                <?php else: ?>
                                    <?php echo e($contact->value); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($contact->is_primary ? 'Sì' : 'No'); ?></td>
                            <td>
                                <a href="<?php echo e(route('contacts.show', $contact->id)); ?>" class="btn btn-sm btn-info">Visualizza</a>
                                <a href="<?php echo e(route('contacts.edit', $contact->id)); ?>" class="btn btn-sm btn-warning">Modifica</a>
                                <form action="<?php echo e(route('contacts.destroy', $contact->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($contacts->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/contacts/index.blade.php ENDPATH**/ ?>