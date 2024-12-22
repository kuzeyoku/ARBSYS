@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kvkk" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'KVKK Belgesi Oluştur'],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Taraf Seçimi',
                        2 => 'Önizleme',
                        3 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                {{ Form::open(['url' => route('kvkk.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form']) }}

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Taraf Seçimi</div>
                                    @include('mediator.document.layout.side_select', $lawsuit)
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Önizleme</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="kt-wizard-v4__form">
                                                <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                    değişkenler kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri
                                                    ile değiştirilecektir.</p>
                                                {{Form::textarea("preview", null, ["id" => "preview_area", "data-url" => route('kvkk.preview', $lawsuit)])}}
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
                                                    <a href="{{ route('lawsuit.index') }}"
                                                       class="btn btn-danger btn-lg">Çık</a>
                                                    <a href="javascript:;" class="btn btn-success float-right"
                                                       id="cikti_btn">
                                                        <i class="fas fa-print"></i> Çıktı Al
                                                    </a>
                                                    <div class="print_side" id=""></div>
                                                </div>
                                                <div class="modal" tabindex="-1" role="dialog" id="next_level">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Arabulucu Belirleme Tutanağı Hazırlamak İstiyor
                                                                    musunuz?</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('arbiter_define_protocol.create', $lawsuit->id) }}"
                                                                   class="btn btn-success btn-lg">Evet</a>
                                                                <a href="{{ route('lawsuit.index') }}"
                                                                   class="btn btn-primary btn-lg">Hayır</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('layout.form_actions')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/addSubSide.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/page/kvkk_document/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/side_management_functions.js') }}?v={{ time() }}"></script>
@endsection
