
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Şablon Düzenle']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Şablon Düzenle
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="card-body">
                        <div class="alert alert-success"><?php echo e($lawsuitSubjectType->name); ?> için Tutanak Şablonlarını
                            Düzenliyorsunuz</div>
                        <div class="row">
                            <div class="col-lg-3">
                                <ul class="nav nav-pills nav-fill" role="tablist">

                                    <?php if($lawsuitSubject): ?>
                                        <?php $__currentLoopData = $lawsuitSubject->DocumentTypeTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item border mb-2">
                                                <a class="nav-link <?php echo e($loop->first ? 'active show' : ''); ?>"
                                                    data-toggle="tab"
                                                    href="#tab_<?php echo e($template->id); ?>"><?php echo e($template->documentType->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $lawsuitSubjectType->templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item border mb-2">
                                                <a class="nav-link <?php echo e($loop->first ? 'active show' : ''); ?>"
                                                    data-toggle="tab"
                                                    href="#tab_<?php echo e($template->id); ?>"><?php echo e($template->documentType->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <div class="tab-content mb-2">
                                    <?php if($lawsuitSubject): ?>
                                        <?php $__currentLoopData = $lawsuitSubject->DocumentTypeTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane <?php echo e($loop->first ? 'active' : ''); ?>"
                                                id="tab_<?php echo e($template->id); ?>" role="tabpanel">
                                                <div class="card mb-3">
                                                    <div class="card-header bg-secondary">Değişkenler</div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            <?php $__currentLoopData = $template->documentType->getKeywords(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-lg-2 mb-2">
                                                                    <div class="badge badge-success">
                                                                        <?php echo e($keyword); ?>

                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::open(['url' => route('admin.template.update', $template), 'method' => 'PUT'])); ?>

                                                <div class="form-group">
                                                    <?php echo e(Form::textarea('html', $template->html, ['class' => 'summernote'])); ?>

                                                </div>
                                                <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $lawsuitSubjectType->templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane <?php echo e($loop->first ? 'active' : ''); ?>"
                                                id="tab_<?php echo e($template->id); ?>" role="tabpanel">
                                                <div class="card mb-3">
                                                    <div class="card-header bg-secondary">Değişkenler</div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            <?php $__currentLoopData = $template->documentType->getKeywords(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-lg-2 mb-2">
                                                                    <div class="badge badge-success">
                                                                        <?php echo e($keyword); ?>

                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::open(['url' => route('admin.template.update', $template), 'method' => 'PUT'])); ?>

                                                <div class="form-group">
                                                    <?php echo e(Form::textarea('html', $template->html, ['class' => 'summernote'])); ?>

                                                </div>
                                                <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/template/edit.blade.php ENDPATH**/ ?>