
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Şablon İşlemleri']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label w-100  d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Şablon İşlemleri <?php echo e(isset($lawsuitSubjectType) ? '-' . $lawsuitSubjectType->name : ''); ?>

                            </h3>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <?php if(isset($subjectTypes)): ?>
                                    <th>Uyuşmazlık Türleri</th>
                                <?php endif; ?>
                                <?php if(isset($lawsuitSubjectType)): ?>
                                    <th>Uyuşmazlık Konuları</th>
                                <?php endif; ?>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($lawsuitSubjectType)): ?>
                                <tr>
                                    <td>
                                        Genel Şablonlar
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.template.edit', $lawsuitSubjectType)); ?>"
                                            class="btn btn-primary btn-sm">Düzenle</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th col="2">
                                        Uyuşmazlık Konuları
                                    </th>
                                </tr>
                                <?php $__currentLoopData = $lawsuitSubjectType->lawsuitSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($item->name); ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.template.edit', [$lawsuitSubjectType, $item])); ?>"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(isset($subjectTypes)): ?>
                                <?php $__currentLoopData = $subjectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($item->name); ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.template.subjects', $item)); ?>"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/template/index.blade.php ENDPATH**/ ?>