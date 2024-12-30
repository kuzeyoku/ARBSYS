@extends('layout.main')
@section('style')
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" page-name="lawsuit">
        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'Dosya Aç'],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid lawsuit_edit">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">
                <div class="kt-wizard-v4__nav">
                    <div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
                        <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    1
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
                                    2
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
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <!--begin: Form Wizard Form-->

                                {{ Form::open(['url' => route('lawsuit.update', $lawsuit), 'method' => 'PUT', 'class' => 'kt-form', 'id' => 'kt_form']) }}
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Dosya Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <input type="hidden" name="delivery_by"
                                                    value="{{ $lawsuit->lawsuit_type->delivery_by }}">
                                                <label for="delivery_by">Bu Dosya Size Hangi Yola Ulaştı?</label>
                                                <select class="form-control" id="delivery_by" name="lawsuit_type_id">
                                                    <option value="">Seçin</option>
                                                    @foreach ($lawsuit_types as $lawsuit_type)
                                                        <option data-delivery="{{ $lawsuit_type->delivery_by }}"
                                                            value="{{ $lawsuit_type->id }}"
                                                            {{ $lawsuit->lawsuit_type_id == $lawsuit_type->id ? 'selected' : '' }}>
                                                            {{ $lawsuit_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" id="lawsuit_subject_types_select">
                                                <label for="lawsuit_subject_types">Uyuşmazlık Türü</label>
                                                <select class="form-control" id="lawsuit_subject_types"
                                                    name="lawsuit_subject_type_id">
                                                    <option value="">Seçin</option>
                                                    @foreach ($subject_types as $subject_type)
                                                        <option value="{{ $subject_type->id }}"
                                                            {{ $lawsuit->lawsuit_subject_type_id == $subject_type->id ? 'selected' : '' }}>
                                                            {{ $subject_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" id="lawsuit_subjects_select">
                                                <label for="lawsuit_subjects">Uyuşmazlık Konusu</label>
                                                <select class="form-control" id="lawsuit_subjects"
                                                    name="lawsuit_subject_id">
                                                    <option value="">Seçin</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}"
                                                            {{ $lawsuit->lawsuit_subject_id == $subject->id ? 'selected' : '' }}>
                                                            {{ $subject->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2-->

                                <!--begin: Form Wizard Step 2-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Dosya Detaylarını girin</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group" id="firm">
                                                <label>Arabuluculuk<span class="firm_text"> Bürosu</span>
                                                    :</label>
                                                {{ Form::select('mediation_office', App\Models\MediationOffice::selectToArray(), $lawsuit->mediation_office_id, ['class' => 'form-control selectSearch']) }}

                                                <div class="invalid-feedback">
                                                    Bu alanın doldurulması zorunludur.
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Başvuru Dosya No :</label>
                                                        {{ Form::text('application_document_no', $lawsuit->application_document_no, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Arabuluculuk Dosya No :</label>
                                                        {{ Form::text('mediation_document_no', $lawsuit->mediation_document_no, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Başvuru Tarihi :</label>
                                                        {{ Form::date('application_date', $lawsuit->application_date, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Görevi Kabul Tarihi :</label>
                                                        {{ Form::date('job_date', $lawsuit->job_date, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group" id="process_start_date">
                                                        <label>Sürecin Başlangıç Tarihi :</label>
                                                        {{ Form::date('process_start_date', $lawsuit->process_start_date, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="process_type_id">Süreç Durumu: </label>
                                                        <select class="form-control" id="process_type_id"
                                                            name="process_type_id">
                                                            @foreach ($process_types as $process_type)
                                                                <option value="{{ $process_type->id }}"
                                                                    {{ $process_type->id == $lawsuit->lawsuit_process_type_id ? 'selected' : '' }}>
                                                                    {{ $process_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group" id="result_type"
                                                        style="{{ $lawsuit->lawsuit_process_type_id == 4 || $lawsuit->lawsuit_process_type_id == 5 ? '' : 'display:none;' }}">
                                                        <label>Sonuç Türü: </label>
                                                        <select class="form-control" name="result_type_id">
                                                            <option value="" disabled selected>Seçiniz</option>
                                                            @foreach ($result_types as $result_type)
                                                                <option value="{{ $result_type->id }}"
                                                                    {{ $result_type->id == $lawsuit->lawsuit_result_type_id ? 'selected' : '' }}>
                                                                    {{ $result_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group" id="result_date"
                                                        style="{{ $lawsuit->lawsuit_process_type_id == 4 || $lawsuit->lawsuit_process_type_id == 5 ? '' : 'display:none;' }}">
                                                        <label>Sonuçlandırma Tarihi :</label>
                                                        <input type="text" class="form-control datepicker datedotmask"
                                                            name="result_date"
                                                            value="{{ !is_null($lawsuit->result_date) ? \Carbon\Carbon::parse($lawsuit->result_date)->format('d.m.Y') : '' }}"
                                                            autocomplete="off">
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
    <script src="{{ asset('js/page/lawsuit/lawsuit.js') }}?v={{ time() }}"></script>
    <!-- <script src="{{ asset('js/page/lawsuit/edit-wizard.js') }}?v={{ time() }}"></script> -->
    <script src="{{ asset('js/customWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/dynamicRulesForWizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script>
        $('#cikti_btn').on("click", function() {
            $('#lawsuit_print_content').printThis({
                importCSS: false,
                loadCSS: "/css/print.css"
            });
        });
    </script>
@endsection
