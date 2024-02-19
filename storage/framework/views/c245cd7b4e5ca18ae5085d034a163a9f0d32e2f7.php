<?php $__currentLoopData = $lawsuit->sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
        <strong><?php echo e($loop->iteration . ') ' . App\Services\HelperService::nameFormat($side->detail->name)); ?></strong>
        (T.C. Kimlik
        No: <strong><?php echo e($side->detail->identification); ?></strong>)<br>
    <?php elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
        <strong><?php echo e($loop->iteration . ') ' . App\Services\HelperService::nameFormat($side->detail->name)); ?></strong><br>
        (Mersis No: <strong><?php echo e($side->detail->mersis_number); ?></strong>)
        (<strong><?php echo e($side->detail->tax_office); ?></strong>
        V.D. <strong><?php echo e($side->detail->tax_number); ?></strong>)<br>
    <?php endif; ?>
    <?php echo e(App\Services\HelperService::addressFormat($side->detail->address)); ?>

    <br>
    <?php if($side->sub_sides->count() > 0): ?>
        <?php if($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
            <strong>Vekili</strong> <br>
        <?php elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
            <strong>Vekili/Yetkilisi</strong> <br>
        <?php endif; ?>
        <?php $__currentLoopData = $side->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <strong><?php echo e(App\Services\HelperService::nameFormat($sub_side->detail->name)); ?></strong> (T.C. Kimlik
            No: <strong><?php echo e($sub_side->detail->identification); ?></strong>)
            <?php echo e(App\Services\HelperService::addressFormat($sub_side->detail->address)); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(!$loop->last): ?>
        <br><br>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/layout/sides.blade.php ENDPATH**/ ?>