<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-1" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                    <?php $__currentLoopData = $url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->last): ?>
                            <li class="breadcrumb-item active"><?php echo e($title); ?></li>
                        <?php else: ?>
                            <li class="breadcrumb-item"><a href="<?php echo e($url); ?>"><?php echo e($title); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/layout/breadcrumb.blade.php ENDPATH**/ ?>