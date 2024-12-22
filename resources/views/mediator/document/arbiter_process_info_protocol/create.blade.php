@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [
                route('lawsuit.index') => 'Dosyalar',
                null => 'Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı',
            ],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Taraf Seçimi',
                        2 => 'Toplantı Bilgileri',
                        3 => 'Önizleme',
                        4 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                {{ Form::open(['url' => route('arbiter_process_info_protocol.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form']) }}
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Hangi taraf(lar) toplantıya katıldı?</div>
                                    @include('mediator.document.layout.side_select', $lawsuit)
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Toplantı Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                {{ Form::label("meeting_date", "Toplantı Tarihi") }}
                                                {{Form::date("meeting_date", $lawsuit->meeting_date, ['class' => 'form-control', 'required'])}}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label("meeting_hour", "Toplantı Saati") }}
                                                {{Form::time("meeting_hour", $lawsuit->meeting_start_hour, ['class' => 'form-control', 'required'])}}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Yeri') }}
                                                {{ Form::select('mediation_center', \App\Models\MediationCenter::selectToArray(), auth()->user()->mediator->default_mediation_center ?? $lawsuit->mediation_center_id, ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Adresi Elle Gir') }}
                                                {{ Form::checkbox('meeting_address_check', true, false, ['id' => 'meeting_address_check']) }}
                                            </div>
                                            <div class="form-group" style="display:none" id="meeting_address">
                                                {{ Form::label('meeting_address', 'Toplantı Adresi') }}
                                                {{ Form::text('meeting_address', $lawsuit->meeting_address, ['class' => 'form-control', 'placeholder' => 'Toplantı Adresi Yazınız']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Önizleme</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                değişkenler
                                                kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                değiştirilecektir.</p>
                                            <textarea class="preview_area" name="preview" id="preview_area"
                                                      data-url="{{ route('arbiter_process_info_protocol.preview', $lawsuit) }}">
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
                                                    <a class="btn btn-success btn-lg" href="#next_level"
                                                       data-toggle="modal">Evet</a>
                                                    <a class="btn btn-danger btn-lg"
                                                       href="{{ route('lawsuit.index') }}">Çık</a>
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

                                @include('layout.form_actions')

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="next_level">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>KVKK Belgesi Oluşturmak İstiyormusunuz ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('kvkk.create', $lawsuit->id) }}" class="btn btn-success btn-lg">Evet</a>
                        <a href="{{ route('lawsuit.index') }}" class="btn btn-primary btn-lg">Hayır</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('mediator.lawsuit.partials.add_sub_side')
    @include('mediator.lawsuit.partials.side_modals') --}}
@endsection
@section('script')
    <script src="{{ asset('js/addSubSide.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/page/arbiter_process_info_protocol/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/side_management_functions.js') }}?v={{ time() }}"></script>
@endsection
