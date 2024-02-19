<?php if(session('success')): ?>
    <script>
        swal.fire({
            title: "Başarılı!",
            text: "<?php echo e(session('success')); ?>",
            icon: "success",
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
            icon: "error",
            type: "error",
            confirmButtonClass: 'btn btn-danger',
        });
    </script>
<?php endif; ?>
<?php if(session('warning')): ?>
    <script>
        swal.fire({
            title: "Uyarı!",
            text: "<?php echo e(session('warning')); ?>",
            icon: "warning",
            type: "warning",
            confirmButtonClass: 'btn btn-warning',
        });
    </script>
<?php endif; ?>
<?php if(session('info')): ?>
    <script>
        swal.fire({
            title: "Bilgi!",
            text: "<?php echo e(session('info')); ?>",
            icon: "info",
            type: "info",
            confirmButtonClass: 'btn btn-info',
        });
    </script>
<?php endif; ?><?php /**PATH C:\laragon\www\arbsys\resources\views/layout/alert.blade.php ENDPATH**/ ?>