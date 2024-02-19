    <div style="margin-bottom:30px;margin-top:30px" id="content" identifier="content"><?php echo $document_content; ?></div>
    <?php if(isset($lawsuit) && isset($sides)): ?>
        <table class="sides" style="margin-bottom:20px">
            <tr>
                <td class="left">
                    <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h1 class="title">TARAF</h1>
                        <div class="line"><?php echo e(App\Services\HelperService::nameFormat($claimant->detail->name)); ?></div>
                        <?php if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($claimant->id, $sides)): ?>
                            <br><br>
                        <?php endif; ?>

                        <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(in_array($side->id, $sides)): ?>
                                <div class="side" identifier="randomUuid1side">
                                    <div class="line"><?php echo e($side->applicant_title); ?></div>
                                    <div class="line">
                                        <?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td class="right">
                    <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h1 class="title">TARAF</h1>
                        <div class="line"><?php echo e(App\Services\HelperService::nameFormat($defendant->detail->name)); ?></div>
                        <?php if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($defendant->id, $sides)): ?>
                            <br><br>
                        <?php endif; ?>
                        <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($side->id, $sides)): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <div class="side" identifier="randomUuid2side">
                                <div class="line"><?php echo e($side->applicant_title); ?></div>
                                <div class="line"><?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>
    <div class="text-center" id="sub-bottom" identifier="sub-bottom">
        <?php echo $__env->make('mediator.document.mediator_info', ['phone' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/preview.blade.php ENDPATH**/ ?>