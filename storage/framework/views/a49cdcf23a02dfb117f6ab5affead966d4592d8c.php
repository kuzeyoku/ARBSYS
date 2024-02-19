
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'İlgili Mevzuat']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <?php $__currentLoopData = $legislations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legislation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4">
                        <a href="<?php echo e(route('legislation.show', [$legislation, $legislation->slug])); ?>">
                            <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__icon">
                                            <?php echo e(svg('far-file-alt')); ?>
                                        </div>
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                            </h3>
                                            <div class="kt-iconbox__content">
                                                <p class="kt-link"><?php echo e($legislation->title); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/legislation/index.blade.php ENDPATH**/ ?>