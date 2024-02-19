
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Profilim']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0"><?php echo e($user->name); ?></h4>
                        <p class="card-text">
                            Arabulucu Profili
                        </p>
                    </div>
                    <hr>
                    <?php if($user->getChange()): ?>
                        <div class="alert alert-danger">
                            Göndermiş olduğunuz değişiklik talebininz inceleniyor. Lütfen yeni talep
                            göndermeden önce eski talebinizin değerlendirilmesini bekleyiniz. Ard arda gönderilen talepler
                            değerlendirilmeyecektir. <br>Yaptığınız değişiklikler onaylandığında profilinizde
                            görüntülenecektir.
                        </div>
                    <?php endif; ?>
                    <?php echo e(Form::open(['url' => route('mediator.update', $user), 'method' => 'PUT'])); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Ad Soyad')); ?>

                                <?php echo e(Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Giriniz'])); ?>

                                <?php if($errors->has('name')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('T.C. Kimlik No')); ?>

                                <?php echo e(Form::text('identification', $user->mediator->identification, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No'])); ?>

                                <?php if($errors->has('identification')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('identification')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('ADB Sicil No')); ?>

                                <?php echo e(Form::text('registration_no', $user->mediator->registration_no, ['class' => 'form-control registrationmask', 'placeholder' => 'Sicil No Giriniz'])); ?>

                                <?php if($errors->has('registration_no')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('registration_no')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('IBAN')); ?>

                                <?php echo e(Form::text('iban', $user->mediator->iban, ['class' => 'form-control ibanmask', 'placeholder' => 'IBAN Numarası Giriniz'])); ?>

                                <?php if($errors->has('iban')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('iban')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('E-Posta')); ?>

                                <?php echo e(Form::text('email', $user->email, ['class' => 'form-control emailmask'])); ?>

                                <?php if($errors->has('email')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Telefon')); ?>

                                <?php echo e(Form::text('phone', $user->phone, ['class' => 'form-control phonemask'])); ?>

                                <?php if($errors->has('phone')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('phone')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Arabuluculuk Merkezi')); ?>

                                <?php echo e(Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), $user->mediator->mediation_center_id, ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--', 'id' => 'mediation_center', 'data-url' => route('get_mediation_center_address')])); ?>

                                <?php if($errors->has('mediation_center')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('mediation_center')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" style="margin-top:30px">
                                <label class="kt-checkbox">
                                    <?php echo e(Form::checkbox('meeting_address_proposal', true, $user->mediator->meeting_address_proposal)); ?>Toplantı
                                    Yerini Her Dosyada Sabit
                                    Olarak Öner <span></span>
                                </label>
                                <?php if($errors->has('meeting_address_proposal')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('meeting_addre')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Toplantı Yeri')); ?>

                                <?php echo e(Form::textarea('meeting_address', $user->mediator->meeting_address, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Toplantı Yeri Adresi Giriniz', 'id' => 'meeting_address'])); ?>

                                <?php if($errors->has('meeting_address')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('meeting_address')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php echo e(Form::label('Tebligat Adresi')); ?>

                                <?php echo e(Form::textarea('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Tebligat Adresi Giriniz', 'rows' => 3])); ?>

                                <?php if($errors->has('address')): ?>
                                    <span class="form-text text-danger"><?php echo e($errors->first('address')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::Submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/profile/index.blade.php ENDPATH**/ ?>