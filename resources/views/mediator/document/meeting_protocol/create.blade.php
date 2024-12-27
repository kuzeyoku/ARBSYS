@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content"
         page-name="meeting_protocol">

        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'Toplantı Tutanağı Oluştur'],
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

                                {{ Form::open(['url' => route('meeting_protocol.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form']) }}

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Taraf Seçimi -</div>
                                    @include('mediator.document.layout.side_select', $lawsuit)
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Müzakere</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Tarihi') }}
                                                {{ Form::date('meeting_date', $lawsuit->meeting_date, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Saati') }}
                                                {{ Form::time('meeting_start_hour', $lawsuit->meeting_start_hour, ['class' => 'form-control']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label("mediation_center_id",'Toplantı Yeri') }}
                                                {{ Form::select('mediation_center_id', App\Models\MediationCenter::selectToArray(), $lawsuit->mediation_center_id ?? auth()->user()->mediator->meeting_address_proposal ? auth()->user()->mediator->mediation_center_id : null, ['id' => 'mediation_center', 'class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::checkbox('meeting_address_check', true, false, ['id' => 'meeting_address_check']) }}
                                                {{ Form::label('Adresi Elle Gir') }}
                                            </div>
                                            <div class="form-group" style="display: none" id="meeting_address">
                                                {{ Form::label('Toplantı Adresi') }}
                                                {{ Form::text('meeting_address', null, ['class' => 'form-control', 'placeholder' => 'Açık Adres Giriniz']) }}
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
                                                <textarea class="preview-area" name="preview" id="preview-area"
                                                          data-url="{{ route('meeting_protocol.preview', $lawsuit) }}">
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
                                                <div class="alert alert-solid-success font-weight-bold">
                                                    <i class="fas fa-bell my-auto align-middle mr-2"></i> Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                    dilediginiz zaman erişebilirsiniz.
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

                                @include('layout.form_actions')
                                @include('mediator.document.layout.result_modal')
                                @include('mediator.document.layout.matters_discussed_modal')
                                {{ Form::close() }}
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
                        <a href="{{ route('meeting_protocol.create', $lawsuit) }}" class="btn btn-success btn-lg">Yeni
                            Bir Toplantı Tutanağı Hazırla</a>
                        <a href="{{ route('agreement_document.create', $lawsuit) }}" class="btn btn-success btn-lg">Anlaşma
                            Belgesi Hazırla</a>
                        <a href="{{ route('final_protocol.create', $lawsuit) }}" class="btn btn-success btn-lg">Son
                            Tutanak Hazırla</a>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('lawsuit.index') }}" class="btn btn-primary btn-lg">İptal</a>
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
                                id="meeting_result_next_button">Evet
                        </button>
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
                                   value="{{ \Carbon\Carbon::parse($lawsuit->meeting_date)->format('d.m.Y') }}"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="meeting_hour">Toplantı Saati</label>
                            <input type="text" id="next_meeting_hour" name="meeting_start_hour"
                                   class="form-control timepicker" value="{{ $lawsuit->meeting_start_hour }}"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg"
                                onclick="meetingResultWrite('{{ strtolower(\App\Services\HelperService::numberToOrdinal($lawsuit->meeting_count + 1)) }}', '', '{{ $lawsuit->id }}')">
                            Tamam
                        </button>
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
                        @if ($lawsuit->lawsuit_subject_id == 2)
                            <div class="form-group subject_answer" style="display: none;">
                                <label>Hangi konuda anlaşma sağlandı?</label>
                                <div class="kt-checkbox-list">
                                    @foreach ($agreement_types->where('back_to_work', true) as $type)
                                        <label class="kt-checkbox">
                                            <input type="radio" name="subject_answer" value="{{ $type->id }}"
                                                   data-template="{{ $type->description }}"> {{ $type->name }}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="form-group subject_answer" style="display: none;">
                                <label>Hangi konuda anlaşma sağlandı?</label>
                                <div class="kt-checkbox-list">
                                    @foreach ($agreement_types->where('back_to_work', false) as $type)
                                        <label class="kt-checkbox">
                                            <input type="radio" name="subject_answer" value="{{ $type->id }}"
                                                   data-template="{{ $type->description }}"> {{ $type->name }}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/addSubSide.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/customWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/dynamicRulesForWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/side_management_functions.js') }}?v={{ time() }}"></script>
@endsection
