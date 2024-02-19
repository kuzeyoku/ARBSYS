<div class="row">
    <div class="col-md-6">
        <div class="kt-heading kt-heading--md">Başvurucu</div>
        <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
                <div class="kt-checkbox-list">
                    <?php if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                            id="checkbox-<?php echo e($claimant->id); ?>">
                            <input type="checkbox" name="claimant_ids[]" value="<?php echo e($claimant->id); ?>"
                                data-name="<?php echo e($claimant->detail->name); ?>">
                            <span></span>
                            <?php echo e($claimant->detail->name); ?>

                        </label>
                    <?php endif; ?>
                    <div class="required_sub_side" data-type="<?php echo e($claimant->side_applicant_type_id); ?>"
                        data-title="title-<?php echo e($claimant->id); ?>" id="sub_sides-<?php echo e($claimant->id); ?>">
                        <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                                id="checkbox-<?php echo e($side->id); ?>">
                                <input type="checkbox" name="claimant_ids[]" value="<?php echo e($side->id); ?>"
                                    data-name="<?php echo e($side->detail->name); ?>"
                                    <?php echo e($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY && $index == 0 ? 'checked' : ''); ?>>
                                <?php echo e($side->applicant_title); ?> - <?php echo e($side->detail->name); ?>

                                <a href="javascript:;" data-id="<?php echo e($side->id); ?>" data-type="<?php echo e($side->title); ?>"
                                    class="btn btn-sm btn-clean btn-icon btn-icon-md edit-side-button">
                                    <i class="la la-edit"></i>
                                </a>
                                <span></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php echo $__env->make('mediator.lawsuit.partials.add_sub_side_buttons', ['side' => $claimant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="col-md-6">
        <div class="kt-heading kt-heading--md">Diğer Taraf</div>
        <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
                <div class="kt-checkbox-list">
                    <?php if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                            id="checkbox-<?php echo e($defendant->id); ?>">
                            <input type="checkbox" name="defendant_ids[]" value="<?php echo e($defendant->id); ?>"
                                data-name="<?php echo e($defendant->detail->name); ?>">
                            <span></span>
                            <?php echo e($defendant->detail->name); ?>

                        </label>
                    <?php endif; ?>
                    <div class="required_sub_side" data-type="<?php echo e($defendant->side_applicant_type_id); ?>"
                        data-title="title-<?php echo e($defendant->id); ?>" id="sub_sides-<?php echo e($defendant->id); ?>">
                        <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                                id="checkbox-<?php echo e($side->id); ?>">
                                <input type="checkbox" name="defendant_ids[]" value="<?php echo e($side->id); ?>"
                                    data-name="<?php echo e($side->detail->name); ?>"
                                    <?php echo e($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY && $index == 0 ? 'checked' : ''); ?>>
                                <?php echo e($side->applicant_title); ?> - <?php echo e($side->detail->name); ?>

                                <span></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php echo $__env->make('mediator.lawsuit.partials.add_sub_side_buttons', ['side' => $defendant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/partials/sides.blade.php ENDPATH**/ ?>