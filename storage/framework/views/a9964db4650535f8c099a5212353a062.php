<?php $__env->startSection('title', 'Dettagli Persona'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dettagli Persona</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><?php echo e($person->first_name); ?></dd>
                    
                    <dt class="col-sm-3">Cognome</dt>
                    <dd class="col-sm-9"><?php echo e($person->last_name); ?></dd>
                    
                    <dt class="col-sm-3">Data di Nascita</dt>
                    <dd class="col-sm-9"><?php echo e($person->birth_date ? $person->birth_date->format('d/m/Y') : '-'); ?></dd>
                    
                    <dt class="col-sm-3">Genere</dt>
                    <dd class="col-sm-9"><?php echo e($person->gender ?? '-'); ?></dd>
                    
                    <dt class="col-sm-3">Note</dt>
                    <dd class="col-sm-9"><?php echo e($person->notes ?? '-'); ?></dd>
                </dl>
                
                <h4 class="mt-4">Contatti</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Etichetta</th>
                            <th>Valore</th>
                            <th>Primario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $person->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($contact->type); ?></td>
                            <td><?php echo e($contact->label); ?></td>
                            <td><?php echo e($contact->value); ?></td>
                            <td><?php echo e($contact->is_primary ? 'Sì' : 'No'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4">Nessun contatto</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                
                <h4 class="mt-4">Ruoli</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Ruolo</th>
                            <th>Entità</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $person->personRoleAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($assignment->role->name ?? '-'); ?></td>
                            <td><?php echo e($assignment->entity_type ?? '-'); ?></td>
                            <td><?php echo e($assignment->start_date ? $assignment->start_date->format('d/m/Y') : '-'); ?></td>
                            <td><?php echo e($assignment->end_date ? $assignment->end_date->format('d/m/Y') : '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4">Nessun ruolo assegnato</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('persons.index')); ?>" class="btn btn-secondary">Torna alla lista</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/persons/show.blade.php ENDPATH**/ ?>