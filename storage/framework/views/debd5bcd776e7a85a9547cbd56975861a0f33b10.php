
<?php $__env->startSection('content'); ?>
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid row">
                <div class="kt-subheader__main col-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dosya Listele</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-2">
                    <div class="kt-form__actions mt-2">
                        <a href="<?php echo e(route('lawsuit.archive_index')); ?>" style="width: 100%;"
                            class="btn btn-warning justify-content-center align-items-center">Arşivlenmiş Dosyalar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Dosyalarım
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body py-4 px-4">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 150px;">BAŞVURUCU</th>
                                <th style="width: 150px;">KARŞI TARAF</th>
                                <th>YIL</th>
                                <th>BAŞV. DOSYA NO</th>
                                <th>ARB. DOSYA NO</th>
                                <th>UYUŞMAZLIK TÜRÜ</th>
                                <th>BAŞVURU TARİHİ</th>
                                <th>GÖREVİN KABUL TARİHİ</th>
                                <th>SON SÜRE</th>
                                <th>SÜREÇ BİLGİSİ</th>
                                <th>İŞLEMLER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->claimantName); ?></td>
                                    <td><?php echo e($item->defendantName); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($item->application_date)->format('Y')); ?></td>
                                    <td><?php echo e($item->application_document_no); ?></td>
                                    <td><?php echo e($item->mediation_document_no); ?></td>
                                    <td><?php echo e($item->lawsuit_subject_type->name ?? null); ?></td>
                                    <td><?php echo e($item->application_date); ?></td>
                                    <td><?php echo e($item->job_date); ?></td>
                                    <td><?php echo $item->last_time; ?></td>
                                    <td><?php echo $item->getProcessStatus(); ?></td>
                                    <td><?php echo $__env->make('mediator.lawsuit.process', compact('item'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="dosya-sistemden-kapatildi">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Dosya Sistemden Kapatıldı?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Son Tutanak, arabulucu Portal üzerinden Hukuk İşleri Genel Müdürlüğü’ne gönderildi mi?
                        <form action="lawsuit_process_type_update" method="POST" id="dosya-sistemden-kapatildi-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="lawsuit_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                        <button type="button" class="btn btn-success" id="dosya-sistemden-kapatildi-evet">Evet</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="agreement_type_modal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Toplantı Tutanağı Sonucu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="lawsuit_agreement_type_update" method="POST" id="agreement-type-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="lawsuit_id">
                            <input type="hidden" name="agreement_type_id">
                        </form>
                        <div class="form-group">
                            <label>Hangi konuda anlaşma sağlandı?</label>
                            <div class="kt-checkbox-list">
                                <?php $__currentLoopData = $agreement_types->where('back_to_work', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="kt-checkbox">
                                        <input type="radio" name="subject_answer" value="<?php echo e($type->id); ?>"
                                            data-template="<?php echo e($type->description); ?>"> <?php echo e($type->name); ?>

                                        <span></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sonuç</label>
                            <textarea class="form-control subject_answer_result" disabled></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg agreement_type_modal_ok">Tamam</button>
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">İptal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(Request::get('tutanak')): ?>
        <div class="modal fade" id="tutanak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bilgilendirme Tutanağı</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Dosyanıza arabuluculuk sürecine ilişkin bilgilendirme tutanağı oluşturarak
                        devam etmek ister misiniz ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">HAYIR</button>
                        <a href="<?php echo e(route('arbiter_process_info_protocol.create', Request::get('tutanak'))); ?>"
                            class="btn btn-success">EVET</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $("body").addClass("kt-aside--minimize");
    </script>
    <?php if(Request::get('tutanak')): ?>
        <script>
            $('#tutanak').modal('show')
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/index.blade.php ENDPATH**/ ?>