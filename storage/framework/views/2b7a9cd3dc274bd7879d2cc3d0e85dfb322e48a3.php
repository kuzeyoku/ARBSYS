
<?php $__env->startSection('title', 'Oturum Açın'); ?>
<?php $__env->startSection('content'); ?>
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Oturum Açın</h3>
        </div>
        <?php echo e(Form::open(['url' => route('login'), 'method' => 'post', 'class' => 'kt-form'])); ?>

        <div class="form-group">
            <?php echo e(Form::email('email', null, ['class' => 'form-control border', 'placeholder' => 'E-Posta', 'required' => ''])); ?>

            <?php if($errors->has('email')): ?>
                <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <?php echo e(Form::password('password', ['class' => 'form-control border', 'placeholder' => 'Şifre'])); ?>

            <?php if($errors->has('password')): ?>
                <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
            <?php endif; ?>
        </div>
        <div class="g-recaptcha <?php echo e($errors->has('g-recaptcha-response') ? 'mb-1' : 'mb-3'); ?>"
            data-sitekey="<?php echo e(config('recaptcha.site_key')); ?>"></div>
        <?php if($errors->has('g-recaptcha-response')): ?>
            <span class="text-danger"><?php echo e($errors->first('g-recaptcha-response')); ?></span>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <label class="kt-checkbox">
                    <?php echo e(Form::checkbox('rememberMe', true, false, ['class' => 'form-control'])); ?>

                    Beni Hatırla <span></span>
                </label>
            </div>
            <div class="col kt-align-right">
                <a class="kt-login__link" href="<?php echo e(route('password.request')); ?>">Şifremi Unuttum ?</a>
            </div>
        </div>
        <div class="kt-login__actions">
            <?php echo e(Form::submit('Giriş Yap', ['class' => 'btn btn-brand kt-login__btn-primary'])); ?>

        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            Henüz bir hesabınız yokmu ?
        </span>
        <a href="<?php echo e(route('register')); ?>" class="kt-login__account-link">Kayıt Ol!</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/auth/login.blade.php ENDPATH**/ ?>