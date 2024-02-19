<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ARBSYS</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/assets/media/logos/arbsysLOGO.png" />
</head>

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                style="background-image: url(assets/media/bg/bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="<?php echo e(url('/')); ?>">
                                <img src="<?php echo e(asset('/assets/media/logos/arbsysLOGO2.png')); ?>">
                            </a>
                        </div>
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Kayıt Ol</h3>
                            <div class="kt-login__desc">Kullanıcı detaylarını girin:</div>
                        </div>
                        <?php echo $__env->make('layout.form_error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo e(Form::open(['url' => route('register'), 'method' => 'POST', 'class' => 'kt-form'])); ?>

                        <div class="form-group">
                            <?php echo e(Form::label('Adınız ve Soyadınız')); ?>

                            <?php echo e(Form::text('name', null, ['class' => 'form-control border', 'placeholder' => 'Ad Soyad Giriniz', 'required' => ''])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('Doğum Tarihiniz')); ?>

                            <?php echo e(Form::date('borndate', null, ['class' => 'form-control border', 'placeholder' => 'Doğum Tarihi'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('Cinsiyetiniz')); ?>

                            <?php echo e(Form::select('gender', ['erkek' => 'Erkek', 'kadın' => 'Kadın', null => 'Belirtmek İstemiyorum'], 'default', ['class' => 'form-control border'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('Telefon Numaranız')); ?>

                            <?php echo e(Form::text('phone', null, ['class' => 'form-control border phonemask', 'placeholder' => 'Telefon', 'required' => ''])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('E-Mail Adresiniz')); ?>

                            <?php echo e(Form::email('email', null, ['class' => 'form-control border emailmask', 'placeholder' => 'Email', 'required' => ''])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('Parola')); ?>

                            <?php echo e(Form::password('password', ['class' => 'form-control border', 'placeholder' => 'Parola'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('Parola Tekrar')); ?>

                            <?php echo e(Form::password('password_confirm', ['class' => 'form-control border', 'placeholder' => 'Parola Tekrar'])); ?>

                        </div>
                        <div class="g-recaptcha" data-sitekey="<?php echo e(config('recaptcha.site_key')); ?>"></div>
                        <div class="kt-login__actions">
                            <?php echo e(Form::submit('Kayıt Ol', ['class' => 'btn btn-brand kt-login__btn-primary'])); ?>

                            <?php echo e(Form::reset('Vazgeç', ['class' => 'btn btn-light kt-login__btn-secondary border'])); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".phonemask").inputmask("9999999999");
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\arbsys\resources\views/auth/register.blade.php ENDPATH**/ ?>