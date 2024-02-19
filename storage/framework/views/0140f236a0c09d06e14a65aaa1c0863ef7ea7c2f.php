
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor invitation_letter" id="kt_content">

        <?php echo $__env->make('layout.breadcrumb', [
            'url' => [
                route('lawsuit.index') => 'Dosya Listele',
                null => 'Son Tutanak Oluştur',
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                <?php echo $__env->make('mediator.document.nav', [
                    'nav' => [
                        1 => 'Toplantı Bilgileri',
                        2 => 'Taraf Bilgileri',
                        3 => 'Sonuç Bilgileri',
                        4 => 'Önizleme',
                        5 => 'Bitir',
                    ],
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <?php echo e(Form::open(['url' => route('final_protocol.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form'])); ?>


                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Toplantı Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">

                                            <div class="form-group">
                                                <?php echo e(Form::label('Toplantı Yeri')); ?>

                                                <?php echo e(Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), $lawsuit->mediation_center ?? auth()->user()->mediator->meeting_address_proposal ? auth()->user()->mediator->mediation_center_id : null, ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])); ?>

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
                                    <div class="kt-heading kt-heading--md">Taraf Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <label>Toplantıya katılmayan taraf var mı?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="meeting_not_join" value="0">
                                                        Hayır
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="meeting_not_join" value="1">
                                                        Evet
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="sides" style="display: none">
                                                <div class="form-group">
                                                    <label>Seçiniz</label>
                                                    <div class="kt-checkbox-list">
                                                        <?php echo $__env->make(
                                                            'mediator.document.layout.side_select',
                                                            $lawsuit, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="suggested_solution">
                                                <label>Taraflara çözüm önerisinde bulunuldu mu?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="suggested_solution"
                                                            value="Taraflara çözüm önerisinde bulunulmuştur."> Evet
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="suggested_solution"
                                                            value="Taraflara çözüm önerisinde bulunulmamıştır."> Hayır
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Sonuç Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group">
                                                    <label>Sonuç Türü: </label>
                                                    <?php echo e(Form::select('result_type', $result_types->pluck('name', 'id'), 'default', ['class' => 'form-control'])); ?>

                                                </div>
                                                <div class="form-group" id="session_count">
                                                    <label>Oturum Sayısı</label>
                                                    <input type="number" step="1" min="1" value="1"
                                                        name="session_count" class="form-control" autocomplete="off">
                                                </div>
                                                <div class="form-group" id="session_time">
                                                    <label>Oturum Süresi</label>
                                                    <input type="text" name="session_time" class="form-control"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Detaylarınızı İnceleyin</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                değişkenler kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                değiştirilecektir.</p>
                                            <textarea class="preview_area" name="preview" id="preview_area"
                                                data-url="<?php echo e(route('final_protocol.preview', $lawsuit)); ?>">
                                                </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Detaylarınızı Gönderin</div>
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
                                                    <a href="<?php echo e(route('lawsuit.index')); ?>"
                                                        class="btn btn-danger btn-lg">Çık</a>
                                                    <a href="javascript:;" class="btn btn-success float-right"
                                                        id="cikti_btn">
                                                        <i class="fas fa-print"></i> Çıktı Al
                                                    </a>
                                                    <div class="print_side"></div>
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
        <!-- end:: Content -->

        <!-- end:: Modals -->
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="select_signature_method_modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Tutanak Hangi Yöntemle
                            İmzalanacak?</h5>
                    </div>
                    <div class="modal-body">
                        <div class="kt-checkbox-list">
                            <div class="row">
                                <div class="col-12">
                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                        <input type="radio" name="signature_method" value="birlikte">Birlikte imza
                                        altına alınarak
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                        <input type="radio" name="signature_method"
                                            value="imzalar sonradan tamamlatılarak">İmzalar sonradan tamamlatılarak
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                        <input type="radio" name="signature_method" value="e-imza yöntemiyle">E-İmza
                                        yöntemiyle
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="background: #149FFC; color: white;"
                            id="select_signature_method_button">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="select_anlasilan_modal">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Anlaşılan Hususlar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="kt-checkbox-list">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="background: #149FFC; color: white;"
                            id="select_anlasilan_button">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="select_anlasilmayan_modal">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Anlaşılmayan Hususlar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="kt-checkbox-list">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="background: #149FFC; color: white;"
                            id="select_anlasilmayan_button">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('mediator.document.layout.matters_discussed_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('mediator.document.layout.result_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('mediator.lawsuit.partials.add_sub_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('mediator.lawsuit.partials.subject_replace_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('mediator.lawsuit.partials.side_modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/addSubSide.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/page/final_protocol/wizard.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/printThis.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/side_management_functions.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script>
        $("[name='meeting_not_join']").on('change', function() {
            if ($(this).val() == 1) {
                $("#sides").show();
            } else {
                $("#sides").hide();
            }
        });

        $(document).on("click", "#anlasilan-hususlar", function() {
            $("#select_anlasilan_modal").modal("show");
        });

        $(document).on("click", "#select_anlasilan_button", function() {
            var anlasilan = "";
            $("input[name='anlasilan_radio']:checked").each(function() {
                anlasilan += $(this).val() + ", ";
            });
            $("#anlasilan-hususlar").html(anlasilan);
            $("#select_anlasilan_modal").modal("hide");
        });

        $(document).on("click", "#anlasilamayan-hususlar", function() {
            $("#select_anlasilmayan_modal").modal("show");
        });

        $(document).on("click", "#select_anlasilmayan_button", function() {
            var anlasilmayan = "";
            $("input[name='anlasilmayan_radio']:checked").each(function() {
                anlasilmayan += $(this).val() + ", ";
            });
            $("#anlasilamayan-hususlar").html(anlasilmayan);
            $("#select_anlasilmayan_modal").modal("hide");
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/final_protocol/create.blade.php ENDPATH**/ ?>