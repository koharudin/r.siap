<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php echo e($e->showPhoto(), false); ?>" alt="User profile picture">
                <h3 class="profile-username text-center"><?php echo e($e->first_name, false); ?></h3>
                <p class="text-muted text-center"><?php echo e($e->nip_baru, false); ?></p>
                <ul class="list-group list-group-unbordered">
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="btn btn-default btn-block" href="<?php echo e(url('/admin/profile',[request('profile_id'),$v]), false); ?>">
                        <i class=""></i> <?php echo e($k, false); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <?php echo $g; ?>

    </div>
</div><?php /**PATH /home/webapps/anri.siap/resources/views/v_profile_sidebar.blade.php ENDPATH**/ ?>