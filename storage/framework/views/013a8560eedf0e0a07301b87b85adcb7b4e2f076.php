
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Mevzuat Sayfaları']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Mevzuat Sayfaları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="dataTable">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Durum</th>
                                <th style="width:100px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $legislations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legislation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($legislation->title); ?></td>
                                    <td><?php echo e($legislation->status); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('admin.legislation.edit', $legislation)); ?>"
                                                class="btn btn-sm btn-primary edit-person-btn">Düzenle</a>
                                            <?php echo Form::open(['url' => route('admin.legislation.destroy', $legislation), 'method' => 'delete']); ?>

                                            <?php echo Form::hidden('id', $legislation->id); ?>

                                            <?php echo Form::hidden('type', $legislation->type_id); ?>

                                            <button type="button" class="btn btn-sm btn-danger delete-btn">Sil</button>
                                            <?php echo Form::close(); ?>

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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/legislation/index.blade.php ENDPATH**/ ?>