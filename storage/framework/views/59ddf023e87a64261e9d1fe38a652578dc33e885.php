<?php ($id = 'datatable-' . uniqid()); ?>
<table id="<?php echo e($id, false); ?>" <?php echo $attributes; ?> style="width:100%">
    <thead>
    <tr>
        <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($header, false); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo $item; ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script>
    $(function () {
        $('#<?php echo e($id, false); ?>').DataTable(
            <?php echo $options; ?>

        )
    })
</script>
<?php /**PATH /home/webapps/anri.siap/vendor/jxlwqq/data-table/src/../resources/views/index.blade.php ENDPATH**/ ?>