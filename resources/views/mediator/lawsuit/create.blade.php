@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" page-name="lawsuit">
        @include('layout.breadcrumb', ['url' => [null => 'Dosya Aç']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">
                <div class="kt-wizard-v4__nav">
                    <div class="kt-wizard-v4__nav-items ">
                        <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Taraf Bilgileri
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Dosya Bilgileri
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Kayıt Bilgileri
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Doğrulama
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Nav -->
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <!--begin: Form Wizard Form-->
                                <form class="kt-form" id="kt_form" method="POST" action="{{ route('lawsuit.store') }}">
                                    @csrf
                                    <!--begin: Form Wizard Step 1-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                         data-ktwizard-state="current">
                                        <div class="kt-heading kt-heading--md">Taraf Bilgilerini Giriniz</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div id="applicant_select">
                                                    <div class="form-group">
                                                        <label for="applicant_type">Taraf Sıfatı</label>
                                                        <select class="form-control" id="applicant_type"
                                                                name="applicant_type">
                                                            <option value="0">-- Seçiniz --</option>
                                                            <option value="1">Başvurucu</option>
                                                            <option value="2">Diğer Taraf</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gerçek Kişi/Tüzel Kişi</label>
                                                        <div class="kt-radio-inline row">
                                                            <label class="kt-radio">
                                                                <input type="radio" data-type="person" name="isPerson"
                                                                       class="personTypeSelect"
                                                                       data-url="{{route("api.get_person_modal_content")}}">
                                                                Gerçek Kişi
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" data-type="company" name="isPerson"
                                                                       class="personTypeSelect"
                                                                       data-url="{{route("api.get_person_modal_content")}}">
                                                                Tüzel Kişi
                                                                <span></span>
                                                            </label>
                                                            {{-- <label class="kt-radio">
                                                                <input type="radio" personType="person_custom" name="isPerson"
                                                                    class="personTypeSelect"> Kamu Tüzel Kişisi
                                                                <span></span>
                                                            </label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row sideBasvuranRow mt-3"></div>
                                                <div class="row sideKarsiTarafRow mt-3"></div>
                                                <button class="btn btn-primary mt-3" type="button" style="display: none"
                                                        id="applicant_add_button" data-toggle="modal"
                                                        data-target="#applicantModal">Taraf Ekle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 1-->

                                    <!--begin: Form Wizard Step 2-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Dosya Bilgileri</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group">
                                                    <input type="hidden" name="delivery_by">
                                                    <label for="delivery_by">Arabuluculuk Görevini Nasıl Üstlendiniz
                                                        ?</label>
                                                    {{ Form::select('lawsuit_type', App\Models\Lawsuit\LawsuitType::selectToArray(), 'default', ['class' => 'form-control', 'id' => 'delivery_by', 'placeholder' => '--Seçiniz--']) }}
                                                </div>
                                                <div class="form-group" style="display:none;"
                                                     id="lawsuit_subject_types_select">
                                                    <label for="lawsuit_subject_types">Uyuşmazlık Türü</label>
                                                    {{ Form::select('lawsuit_subject_type', App\Models\Lawsuit\LawsuitSubjectType::selectToArray(), 'default', ['class' => 'form-control', 'id' => 'lawsuit_subject_types', 'placeholder' => '--Seçiniz--']) }}

                                                </div>
                                                <div class="form-group" style="display:none;"
                                                     id="lawsuit_subjects_select">
                                                    <label for="lawsuit_subjects">Uyuşmazlık Konusu</label>
                                                    <select class="form-control" id="lawsuit_subjects"
                                                            name="lawsuit_subject">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 2-->

                                    <!--begin: Form Wizard Step 3-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Dosya Detaylarını girin</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Arabuluculuk Bürosu</label>
                                                            {{ Form::select('mediation_office', App\Models\MediationOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Arabuluculuk Merkezi</label>
                                                            {{ Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="application_document_no">
                                                    <label>Başvuru Dosya No :</label>
                                                    <input type="text" class="form-control"
                                                           name="application_document_no" autocomplete="off"
                                                           placeholder="{{ date('Y') }}/"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Arabuluculuk Dosya No :</label>
                                                    <input type="text" class="form-control"
                                                           name="mediation_document_no" autocomplete="off"
                                                           placeholder="{{ date('Y') }}/"/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6" id="application_date">
                                                        <div class="form-group">
                                                            <label>Başvuru Tarihi :</label>
                                                            <input type="date" class="form-control application_date"
                                                                   name="application_date" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-6" id="job_date">
                                                        <div class="form-group">
                                                            <label>Görevi Kabul Tarihi :</label>
                                                            <input type="date" class="form-control job_date "
                                                                   name="job_date" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group" id="process_start_date"
                                                             style="display: none;">
                                                            <label>Sürecin Başlangıç Tarihi :</label>
                                                            <input type="text"
                                                                   class="form-control datepicker datedotmask"
                                                                   name="process_start_date" autocomplete="off">
                                                        </div>
                                                        <div class="form-group" style="display: none">
                                                            <label for="process_type_id">Süreç Bilgisi: </label>
                                                            {{ Form::select('process_type', App\Models\Lawsuit\LawsuitProcessType::selectToArray(), ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                                                        </div>
                                                        <div class="form-group" id="result_type" style="display:none;">
                                                            <label>Sonuç Türü: </label>
                                                            {{ Form::select('result_type', App\Models\Lawsuit\LawsuitResultType::selectToArray(), ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                                                        </div>
                                                        <div class="form-group" id="result_date" style="display:none;">
                                                            <label>Sonuçlandırma Tarihi :</label>
                                                            <input type="text"
                                                                   class="form-control datepicker datedotmask"
                                                                   name="result_date" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 3-->

                                    <!--begin: Form Wizard Step 4-->
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Detaylarınızı İnceleyin ve Gönderin</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__review">
                                                <div id="print_content">
                                                    <div class="kt-wizard-v4__review-title">
                                                        Taraf Detayları
                                                    </div>
                                                    <div class="kt-wizard-v4__review-content" id="step1_details">
                                                    </div>
                                                    <div class="kt-wizard-v4__review-content" id="step2_details">
                                                    </div>
                                                    <div class="kt-wizard-v4__review-content" id="step3_details">
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v4__review-item" id="saved"
                                                     style="display: none;">
                                                    <div class="neo-notification row">
                                                        <i class="material-icons col-1 align-middle my-auto">notifications</i>
                                                        <div class="col-11">
                                                            Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                            dilediginiz zaman erişebilirsiniz.
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-form__actions">
                                        <button
                                                class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                                data-ktwizard-type="action-prev">
                                            GERİ
                                        </button>
                                        <button type="button"
                                                class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u custom-save-button"
                                                data-toggle="modal" data-target="#exampleModal"
                                                data-ktwizard-type="action-submit">
                                            KAYDET
                                        </button>
                                        <button
                                                class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u custom-next-button-date-logic"
                                                data-ktwizard-type="action-next">
                                            İLERİ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------------------------- INFO MODALS --------------------------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sürece Nasıl Devam Etmek İstersiniz ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Dosya Kaydedildi Davet mektubu oluşturulabilir veya Tutanak Düzenleme için Dosyalarım kısmına
                        gidebilirsiniz.
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('invitation_letter.create', 0) }}" id="davet-mektubu-olustur"
                           class="btn btn-primary">Davet
                            Mektubu
                            Oluştur</a>
                        <button type="button" id="dosya-olustur" class="btn btn-success">Kaydet ve Dosyalarıma
                            Git
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" data-keyboard="false" id="personModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" style="color:#2C3E50;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn personAddButton" style="background: #149FFC; color: white;"
                                    id="">Ekle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Taraf Modal --}}
        <div class="modal" tabindex="-1" role="dialog" id="applicantModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Taraf Bilgileri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="applicant_type">Taraf Sıfatı</label>
                            <select class="form-control" id="applicant_type" name="applicant_type">
                                <option value="0">-- Seçiniz --</option>
                                <option value="1">Başvurucu</option>
                                <option value="2">Diğer Taraf</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gerçek Kişi/Tüzel Kişi</label>
                            <div class="kt-radio-inline">
                                <label class="kt-radio">
                                    <input type="radio" data-type="person" name="isPerson" class="personTypeSelect"
                                           data-url="{{route("api.get_person_modal_content")}}">
                                    Gerçek Kişi
                                    <span></span>
                                </label>
                                <label class="kt-radio">
                                    <input type="radio" data-type="company" name="isPerson" class="personTypeSelect"
                                           data-url="{{route("api.get_person_modal_content")}}">
                                    Tüzel Kişi
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('js/customWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/dynamicRulesForWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/page/lawsuit/lawsuit.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
@endsection
