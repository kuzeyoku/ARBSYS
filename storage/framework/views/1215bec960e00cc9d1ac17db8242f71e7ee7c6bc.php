
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', [
            'url' => [null => 'Mevzuat Sayfası Oluştur'],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Mevzuat Sayfası Oluştur
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?php echo e(Form::open(['url' => route('admin.legislation.store'), 'method' => 'POST'])); ?>

                    <div class="form-group">
                        <?php echo e(Form::label('Sayfa Başlığı')); ?>

                        <?php echo e(Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Sayfa Başlığı Giriniz.'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Açıklama')); ?>

                        <?php echo e(Form::textarea('content', old('content'), ['class' => 'form-control summernote'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Durum')); ?>

                        <?php echo e(Form::select('status', [1 => 'Aktif', 0 => 'Pasif'], old('status'), ['class' => 'form-control'])); ?>

                    </div>
                    <?php echo e(Form::submit('Gönder', ['class' => 'btn btn-primary'])); ?>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/legislation/create.blade.php ENDPATH**/ ?>