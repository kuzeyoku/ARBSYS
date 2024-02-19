
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Bakanlık Görüşleri ve Duruyuları']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4">
                        <div class="kt-portlet kt-iconbox kt-iconbox--wave" style="height: 140px">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <?php echo e(svg('far-file-pdf')); ?>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <div class="kt-iconbox__content">
                                            <button type="button" class="btn kt-link view-pdf text-center"
                                                pdf-link="<?php echo e($item->getFileUrl()); ?>" data-toggle="modal"
                                                data-target="#myModal"><?php echo e($item->title); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <embed id="pdf-viewer" src="" frameborder="0" width="100%" height="800px">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('.view-pdf').click(function() {
                var pdf_link = $(this).attr('pdf-link');
                $('#pdf-viewer').attr('src', pdf_link + '#toolbar=0&navpanes=0&scrollbar=0&zoom=150');
                $('#myModal .modal-body').html(iframe);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/ministeries_opinions.blade.php ENDPATH**/ ?>