@extends('layout.main')
@section('content')
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor arbiter_define_protocol" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosya Listele', null => 'Yetki belgesi'],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Toplantı Bilgileri',
                        2 => 'Önizleme',
                        3 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <form class="kt-form" id="kt_form" method="POST"
                                    action="{{ route('authority_document.store', $lawsuit) }}">
                                    @csrf

                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Toplantı Bilgileri</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Toplantı Tarihi</label>
                                                    <input type="text" name="meeting_date"
                                                        class="form-control datepicker datedotmask" autocomplete="off" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Toplantı Saati</label>
                                                    <input type="text" name="meeting_hour"
                                                        class="form-control timepicker" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Önizleme</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan değişkenler
                                                    kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                    değiştirilecektir.</p>
                                                <textarea class="preview_area" name="preview" id="preview_area"
                                                    data-url="{{ route('authority_document.preview', $lawsuit) }}">
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
    <script src="{{ asset('js/page/authority_document/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
@endsection
