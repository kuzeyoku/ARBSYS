
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-1" style="background-color: white;">
                        <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vergi Dairesi İşlemleri</li>
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
                        Vergi Dairesi İşlemleri
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?php echo $__env->make("admin.alert", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center flex-column">
                                <strong class="text-center mb-3" style="font-size: 1.5rem;">VERGİ DAİRESİ EKLE</strong>
                                <form action="<?php echo e(url('vergi-dairesi-olustur')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                                            <span style="font-size: 16px">İL:</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="province" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                                            <span style="font-size: 16px">İLÇE:</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="district" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                                            <span style="font-size: 16px">MUH.BİR.KODU:</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="informantCode" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                                            <span style="font-size: 16px">VERGİ DAİRESİ ADI:</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="taxOfficeName" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button class="btn btn-success w-25" type="submit">KAYDET</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-md" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">İL</th>
                                    <th scope="col">İLÇE</th>
                                    <th scope="col">MUH.BİR. KODU</th>
                                    <th scope="col">VERGİ DAİRESİ ADI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->province); ?></td>
                                    <td><?php echo e($item->district); ?></td>
                                    <td><?php echo e($item->informantCode); ?></td>
                                    <td><?php echo e($item->taxOfficeName); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/taxoffice/index.blade.php ENDPATH**/ ?>