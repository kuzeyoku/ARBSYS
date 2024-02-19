<div class="kt-container  kt-container--fluid  ">
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger mb-1">
                <?php echo e($error); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php if(session('success')): ?>
    <script>
        swal.fire({
            title: "Başarılı!",
            text: "<?php echo e(session('success')); ?>",
            type: "success",
            confirmButtonClass: 'btn btn-success',
        });
    </script>
<?php endif; ?>
<?php if(session('error')): ?>
    <script>
        swal.fire({
            title: "Hata!",
            text: "<?php echo e(session('error')); ?>",
            type: "error",
            confirmButtonClass: 'btn btn-danger',
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\arbsys\resources\views/admin/alert.blade.php ENDPATH**/ ?>