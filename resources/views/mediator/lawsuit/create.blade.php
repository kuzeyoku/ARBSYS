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
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                {{Form::open(["url" => route("lawsuit.store"), "method" => "POST", "class" => "kt-form", "id" => "kt_form"])}}
                                <!--begin: Form Wizard Step 1-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Taraf Bilgilerini Giriniz</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div id="applicant_select">
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
                                            <div class="form-group" id="lawsuit-subject-types">
                                                {{Form::label("lawsuit_subject_type_id", "Uyuşmazlık Türü")}}
                                                {{Form::select('lawsuit_subject_type_id', App\Models\Lawsuit\LawsuitSubjectType::selectToArray(), 'default', ['class' => 'form-control', 'placeholder' => '--Seçiniz--', "data-url" => route("api.get_lawsuit_subjects")])}}
                                            </div>
                                            <div class="form-group d-none" id="lawsuit-subjects">
                                                {{Form::label("lawsuit_subject_id", "Uyuşmazlık Konusu")}}
                                                {{Form::select("lawsuit_subject_id", [], "default", ["class" => "form-control", "placeholder" => "--Seçiniz--"])}}
                                            </div>

                                            <div class="mb-5">
                                                <p class="font-weight-bold">Uyuşmazlık Dava Şartı Kapsamında mı?</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="davaSarti"
                                                        id="davaSartiKapsaminda" checked>
                                                    <label class="form-check-label" for="davaSartiKapsaminda">
                                                        Dava şartı arabuluculuk kapsamında
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="davaSarti"
                                                        id="ihtiyariKapsamda">
                                                    <label class="form-check-label" for="ihtiyariKapsamda">
                                                        İhtiyari arabuluculuk kapsamında
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-5">
                                                <p class="font-weight-bold">Arabulucu dosyaya nasıl atandı?</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="atanmaSekli"
                                                        id="adliyeGorevlendirdi" checked>
                                                    <label class="form-check-label" for="adliyeGorevlendirdi">
                                                        Adliye Arabuluculuk Bürosu tarafından görevlendirildim
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="atanmaSekli"
                                                        id="taraflarSecti">
                                                    <label class="form-check-label" for="taraflarSecti">
                                                        Taraflarca seçildim
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-5">
                                                <p class="font-weight-bold">Dosya Nasıl Açıldı?</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="acilmaSekli"
                                                        id="tarafBasvurusu" checked>
                                                    <label class="form-check-label" for="tarafBasvurusu">
                                                        Taraf başvurusu üzerine
                                                        <small class="text-muted ml-2">Adliye Arabuluculuk Bürosu tarafından
                                                            açıldı.</small>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="acilmaSekli"
                                                        id="belirlemeTutanagi">
                                                    <label class="form-check-label" for="belirlemeTutanagi">
                                                        Arabulucu belirleme tutanağı ile
                                                        <small class="text-muted ml-2">Adliye Arabuluculuk Bürosu tarafından
                                                            açıldı.</small>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="acilmaSekli"
                                                        id="portalUzerinden">
                                                    <label class="form-check-label" for="portalUzerinden">
                                                        Arabulucu portal üzerinden
                                                        <small class="text-muted ml-2">Arabulucu tarafından açıldı.</small>
                                                    </label>
                                                </div>
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
                                                        {{Form::label('mediation_office_id', 'Arabuluculuk Bürosu')}}
                                                        {{Form::select('mediation_office_id', App\Models\MediationOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        {{Form::label('mediation_center_id', 'Arabuluculuk Merkezi')}}
                                                        {{Form::select('mediation_center_id', App\Models\MediationCenter::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group" id="application_document_no">
                                                        {{Form::label('application_document_no', 'Başvuru Dosya No')}}
                                                        {{Form::text('application_document_no', null, ['class' => 'form-control', 'placeholder' => date('Y') . '/'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        {{Form::label("mediation_document_no", "Arabuluculuk Dosya No")}}
                                                        {{Form::text("mediation_document_no", null, ["class" => "form-control", "placeholder" => date('Y') . "/"])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{Form::label('application_date', 'Başvuru Tarihi')}}
                                                        {{Form::date('application_date', null, ['class' => 'form-control'])}}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{Form::label('job_date', 'Görevi Kabul Tarihi')}}
                                                        {{Form::date('job_date', null, ['class' => 'form-control'])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        {{Form::label("process_type", "Süreç Bilgisi")}}
                                                        {{Form::select('process_type', App\Models\Lawsuit\LawsuitProcessType::selectToArray(), "default", ['class' => 'form-control'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        {{Form::label('process_start_date', 'Sürecin Başlangıç Tarihi')}}
                                                        {{Form::date('process_start_date', null, ['class' => 'form-control'])}}
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
                                            <div class="kt-wizard-v4__review-item" id="saved" style="display: none;">
                                                <div class="alert alert-solid-success font-weight-bold">
                                                    <i class="fas fa-bell my-auto align-middle mr-2"></i> Dosya başarıyla
                                                    kaydedilmiştir. Dosyalarım sekmesinden erişebilirsiniz.
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
                                        data-toggle="modal" data-target="#exampleModal" data-ktwizard-type="action-submit">
                                        KAYDET
                                    </button>
                                    <button
                                        class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u custom-next-button-date-logic"
                                        data-ktwizard-type="action-next">
                                        İLERİ
                                    </button>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("mediator.lawsuit.create_file_success_modal")
        @include("mediator.person.modals.modal")
        @include("mediator.lawsuit.applicant_modal")
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/page/lawsuit/lawsuit.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/customWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/dynamicRulesForWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
@endsection