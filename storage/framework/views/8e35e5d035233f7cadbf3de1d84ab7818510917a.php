
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Kullanıcı Düzenle']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Kişi Düzenle
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?php echo e(Form::open(['url' => route('admin.user.update', $user), 'method' => 'PUT'])); ?>

                    <div class="form-group">
                        <?php echo e(Form::label('Ad Soyad')); ?>

                        <?php echo e(Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Giriniz'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Cinsiyeti')); ?>

                        <?php echo e(Form::select('gender', [null => 'Belirtmek İstemiyorum', 'erkek' => 'Erkek', 'kadın' => 'Kadın'], $user->gender, ['class' => 'form-control'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Doğum Tarihi')); ?>

                        <?php echo e(Form::date('borndate', $user->borndate, ['class' => 'form-control'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Telefon')); ?>

                        <?php echo e(Form::text('phone', $user->phone, ['class' => 'form-control phonemask'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('EMail')); ?>

                        <?php echo e(Form::email('email', $user->email, ['class' => 'form-control'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Şifre')); ?>

                        <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => 'Şifre Giriniz'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Şifre Tekrar')); ?>

                        <?php echo e(Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Şifre Tekrar Giriniz'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Tebligat Adresi')); ?>

                        <?php echo e(Form::textarea('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Tebligat Adresinizi Giriniz', 'rows' => 3])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('Sicil No')); ?>

                        <?php echo e(Form::text('registration_no', $user->mediator->registration_no, ['class' => 'form-control registrationmask'])); ?>

                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('IBAN')); ?>

                        <?php echo e(Form::text('iban', $user->mediator->iban, ['class' => 'form-control ibanmask'])); ?>

                    </div>
                    <div class="form-group mb-3">
                        <?php echo e(Form::label('Toplatı Yeri (Adresi)')); ?>

                        <?php echo e(Form::textarea('meeting_address', $user->mediator->meeting_address, ['class' => 'form-control', 'placeholder' => 'Toplantı Yeri (Adresi) Giriniz', 'rows' => 3])); ?>

                    </div>
                    <div class="kt-login__actions mt-4">
                        <?php echo e(Form::submit('Güncelle', ['class' => 'btn btn-primary'])); ?>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>