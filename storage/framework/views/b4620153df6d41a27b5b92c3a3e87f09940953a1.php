
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <?php echo $__env->make('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'Toplantı Tutanağı Oluştur'],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                <?php echo $__env->make('mediator.document.nav', [
                    'nav' => [
                        1 => 'Taraf Seçimi',
                        2 => 'Toplantı Bilgileri',
                        3 => 'Önizleme',
                        4 => 'Bitir',
                    ],
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <?php echo e(Form::open(['url' => route('meeting_protocol.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form'])); ?>


                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Taraf Seçimi -</div>
                                    <?php echo $__env->make('mediator.document.layout.side_select', $lawsuit, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Müzakere</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <?php echo e(Form::label('Toplantı Tarihi')); ?>

                                                <?php echo e(Form::text('meeting_date', $lawsuit->meeting_date, ['class' => 'form-control datepicker datedotmask'])); ?>

                                            </div>
                                            <div class="form-group">
                                                <?php echo e(Form::label('Toplantı Saati')); ?>

                                                <?php echo e(Form::text('meeting_start_hour', $lawsuit->meeting_start_hour, ['class' => 'form-control timepicker'])); ?>

                                            </div>
                                            <div class="form-group">
                                                <?php echo e(Form::label('Toplantı Yeri')); ?>

                                                <?php echo e(Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), $lawsuit->mediation_center ?? auth()->user()->mediator->meeting_address_proposal ? auth()->user()->mediator->mediation_center_id : null, ['id' => 'mediation_center', 'class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])); ?>

                                            </div>
                                            <div class="form-group">
                                                <?php echo e(Form::checkbox('meeting_address_check', true, false, ['id' => 'meeting_address_check'])); ?>

                                                <?php echo e(Form::label('Adresi Elle Gir')); ?>

                                            </div>
                                            <div class="form-group" style="display: none" id="meeting_address">
                                                <?php echo e(Form::label('Toplantı Adresi')); ?>

                                                <?php echo e(Form::text('meeting_address', null, ['class' => 'form-control', 'placeholder' => 'Açık Adres Giriniz'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Önizleme</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="kt-wizard-v4__form">
                                                <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                    değişkenler kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri
                                                    ile değiştirilecektir.</p>
                                                <textarea class="preview_area" name="preview" id="preview_area"
                                                    data-url="<?php echo e(route('meeting_protocol.preview', $lawsuit)); ?>">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Bitir</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__review">
                                            <p class="kt-font-bold" id="before_saved">
                                                Çıktı almak ve daha sonradan evraklarım sekmesinden evraklarınızı
                                                görüntülemek için kaydet butonu ile kaydedebilirsiniz.
                                            </p>
                                            <div class="kt-wizard-v4__review-item" id="saved" style="display: none;">
                                                <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                                                    rel="stylesheet">
                                                <div class="neo-notification row">
                                                    <i class="material-icons col-1 align-middle my-auto">notifications</i>
                                                    <div class="col-11">
                                                        Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                        dilediginiz zaman erişebilirsiniz.
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="kt-wizard-v4__review-content">
                                                    <h1 class="kt-heading kt-heading--lg">Sürece Devam Etmek istiyor
                                                        musunuz?</h1>
                                                    <a href="#next_level" data-toggle="modal"
                                                        class="btn btn-success btn-lg">Evet</a>
                                                    <a href="/dosyalar" class="btn btn-danger btn-lg">Çık</a>
                                                    <a href="javascript:;" class="btn btn-success float-right"
                                                        id="cikti_btn">
                                                        <i class="fas fa-print"></i> Çıktı Al
                                                    </a>
                                                    <div class="print_side" id=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php echo $__env->make('layout.form_actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo e(Form::close()); ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="next_level">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Sürece ne şekilde devam etmek istiyorsunuz?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="<?php echo e(route('meeting_protocol.create', $lawsuit)); ?>" class="btn btn-success btn-lg">Yeni
                            Bir Toplantı Tutanağı Hazırla</a>
                        <a href="<?php echo e(route('agreement_document.create', $lawsuit)); ?>" class="btn btn-success btn-lg">Anlaşma
                            Belgesi Hazırla</a>
                        <a href="<?php echo e(route('final_protocol.create', $lawsuit)); ?>" class="btn btn-success btn-lg">Son
                            Tutanak Hazırla</a>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo e(route('lawsuit.index')); ?>" class="btn btn-primary btn-lg">İptal</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="meeting_result_question_modal" style="z-index:1061;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Toplantı ikinci oturuma mı kaldı?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg"
                            id="meeting_result_next_button">Evet</button>
                        <button type="button" class="btn btn-secondary btn-lg" id="meeting_result_button">Hayır</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="meeting_result_next_modal" style="z-index:1061;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>İkinci toplantı için;</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="meeting_date">Toplantı Tarihi</label>
                            <input type="text" id="next_meeting_date" name="meeting_date"
                                class="form-control datepicker datedotmask"
                                value="<?php echo e(\Carbon\Carbon::parse($lawsuit->meeting_date)->format('d.m.Y')); ?>"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="meeting_hour">Toplantı Saati</label>
                            <input type="text" id="next_meeting_hour" name="meeting_start_hour"
                                class="form-control timepicker" value="<?php echo e($lawsuit->meeting_start_hour); ?>" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg"
                            onclick="meetingResultWrite('<?php echo e(strtolower(\App\Services\HelperService::numberToOrdinal($lawsuit->meeting_count + 1))); ?>', '', '<?php echo e($lawsuit->id); ?>')">Tamam</button>
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">İptal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="meeting_result_modal" style="z-index:1061;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Toplantı Tutanağı Sonucu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Hangi belgeyi oluşturmak istersiniz?</label>
                            <div class="kt-checkbox-list">
                                <label class="kt-checkbox">
                                    <input type="radio" name="document_type" value="agreement_document"> Anlaşma
                                    Belgesi
                                    Oluştur
                                    <span></span>
                                </label>
                                <label class="kt-checkbox">
                                    <input type="radio" name="document_type" value="final_protocol"> Son Tutanak
                                    Oluştur
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <?php if($lawsuit->lawsuit_subject_id == 2): ?>
                            <div class="form-group subject_answer" style="display: none;">
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
                        <?php else: ?>
                            <div class="form-group subject_answer" style="display: none;">
                                <label>Hangi konuda anlaşma sağlandı?</label>
                                <div class="kt-checkbox-list">
                                    <?php $__currentLoopData = $agreement_types->where('back_to_work', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="kt-checkbox">
                                            <input type="radio" name="subject_answer" value="<?php echo e($type->id); ?>"
                                                data-template="<?php echo e($type->description); ?>"> <?php echo e($type->name); ?>

                                            <span></span>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Sonuç</label>
                            <textarea class="form-control subject_answer_result" disabled></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg meeting_result_ok_button">Tamam</button>
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">İptal</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('mediator.document.layout.result_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('mediator.document.layout.matters_discussed_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/addSubSide.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/page/meeting_protocol/wizard.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/printThis.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/side_management_functions.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script>
        $('#cikti_btn').on("click", function() {
            $('.print_side').printThis({
                importCSS: false,
                loadCSS: "/css/print.css"
            });
        });

        $('#meeting_result_next_button').on("click", function() {
            $("#meeting_result_question_modal").modal("hide");
            $("#meeting_result_next_modal").modal("show");
        });

        $('#meeting_result_button').on("click", function() {
            $("#meeting_result_question_modal").modal("hide");
            $("#meeting_result_modal").modal("show");
        });

        $('input[name="document_type"]').on('change', function() {
            var document_type = $('input[name="document_type"]:checked').val();
            if (document_type === "agreement_document") {
                $('.subject_answer').show();
            } else if (document_type === "final_protocol") {
                $('.subject_answer').hide();
                $('.subject_answer_result').val("-");
            }
        });

        $('input[name="subject_answer"]').on('change', function() {
            var subject_answer_element = $('input[name="subject_answer"]:checked');
            $('.subject_answer_result').val(subject_answer_element.data('template'));
        });

        $('.meeting_result_ok_button').on('click', function() {
            if (typeof $('input[name="document_type"]:checked').val() === 'undefined') {
                toastr["error"]("Lütfen belge tipini seçiniz!");
                return false;
            }
            if ($('input[name="document_type"]:checked').val() === "agreement_document" && typeof $(
                    'input[name="subject_answer"]:checked').val() === 'undefined') {
                toastr["error"]("Lütfen anlaşma tipini seçiniz!");
                return false;
            }
            meetingResultWrite(0, $('.subject_answer_result').val(), '<?php echo e($lawsuit->id); ?>');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .swal2-container {
            z-index: 2000;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/meeting_protocol/create.blade.php ENDPATH**/ ?>