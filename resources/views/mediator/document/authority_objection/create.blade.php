@extends('layout.main')
@section('content')
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" page-name="authority_objection">

        @include('layout.breadcrumb', [
            'url' => [
                route('lawsuit.index') => 'Dosya Listele',
                null => 'Yetki İtirazı Üst Yazı Oluştur',
            ],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Başvurucu',
                        2 => 'Tic. ve San. Odası',
                        3 => 'Önizleme',
                        4 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <!--begin: Form Wizard Form-->
                                <form class="kt-form" id="kt_form" method="POST"
                                    action="{{ route('authority_objection.store', $lawsuit) }}">
                                    @csrf
                                    <!--begin: Form Wizard Step 1-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                        data-ktwizard-state="current">
                                        <div class="kt-heading kt-heading--md">Başvurucu</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Çalıştığı
                                                        Yer</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="work_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Çalıştığı Süre
                                                        (Yıl)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" min="1" class="form-control"
                                                            name="work_time" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 1-->

                                    <!--begin: Form Wizard Step 2-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Ticaret ve Sanayi Odası</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Ticaret ve
                                                        Sanayi Odası</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            name="chamber_of_commerce">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Faaliyet belgesi
                                                        ve Ticaret Sicil Gazetesi Tarihi</label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control datepicker datedotmask" name="date"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Sayı No</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="number"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label font-weight-bold">Sayfa
                                                        No</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" name="page"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 2-->

                                    <!--begin: Form Wizard Step 3-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Önizleme</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                    değişkenler kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                    değiştirilecektir.</p>
                                                <textarea class="preview-area" name="preview" id="preview-area"
                                                    data-url="{{ route('authority_objection.preview', $lawsuit) }}">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Form Wizard Step 3-->

                                    <!--begin: Form Wizard Step 4-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Bitir</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__review">
                                                <p class="kt-font-bold" id="before_saved">
                                                    Çıktı almak ve daha sonradan evraklarım sekmesinden evraklarınızı
                                                    görüntülemek için kaydet butonu ile kaydedebilirsiniz.
                                                </p>
                                                <div class="kt-wizard-v4__review-item" id="saved"
                                                    style="display: none;">
                                                    <div class="neo-notification row">
                                                        <i
                                                            class="material-icons col-1 align-middle my-auto">notifications</i>
                                                        <div class="col-11">
                                                            Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                            dilediginiz zaman erişebilirsiniz.
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="kt-wizard-v4__review-content">
                                                        <a class="btn btn-danger btn-lg"
                                                            href="{{ route('lawsuit.index') }}">Çık</a>
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

                                    @include('layout.form_actions')

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/page/authority_objection/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
@endsection
