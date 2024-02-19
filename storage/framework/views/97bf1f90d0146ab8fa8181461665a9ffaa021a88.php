
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Uyuşmazlık Türleri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Uyuşmazlık Türleri & Uyuşmazlık Konuları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php echo e(Form::open(['url' => route('admin.lawsuit_subject_type.store'), 'method' => 'POST'])); ?>

                            <div class="form-group">
                                <?php echo e(Form::label('Uyuşmazlık Türü')); ?>

                                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Uyuşmazlık Türü Başlığı Giriniz'])); ?>

                            </div>
                            <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                            <?php echo e(Form::close()); ?>

                        </div>
                        <div class="col-lg-6">
                            <?php echo e(Form::open(['url' => route('admin.lawsuit_subject.store'), 'method' => 'POST'])); ?>

                            <div class="form-group">
                                <?php echo e(Form::label('Uyuşmazlık Türü')); ?>

                                <?php echo e(Form::select('lawsuit_subject_type', App\Models\Lawsuit\LawsuitSubjectType::selectToArray(), 'default', ['class' => 'form-control'])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('Uyuşmazlık Konusu')); ?>

                                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Uyuşmazlık Konusu Giriniz'])); ?>

                            </div>
                            <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <hr>
                    <ul class="list-group">
                        <?php $__currentLoopData = App\Models\Lawsuit\LawsuitSubjectType::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item mb-2 bg-secondary"><?php echo e($item->name); ?>

                                <?php echo e(Form::open(['url' => route('admin.lawsuit_subject_type.destroy', $item), 'method' => 'DELETE', 'class' => 'd-inline'])); ?>

                                <button type="button" class="btn btn-sm btn-danger float-right delete-btn"><i
                                        class="fas fa-times"></i></button>
                                <?php echo e(Form::close()); ?>

                            </li>
                            <ul class="list-group">
                                <?php $__currentLoopData = $item->lawsuitSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item mb-2 ml-5">
                                        <?php echo e($subject->name); ?>

                                        <?php echo e(Form::open(['url' => route('admin.lawsuit_subject.destroy', $subject), 'method' => 'DELETE', 'class' => 'd-inline'])); ?>

                                        <button type="button" class="btn btn-sm btn-danger float-right delete-btn"><i
                                                class="fas fa-times"></i></button>
                                        <?php echo e(Form::close()); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/lawsuit_subject_type/index.blade.php ENDPATH**/ ?>