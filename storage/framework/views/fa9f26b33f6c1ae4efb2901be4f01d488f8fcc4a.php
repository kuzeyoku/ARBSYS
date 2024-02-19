<?php if(auth()->user()->mediator->letter_option_id == LetterOptions::CUSTOM): ?>
    <div class="page-header" identifier="page-header"
        style="display: flex; flex-direction: row; background-color: #1a9ff1;">
        <img class="logo" width="200" height="50" src="<?php echo e(auth()->user()->mediator->logo); ?>"
            id="<?php echo e(auth()->user()->mediator->path_logo); ?>-200-50" style="margin-left: 50px; margin-top: 9px;">
        <p style="margin-right: 50px; color: #f1f1f1;"><?php echo e(auth()->user()->mediator->letter_top); ?></p>
    </div>
    <div class="page-footer" identifier="page-footer" style="background-color: #00aff0;">
        <p style="color: #f1f1f1;"><?php echo auth()->user()->mediator->letter_bottom; ?></p>
    </div>
<?php elseif(auth()->user()->mediator->letter_option_id == LetterOptions::STANDARD): ?>
    <div class="page-header" identifier="page-header">
        <p style="font-family:Times New Roman;font-style: italic;font-size:16pt;">Arb. Av. <?php echo e(auth()->user()->name); ?>

        </p>
    </div>
    <div class="page-footer" identifier="page-footer">
        <p>
            <?php echo e(auth()->user()->address); ?><br>
            Tel: <?php echo e(auth()->user()->phone); ?> E-Posta: <?php echo e(auth()->user()->email); ?>

        </p>
    </div>
<?php endif; ?>
<table>
    <thead>
        <tr>
            <td>
                <div class="page-header-space" identifier="page-header-space"></div>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="page" identifier="page">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="page-footer-space" identifier="page-footer-space2"></div>
            </td>
        </tr>
    </tfoot>
</table>
<?php /**PATH C:\laragon\www\arbsys\resources\views/layout/print.blade.php ENDPATH**/ ?>