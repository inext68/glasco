<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                <a href="<?php echo e(route('persons.index')); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold"><?php echo e($stats['persons']); ?></div>
                    <div class="text-sm"><?php echo e(__('Persone')); ?></div>
                </a>
                <a href="<?php echo e(route('associations.index')); ?>" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold"><?php echo e($stats['associations']); ?></div>
                    <div class="text-sm"><?php echo e(__('Associazioni')); ?></div>
                </a>
                <a href="<?php echo e(route('groups.index')); ?>" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold"><?php echo e($stats['groups']); ?></div>
                    <div class="text-sm"><?php echo e(__('Gruppi')); ?></div>
                </a>
                <a href="<?php echo e(route('dioceses.index')); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold"><?php echo e($stats['dioceses']); ?></div>
                    <div class="text-sm"><?php echo e(__('Diocesi')); ?></div>
                </a>
                <a href="<?php echo e(route('media.index')); ?>" class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold"><?php echo e($stats['media']); ?></div>
                    <div class="text-sm"><?php echo e(__('Media')); ?></div>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4"><?php echo e(__('Benvenuto nella dashboard')); ?></h3>
                    <p><?php echo e(__('Da qui puoi gestire tutte le risorse del sistema.')); ?></p>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /var/www/html/glasco/resources/views/dashboard.blade.php ENDPATH**/ ?>