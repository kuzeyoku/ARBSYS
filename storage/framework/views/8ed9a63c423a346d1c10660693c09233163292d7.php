
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor arbiter_define_protocol" id="kt_content">

        <?php echo $__env->make('layout.breadcrumb', [
            'url' => [
                route('lawsuit.index') => 'Dosya Listele',
                null => 'Arabulucu Belirleme Tutanağı',
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                <?php echo $__env->make('mediator.document.nav', [
                    'nav' => [
                        1 => 'Taraf Seçimi',
                        2 => 'Önizleme',
                        3 => 'Bitir',
                    ],
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!--end: Form Wizard Nav -->
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
                                <?php echo e(Form::open(['url' => route('arbiter_define_protocol.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form'])); ?>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Adliyeye siz mi götüreceksiniz?</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="arbiter_define_protocol_answer"
                                                            value="1"> Evet
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="arbiter_define_protocol_answer"
                                                            value="0"> Hayır
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p class="answer_yes font-weight-bold" style="display:none;color:#2C3E50;">
                                                Formu adliyeye ulaştıracak çalışanınızın;</p>
                                            <div class="form-group row answer_yes" style="display: none">
                                                <label for="" class="col-sm-4 col-form-label font-weight-bold"
                                                    style="color:#2C3E50;">T.C. Kimlik No</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control tc arbiterrq" id="arbiterTcNo"
                                                        name="arbiter_tc" placeholder="T.C. No yazınız">
                                                </div>
                                            </div>
                                            <div class="form-group row answer_yes" style="display: none">
                                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-bold"
                                                    style="color:#2C3E50;">Adı Soyadı</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control arbiterrq" id="arbiterName"
                                                        name="arbiter_name" placeholder="Ad Soyad yazınız">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Önizleme</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form" id="before_saved">
                                            <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan değişkenler
                                                kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                değiştirilecektir.</p>
                                            <textarea class="preview_area" name="preview" id="preview_area"
                                                data-url="<?php echo e(route('arbiter_define_protocol.preview', $lawsuit)); ?>">
                                                </textarea>
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
                                                    <a class="btn btn-danger btn-lg"
                                                        href="<?php echo e(route('lawsuit.index')); ?>">Çık</a>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/page/arbiter_define_protocol/wizard.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/printThis.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script>
        $("input[name='arbiter_define_protocol_answer']").on('change', function() {
            if ($(this).val() == 0) {
                $(".answer_yes").show();
            } else {
                $(".answer_yes").hide();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/arbiter_define_protocol/create.blade.php ENDPATH**/ ?>