
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Bildirim İşlemleri']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Bildirim işlemleri
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?php echo e(Form::open(['url' => route('admin.notification.store'), 'method' => 'POST'])); ?>

                    <div class="alert alert-danger">
                        <strong>Not: </strong> Sol tarafta bulunan kullanıcıların tümünü veya bildirim göndermek istediğiniz
                        kişi veya kişileri seçtikten sonra sağ tarafta bulunan mesaj kutusuna mesajınızı yazınız ve
                        Bildirim gönder butonuna tıklayarak mesajınızı gönderiniz.
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table">
                                <thead class="bg-primary text-white text-uppercase">
                                    <tr>
                                        <th scope="col"><input type="checkbox" id="checkAll" value=""></th>
                                        <th scope="col">Kullanıcılar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(auth()->id() != $value->id): ?>
                                            <tr>
                                                <td scope="row"><input type="checkbox" name="selected[]"
                                                        value="<?php echo e($value->id); ?>"></td>
                                                <th><?php echo e($value->email); ?></th>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <textarea class="summernote" role="textbox" name="message" aria-multiline="true"></textarea>
                        </div>
                    </div>
                    <?php echo e(Form::submit('Bildirim Gönder', ['class' => 'btn btn-primary my-2'])); ?>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/notification/index.blade.php ENDPATH**/ ?>