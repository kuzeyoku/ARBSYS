<div class="kt-wizard-v4__nav">
    <div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
        <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step"
                <?php if($loop->first): ?> data-ktwizard-state="current" <?php endif; ?>>
                <div class="kt-wizard-v4__nav-body">
                    <div class="kt-wizard-v4__nav-number">
                        <?php echo e($key); ?>

                    </div>
                    <div class="kt-wizard-v4__nav-label">
                        <div class="kt-wizard-v4__nav-label-title">
                            <?php echo e($value); ?>

                        </div>
                        <div class="kt-wizard-v4__nav-label-desc">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/nav.blade.php ENDPATH**/ ?>