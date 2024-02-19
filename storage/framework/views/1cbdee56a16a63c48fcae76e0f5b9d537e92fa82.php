<div class="kt-form__section kt-form__section--first">
    <div class="kt-wizard-v4__form">
        <div class="row">
            <div class="col-md-6">
                <div class="kt-heading kt-heading--md">Başvurucu</div>
                <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                <input type="checkbox" name="side_ids[]" value="<?php echo e($claimant->id); ?>"
                                    data-name="<?php echo e(App\Services\HelperService::nameFormat($claimant->detail->name)); ?>">
                                <?php echo e(App\Services\HelperService::nameFormat($claimant->detail->name)); ?>

                                <span></span>
                            </label>
                        </div>
                    </div>
                    <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                            id="checkbox-<?php echo e($side->id); ?>">
                            <input type="checkbox" name="side_ids[]" value="<?php echo e($side->id); ?>"
                                data-name="<?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?>"
                                <?php echo e($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY && $index == 0 ? 'checked' : ''); ?>>
                            <?php echo e($side->applicant_title); ?> -
                            <?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?>

                            <span></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="kt-heading kt-heading--md">Diğer Taraf</div>
                <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                <input type="checkbox" name="side_ids[]" value="<?php echo e($defendant->id); ?>"
                                    data-name="<?php echo e(App\Services\HelperService::nameFormat($defendant->detail->name)); ?>">
                                <?php echo e(App\Services\HelperService::nameFormat($defendant->detail->name)); ?>

                                <span></span>
                            </label>
                        </div>
                    </div>
                    <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                            id="checkbox-<?php echo e($side->id); ?>">
                            <input type="checkbox" name="side_ids[]" value="<?php echo e($side->id); ?>"
                                data-name="<?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?>"
                                <?php echo e($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY && $index == 0 ? 'checked' : ''); ?>>
                            <?php echo e($side->applicant_title); ?> -
                            <?php echo e(App\Services\HelperService::nameFormat($side->detail->name)); ?>

                            <span></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/layout/side_select.blade.php ENDPATH**/ ?>