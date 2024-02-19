
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Hesaplama Araçları']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Hesaplama Araçları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <?php echo e(Form::open(['url' => route('admin.calculation_tools.update'), 'method' => 'post'])); ?>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hesaplama Aracı Adı</th>
                                <th>Aktiflik durumu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($tool->name); ?>

                                    </td>
                                    <td>
                                        <span class="kt-switch kt-switch--success">
                                            <label>
                                                <?php echo e(Form::checkbox('status', 'true', $tool->status, ['class' => 'calculate-item', 'id' => $tool->id])); ?>

                                                <span></span>
                                            </label>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(".calculate-item").change(function() {
            let url = $(this).closest("form").attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    '_token': $("input[name='_token']").val(),
                    'id': $(this).attr("id"),
                    'status': $(this).is(":checked"),
                },
                success: function(data) {

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/admin/calculation_tools/index.blade.php ENDPATH**/ ?>