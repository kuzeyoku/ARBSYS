
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', 0 => 'Dosya Notları'],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid lawsuit_edit">
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Dosya Notları
                                </h3>
                            </div>
                        </div>
                        <?php echo e(Form::open(['url' => route('lawsuit.note.save', $lawsuit)])); ?>

                        <div class="kt-portlet__body noteEditor">
                            <?php if(session()->has('message.status')): ?>
                                <div class="alert alert-<?php echo e(session()->get('message.status')); ?>">
                                    <?php echo session('message.content'); ?>

                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <?php echo e(Form::textarea('notes', $lawsuit->notes->note ?? null, ['class' => 'summernote'])); ?>

                            </div>
                            <?php echo e(Form::submit('Kaydet', ['class' => 'btn btn-primary'])); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $(".noteEditor").hide();
            swal.fire({
                title: 'Dikkat!',
                text: "Bu sayfada yer alan detayların sadece arabulucu tarafından görüntülenmesi gerekebilir. Devam etmek istediğinize eminmisiniz ?",
                type: 'warning',
                confirmButtonText: 'Evet, devam et!',
                cancelButtonText: 'Hayır, iptal et!',
                showCancelButton: true,
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $(".noteEditor").show();
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "İptal edildi",
                        "Dosya notları sayfasına giriş işlemi iptal edildi.",
                        "error"
                    ).then(function() {
                        window.location.href = "<?php echo e(route('lawsuit.index')); ?>";
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/note.blade.php ENDPATH**/ ?>