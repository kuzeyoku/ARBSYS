<tr>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td class="vertical-top">TARAFLAR</td>
    <td class="vertical-top">:</td>
    <td>
        <?php $count = 1 ?>
        <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                <strong><?php echo $count != 1 ? '<br>' : ''; ?><?php echo e($count); ?>

                    <?php echo e(App\Services\HelperService::nameFormat($claimant->detail->name)); ?> (T.C. Kimlik No:
                    <?php echo e($claimant->detail->identification); ?>)</strong><br>
                <?php echo e(App\Services\HelperService::addressFormat($claimant->detail->address)); ?><br>
            <?php elseif($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
                <strong><?php echo $count != 1 ? '<br>' : ''; ?><?php echo e($count); ?>

                    <?php echo e(App\Services\HelperService::nameFormat($claimant->detail->name)); ?></strong><br>
                <strong>(Mersis No: <?php echo e($claimant->detail->mersis_number); ?>) (<?php echo e($claimant->detail->tax_office); ?> V.D.
                    <?php echo e($claimant->detail->tax_number); ?>)</strong><br>
                <?php echo e(App\Services\HelperService::addressFormat($claimant->detail->address)); ?><br>
            <?php endif; ?>
            <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <strong><?php echo e($side->applicant_title_case); ?></strong><br>
                <strong><?php echo e($side->detail->name); ?> (T.C. Kimlik No: <?php echo e($side->detail->identification); ?>)</strong><br>
                <?php echo !is_null($side->detail->address)
                    ? App\Services\HelperService::addressFormat($side->detail->address) . '<br>'
                    : ''; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($sides) && !is_null($sides)): ?>
                <?php $__currentLoopData = $sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($side['side_id'] == $claimant->id): ?>
                        <strong><?php echo e($side['title']); ?></strong><br>
                        <strong><?php echo e($side['name']); ?></strong><br>
                        <?php echo e($side['address']); ?><br>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php $count++ ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                <strong><?php echo $count != 1 ? '<br>' : ''; ?><?php echo e($count); ?>

                    <?php echo e(App\Services\HelperService::nameFormat($defendant->detail->name)); ?> (T.C. Kimlik No:
                    <?php echo e($defendant->detail->identification); ?>)</strong><br>
                <?php echo e(App\Services\HelperService::addressFormat($defendant->detail->address)); ?><br>
            <?php elseif($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
                <strong><?php echo $count != 1 ? '<br>' : ''; ?><?php echo e($count); ?>

                    <?php echo e(App\Services\HelperService::nameFormat($defendant->detail->name)); ?></strong><br>
                <strong>(Mersis No: <?php echo e($defendant->detail->mersis_number); ?>) (<?php echo e($defendant->detail->tax_office); ?>

                    V.D. <?php echo e($defendant->detail->tax_number); ?>)</strong><br>
                <?php echo e(App\Services\HelperService::addressFormat($defendant->detail->address)); ?><br>
            <?php endif; ?>
            <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <strong><?php echo e($side->applicant_title_case); ?></strong><br>
                <strong><?php echo e(App\Service\HelperService::nameFormat($side->detail->name)); ?> (T.C. Kimlik No:
                    <?php echo e($side->detail->identification); ?>)</strong><br>
                <?php echo !is_null($side->detail->address)
                    ? App\Services\HelperService::addressFormat($side->detail->address) . '<br>'
                    : ''; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($sides) && !is_null($sides)): ?>
                <?php $__currentLoopData = $sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($side['side_id'] == $defendant->id): ?>
                        <strong><?php echo e($side['title']); ?></strong><br>
                        <strong><?php echo e($side['name']); ?></strong><br>
                        <?php echo e($side['address']); ?><br>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php $count++ ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
</tr>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/sides.blade.php ENDPATH**/ ?>