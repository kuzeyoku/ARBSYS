
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Bakanlık Görüşleri']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Bakanlık Görüşleri
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?php echo e(Form::open(['url' => route('admin.ministeries_opinions.store'), 'method' => 'POST', 'files' => true])); ?>

                    <div class="form-group">
                        <?php echo e(Form::label('Başlık')); ?>

                        <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Başlık Giriniz'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Dosya')); ?>

                        <div>
                            <?php echo e(Form::file('file', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Durum')); ?>

                                <?php echo e(Form::select('status', [1 => 'Aktif', 0 => 'Pasif'], 'default', ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Sıra')); ?>

                                <?php echo e(Form::number('order', 0, ['class' => 'form-control'])); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/ministeries_opinions/create.blade.php ENDPATH**/ ?>