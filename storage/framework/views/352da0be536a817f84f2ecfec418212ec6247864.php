<?php $__env->startSection('title', __('Server Error')); ?>
<?php $__env->startSection('code', '401'); ?>
<?php $__env->startSection('message', $exception->getMessage()); ?>


<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webapps/anri.siap/resources/views/errors/401.blade.php ENDPATH**/ ?>