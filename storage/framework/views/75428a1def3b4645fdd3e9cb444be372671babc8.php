
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kullanıcı Süre İşlemleri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Kullanıcı Süre İşlemleri - <strong> Tarih: <?php echo e(str_replace('-', '/', now()->format('d-m-Y'))); ?>

                            </strong>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Ad Soyad</th>
                                <th>Email</th>
                                <th>Kalan Süre (Gün)</th>
                                <th>işlemler </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><strong><?php echo e((strtotime($user->end) - strtotime(now()->format('d-m-Y'))) / 86400); ?></strong>
                                    </td>
                                    <td>
                                        <form method="POST" action="<?php echo e(route('admin.user.date.update', $user)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="input-daterange input-group kt_datepicker">
                                                <input type="date" class="form-control kt-input" name="end"
                                                    placeholder="Üyelik Bitiş Tarihi" data-col-index="3" autocomplete="off"
                                                    value=<?php echo e($user->end); ?> />
                                                <input type="hidden" class="" name="id"
                                                    value="<?php echo e($user->id); ?>" />
                                                <button type="submit" class="btn btn-success ml-2">Süre Kaydet</button>
                                            </div>
                                        </form>
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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/users/date.blade.php ENDPATH**/ ?>