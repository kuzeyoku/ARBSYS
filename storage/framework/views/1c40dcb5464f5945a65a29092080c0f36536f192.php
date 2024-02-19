
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
                    <table class="table table-striped table-hover text-center table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <td>Başlık</td>
                                <td>Durum</td>
                                <td>Sıra</td>
                                <td>İşlem</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($item->title); ?>

                                    </td>
                                    <td>
                                        <?php if($item->status): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($item->order); ?>

                                    </td>
                                    <td style="width:100px">
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('admin.ministeries_opinions.edit', $item)); ?>"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                            <?php echo e(Form::open(['url' => route('admin.ministeries_opinions.destroy', $item), 'method' => 'delete'])); ?>

                                            <button type="button" class="btn btn-danger btn-sm delete-btn">Sil</button>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/ministeries_opinions/index.blade.php ENDPATH**/ ?>