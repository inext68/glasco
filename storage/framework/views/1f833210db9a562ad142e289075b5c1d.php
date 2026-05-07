<?php $__env->startSection('title', 'Importa Dati'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Importa Dati da CSV</h3>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <form action="<?php echo e(route('import.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="type">Tipo dati da importare</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Seleziona...</option>
                            <option value="persons">Persone</option>
                            <option value="contacts">Contatti (richiede ID persona)</option>
                            <option value="associations">Associazioni</option>
                            <option value="groups">Gruppi</option>
                            <option value="diocesi">Diocesi</option>
                            <option value="role_assignments">Assegnazioni Ruoli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File CSV</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".csv" required>
                        <small class="text-muted">Il file deve essere in formato UTF-8 con intestazione nella prima riga</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Importa</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Template CSV</h3>
            </div>
            <div class="card-body">
                <p>Scarica i template per preparare i tuoi file CSV:</p>
                <div class="list-group">
                    <a href="<?php echo e(route('import.download', ['type' => 'persons'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Persone
                    </a>
                    <a href="<?php echo e(route('import.download', ['type' => 'contacts'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Contatti
                    </a>
                    <a href="<?php echo e(route('import.download', ['type' => 'associations'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Associazioni
                    </a>
                    <a href="<?php echo e(route('import.download', ['type' => 'groups'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Gruppi
                    </a>
                    <a href="<?php echo e(route('import.download', ['type' => 'dioceses'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Diocesi
                    </a>
                    <a href="<?php echo e(route('import.download', ['type' => 'role_assignments'])); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i> Template Assegnazioni Ruoli
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const link = document.getElementById('template-link');
    if (type) {
        link.href = '/import/template?type=' + type;
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/glasco/resources/views/import/index.blade.php ENDPATH**/ ?>