
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <?php echo $__env->make('layout.breadcrumb', [($url = [])], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="card mb-4">
                <div class="card-header">
                    Kullanıcı Bilgileri
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count das3 d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h5>Hoşgeldiniz</h5>
                                    <h4><?php echo e(auth()->user()->name); ?></h4>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count das1 d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h5>Kalan Kullanım Süreniz</h5>
                                    <h4><?php echo e(auth()->user()->remainingDay); ?> Gün</h4>
                                    </h4>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Dosyalarım
                </div>
                <div class="card-body pb-0">

                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h4><?php echo e($lawsuits->count()); ?></h4>
                                    <h5>Toplam Dosya</h5>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-folder"></i>
                                </div>
                            </div>
                        </div>
                        <?php $__currentLoopData = $lawsuitProcessTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="dash-count das2 d-flex flex-row justify-content-between">
                                    <div class="dash-counts">
                                        <h4><?php echo e($lawsuitProcessTypesCount[$key] ?? 0); ?></h4>
                                        <h5><?php echo e($title); ?></h5>
                                    </div>
                                    <div class="dash-imgs">
                                        <i class="fas fa-file"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Belgeler
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count d-flex flex-row justify-content-between align-items-center">
                                <h5>Toplam Oluşturulan Belge</h5>
                                <h1><?php echo e($documents->count()); ?></h1>
                            </div>
                        </div>
                        <?php $__currentLoopData = $documentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="dash-count das2 d-flex flex-row justify-content-between align-items-center">
                                    <h5><?php echo e($title); ?></h5>
                                    <h4><?php echo e($documentTypesCount[$key] ?? 0); ?></h4>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/index.blade.php ENDPATH**/ ?>