@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Dosya Aç']])
        {{ Form::open(['url' => route('lawsuit.confirm_udf'), 'method' => 'POST', 'id' => 'udf_form']) }}
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            UDF ile Dosya Oluşturma
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group">
                        {{ Form::label('Arabuluculuk Bürosu') }}
                        {{ Form::select('mediation_office', App\Models\MediationOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--', 'required' => '']) }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Başvuru Dosya No *', null, ['class' => 'text-primary']) }}
                                {{ Form::text('application_document_no', $values['application_number'] ?? null, ['class' => 'form-control', 'required' => '']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Arabuluculuk Dosya No *', null, ['class' => 'text-primary']) }}
                                {{ Form::text('mediation_document_no', date('Y') . '/', ['class' => 'form-control', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Türü *', null, ['class' => 'text-primary']) }}
                                {{ Form::select('lawsuit_subject_type_id', App\Models\Lawsuit\LawsuitSubjectType::SelectToArray(), 'default', ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'required' => '', 'id' => 'lawsuitSubjectTypes']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Konusu *', null, ['class' => 'text-primary']) }}
                                {{ Form::select('lawsuit_subject_id', [], 'default', ['class' => 'form-control', 'id' => 'lawsuitSubjects', 'required' => '', 'id' => 'lawsuitSubjects']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Başvuru Tarihi *', null, ['class' => 'text-primary']) }}
                                {{ Form::date('application_date', $values['application_date'], ['class' => 'form-control', 'required' => '']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Görevi Kabul Tarihi *', null, ['class' => 'text-primary']) }}
                                {{ Form::date('job_date', null, ['class' => 'form-control', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid pr-0">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Başvurucu
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <input type="hidden" name="claimant_count" value="{{ count($claimants) }}">
                            @foreach ($claimants as $index => $claimant)
                                @php
                                    $claimantType = 0;
                                    if (isset($claimant['TC Kimlik No']) && !empty($claimant['TC Kimlik No'])) {
                                        $claimantType = 2;
                                    } else {
                                        foreach (['BELEDİYESİ', 'KURUMU', 'MÜDÜRLÜĞÜ'] as $key) {
                                            if (str_contains(strtoupper($claimant['Adı Soyadı']), $key)) {
                                                $claimantType = 9;
                                            } else {
                                                $claimantType = 8;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="form-group">
                                    {{ Form::label('Kişi Tipi') }}
                                    {{ Form::select("person_type[claimant][$index]", [2 => 'Gerçek Kişi', 8 => 'Tüzel Kişi - Özel Hukuk', 9 => 'Tüzel Kişi - Kamu Hukuku'], $claimantType, ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                                </div>
                                <div class="form-content">
                                    @if ($claimantType == 2)
                                        <div class="form-group">
                                            {{ Form::label('T.C. Kimlik No') }}
                                            {{ Form::text('claimant_' . $index . '_identification', $claimant['TC Kimlik No'], ['class' => 'form-control tcmask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Adı Soyadı') }}
                                            {{ Form::text('claimant_' . $index . '_name', explode('(', $claimant['Adı Soyadı'])[0], ['class' => 'form-control', 'required']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Adres') }}
                                            {{ Form::textarea('claimant_' . $index . '_address', $claimant['Adres'], ['class' => 'form-control', 'rows' => 3]) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('GSM Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_phone', $claimant['Cep'], ['class' => 'form-control phonemask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Sabit Telefon Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_fixed_phone', $claimant['Tel'] ?? null, ['class' => 'form-control phonemask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('E-Posta Adresi') }}
                                            {{ Form::email('claimant_' . $index . '_email', $claimant['Email'] ?? null, ['class' => 'form-control emailmask']) }}
                                        </div>
                                        {{ Form::hidden('claimant_' . $index . '_side_applicant_type_id', 1) }}
                                        {{ Form::hidden('claimant_' . $index . '_side_type_id', 1) }}
                                        <a href="javascript:;" class="btn btn-sm btn-success addLawyer"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addAuthorized"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addEmployee"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addRepresentative"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni
                                            Temsilci Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addExpert"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi
                                            Ekle</a>
                                    @else
                                        <div class="form-group">
                                            {{ Form::label('Tüzel Kişi - Ünvanı') }}
                                            {{ Form::text('claimant_' . $index . '_name', explode('(', $claimant['Adı Soyadı'])[0], ['class' => 'form-control', 'reuqired' => '']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Vergi Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_tax_number', null, ['class' => 'form-control taxmask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Vergi Dairesi') }}
                                            {{ Form::select('claimant_' . $index . '_tax_office', App\Models\TaxOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Mersis Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_mersis_number', null, ['class' => 'form-control mersismask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Detsis Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_detsis_number', null, ['class' => 'form-control detsismask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Adres') }}
                                            {{ Form::textarea('claimant_' . $index . '_address', $claimant['Adres'], ['class' => 'form-control', 'rows' => 3]) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Sabit Telefon Numarası') }}
                                            {{ Form::text('claimant_' . $index . '_fixed_phone', $claimant['Tel'] ?? null, ['class' => 'form-control phonemask']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('E-Posta Adresi') }}
                                            {{ Form::email('claimant_' . $index . '_email', null, ['class' => 'form-control emailmask']) }}
                                        </div>
                                        {{ Form::hidden('claimant_' . $index . '_side_applicant_type_id', 2) }}
                                        {{ Form::hidden('claimant_' . $index . '_side_type_id', 1) }}
                                        <a href="javascript:;" class="btn btn-sm btn-success addLawyer"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addAuthorized"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addEmployee"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addRepresentative"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni
                                            Temsilci Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addExpert"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi
                                            Ekle</a>
                                    @endif
                                </div>
                                <div style="margin-top: 15px;" id="sub_sides-claimant-{{ $index }}"></div>
                                @if (isset($claimant['Vekili']) && $claimant['Vekili'] != '')
                                    <div class="alert alert-warning mb-3"><span>Vekili</span></div>
                                    <div class="form-group">
                                        {{ Form::label('T.C. Kimlik No') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_tc', null, ['class' => 'form-control tcmask']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Adı Soyadı') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_name', explode('(', $claimant['Vekili'])[0], ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Adres') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_address', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('GSM Numarası') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_phone', explode('(TEL:', $claimant['Vekili'])[1], ['class' => 'form-control phonemask']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Sabit Telefon Numarası') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_fixed_phone', null, ['class' => 'form-control phonemask']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('E-Posta Adresi') }}
                                        {{ Form::text("claimant_{$index}_lawyer_email", $email, ['class' => 'form-control emailmask']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Kayıtlı Olduğu Baro') }}
                                        {{ Form::select('claimant_' . $index . '_lawyer_baro', App\Models\Baro::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Baro Sicil No') }}
                                        {{ Form::text('claimant_' . $index . '_lawyer_registration_no', $sicil_no, ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::hidden('claimant_' . $index . '_lawyer_side_applicant_type_id', 3) }}
                                    {{ Form::hidden('claimant_' . $index . '_lawyer_side_type_id', 1) }}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid pl-0">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Diğer Taraf
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <input type="hidden" name="defendant_count" value="{{ count($defendants) }}">
                            @foreach ($defendants as $index => $defendant)
                                @php
                                    $defendantType = 0;
                                    if (isset($defendant['TC Kimlik No']) && !empty($defendant['TC Kimlik No'])) {
                                        $defendantType = 2;
                                    } else {
                                        foreach (['BELEDİYESİ', 'KURUMU', 'MÜDÜRLÜĞÜ'] as $key) {
                                            if (str_contains(strtoupper($defendant['Adı Soyadı']), $key)) {
                                                $defendantType = 9;
                                            } else {
                                                $defendantType = 8;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="form-group">
                                    {{ Form::label('Taraf Tipi') }}
                                    {{ Form::select("person_type[claimant][$index]", [2 => 'Gerçek Kişi', 8 => 'Tüzel Kişi - Özel Hukuk', 9 => 'Tüzel Kişi - Kamu Hukuku'], $defendantType, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'required' => '']) }}
                                </div>
                                <div class="form-content">
                                    @if (isset($defendant['TC Kimlik No']) && $defendant['TC Kimlik No'] != '')
                                        <div class="form-group">
                                            <label>T.C. Kimlik No :</label>
                                            <input type="text" class="form-control tcmask"
                                                name="defendant_{{ $index }}_tc"
                                                value="{{ $defendant['TC Kimlik No'] ?? '' }}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>Adı Soyadı :</label>
                                            <input type="text" class="form-control"
                                                name="defendant_{{ $index }}_name"
                                                value="{{ isset($defendant['Adı Soyadı']) ? explode('(', $defendant['Adı Soyadı'])[0] : '' }}"
                                                autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Adres :</label>
                                            <textarea class="form-control" name="defendant_{{ $index }}_address" autocomplete="off">{{ $defendant['Adres'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>GSM Numarası :</label>
                                            <input type="text" class="form-control phonemask"
                                                name="defendant_{{ $index }}_phone"
                                                value="{{ $defendant['Cep'] ?? '' }}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>Sabit Telefon Numarası :</label>
                                            <input type="text" class="form-control phonemask"
                                                name="defendant_{{ $index }}_fixed_phone"
                                                value="{{ $defendant['Tel'] ?? '' }}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>E-posta Adresi :</label>
                                            <input type="text" class="form-control emailmask"
                                                name="defendant_{{ $index }}_email" autocomplete="off">
                                        </div>
                                        <input type="hidden"
                                            name="defendant_{{ $index }}_side_applicant_type_id" value="1">
                                        <input type="hidden" name="defendant_{{ $index }}_side_type_id"
                                            value="2">
                                        <a href="javascript:;" class="btn btn-sm btn-success addLawyer"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addAuthorized"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addEmployee"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addRepresentative"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni
                                            Temsilci Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addExpert"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi
                                            Ekle</a>
                                    @else
                                        <div class="form-group">
                                            <label>Tüzel Kişi - Ünvanı Adı :</label>
                                            <input type="text" class="form-control"
                                                name="defendant_{{ $index }}_name"
                                                value="{{ isset($defendant['Adı Soyadı']) || isset($defendant['Kurum Adı']) ? explode('(', $defendant['Adı Soyadı'] ?? $defendant['Kurum Adı'])[0] : '' }}"
                                                autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tax_office">Vergi Dairesi :</label>
                                            {{ Form::select('defendant_' . $index . '_tax_office', App\Models\TaxOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'id' => 'tax_office', 'placeholder' => '--Seçiniz--', 'data-live-search' => 'true']) }}
                                        </div>
                                        @if (isset($defendant['Vergi/Mersis/Detsis No']))
                                            <div class="form-group">
                                                <label>Vergi/Detsis/Mersis Numarası :</label>
                                                <input type="text" class="form-control mersismask"
                                                    name="claimant_{{ $index }}_mersis_desis_vergi_number"
                                                    autocomplete="off"
                                                    value="{{ isset($defendant['Vergi/Mersis/Detsis No']) ? $defendant['Vergi/Mersis/Detsis No'] : null }}" />
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label>Vergi Numarası :</label>
                                                <input type="text" class="form-control taxmask"
                                                    name="defendant_{{ $index }}_tax_number" value=""
                                                    autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>MERSİS Numarası :</label>
                                                <input type="text" class="form-control mersismask"
                                                    name="defendant_{{ $index }}_mersis_number"
                                                    autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>DETSİS Numarası :</label>
                                                <input type="text" class="form-control mersismask"
                                                    name="defendant_{{ $index }}_detsis_number"
                                                    autocomplete="off">
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label>Adres :</label>
                                            <textarea class="form-control" name="defendant_{{ $index }}_address" autocomplete="off">{{ isset($defendant['Adres']) || isset($defendant['Adres ve Cep(Zorunlu)']) ? $defendant['Adres'] ?? $defendant['Adres ve Cep(Zorunlu)'] : '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Sabit Telefon Numarası :</label>
                                            <input type="text" class="form-control phonemask"
                                                name="defendant_{{ $index }}_fixed_phone"
                                                value="{{ $defendant['Tel'] ?? '' }}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>E-posta Adresi :</label>
                                            <input type="text" class="form-control emailmask"
                                                name="defendant_{{ $index }}_email" autocomplete="off">
                                        </div>
                                        <input type="hidden"
                                            name="defendant_{{ $index }}_side_applicant_type_id" value="2">
                                        <input type="hidden" name="defendant_{{ $index }}_side_type_id"
                                            value="2">
                                        <a href="javascript:;" class="btn btn-sm btn-success addLawyer"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addAuthorized"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addEmployee"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan
                                            Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addRepresentative"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni
                                            Temsilci Ekle</a>
                                        <a href="javascript:;" class="btn btn-sm btn-success addExpert"
                                            data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2"
                                            data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi
                                            Ekle</a>
                                    @endif
                                </div>
                                <div style="margin-top: 15px;" id="sub_sides-defendant-{{ $index }}">
                                </div>
                                @if (isset($defendant['Vekili']) && $defendant['Vekili'] != '')
                                    <hr>
                                    <h4>Vekili</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label>T.C. Kimlik No :</label>
                                        <input type="text" class="form-control tcmask"
                                            name="defendant_{{ $index }}_lawyer_tc" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Adı Soyadı :</label>
                                        <input type="text" class="form-control"
                                            name="defendant_{{ $index }}_lawyer_name"
                                            value="{{ isset($defendant['Vekili']) ? $defendant['Vekili'] : '' }}"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Adres :</label>
                                        <textarea class="form-control" name="defendant_{{ $index }}_lawyer_address" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>GSM Numarası :</label>
                                        <input type="text" class="form-control phonemask"
                                            name="defendant_{{ $index }}_lawyer_phone"
                                            value="{{ $defendant['Vekil Cep'] ?? '' }}" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Sabit Telefon Numarası :</label>
                                        <input type="text" class="form-control phonemask"
                                            name="defendant_{{ $index }}_lawyer_fixed_phone"
                                            value="{{ $defendant['Vekil Tel'] ?? '' }}" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>E-posta Adresi :</label>
                                        <input type="text" class="form-control emailmask"
                                            name="defendant_{{ $index }}_lawyer_email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Kayıtlı Olduğu Baro :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                name="defendant_{{ $index }}_lawyer_baro" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Barosu</span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Bu alanın doldurulması zorunludur.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Baro Sicil No :</label>
                                        <input type="text" class="form-control"
                                            name="defendant_{{ $index }}_lawyer_registration_no"
                                            autocomplete="off">
                                    </div>
                                    <input type="hidden"
                                        name="defendant_{{ $index }}_lawyer_side_applicant_type_id"
                                        value="3">
                                    <input type="hidden" name="defendant_{{ $index }}_lawyer_side_type_id"
                                        value="2">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container kt-container--fluid kt-grid__item kt-grip__item--fluid">
            {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="next_level_udf">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Sürece Devam Etmek istiyor musunuz?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Davet Mektubu hazırlamak istiyor musunuz?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary" id="lawsuits">Dosya Listesi</a>
                    <a href="" class="btn btn-success" id="next_button_udf">Evet</a>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            function getSelectValue() {
                $('#user-selected').change(function() {
                    $(".select-value").html($('#user-selected').val() + " valuesi");
                    var value = $('#user-selected').val();

                    if (value == "Gercek") {
                        $(".basvurucu .form-content").remove();
                        $(".basvurucu").append(
                            `<div class='form-content'><div class="form-group">
                                                        <label>T.C. Kimlik No :</label>
                                                        <input type="text" class="form-control tcmask" name="claimant_{{ $index }}_tc" value="{{ $claimant['TC Kimlik No'] ?? '' }}" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adı Soyadı :</label>
                                                        <input type="text" class="form-control" name="claimant_{{ $index }}_name" value="{{ isset($claimant['Adı Soyadı']) ? explode('(', $claimant['Adı Soyadı'])[0] : '' }}" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adres :</label>
                                                        <textarea class="form-control" name="claimant_{{ $index }}_address" autocomplete="off">{{ $claimant['Adres'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>GSM Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="claimant_{{ $index }}_phone" value="{{ isset($claimant['Cep']) || isset($claimant['Cep Telefonu(Zorunlu)']) ? $claimant['Cep'] ?? $claimant['Cep Telefonu(Zorunlu)'] : '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sabit Telefon Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="claimant_{{ $index }}_fixed_phone" value="{{ $claimant['Tel'] ?? '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-posta Adresi :</label>
                                                        <input type="text" class="form-control emailmask" name="claimant_{{ $index }}_email" autocomplete="off" >
                                                    </div>
                                                    <input type="hidden" name="claimant_{{ $index }}_side_applicant_type_id" value="1">
                                                    <input type="hidden" name="claimant_{{ $index }}_side_type_id" value="1">
                                                    <a href="javascript:;" class="btn btn-sm btn-success addLawyer" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addAuthorized" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addEmployee" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addRepresentative" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni Temsilci Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addExpert" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi Ekle</a></div>`
                        );
                    } else {
                        $(".basvurucu .form-content").remove();
                        $(".basvurucu").append(
                            `<div class='form-content'><div class="form-group">
                                                        <label>Tüzel Kişi - Ünvanı Adı :</label>
                                                        <input type="text" class="form-control" name="defendant_{{ $index }}_name" value="{{ isset($defendant['Adı Soyadı']) || isset($defendant['Kurum Adı']) ? explode('(', $defendant['Adı Soyadı'] ?? $defendant['Kurum Adı'])[0] : '' }}" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Vergi Numarası :</label>
                                                        <input type="text" class="form-control taxmask" name="claimant_{{ $index }}_tax_number" value="" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Vergi Dairesi :</label>
                                                        <input type="text" class="form-control" name="claimant_{{ $index }}_tax_office" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>MERSİS Numarası :</label>
                                                        <input type="text" class="form-control mersismask" name="claimant_{{ $index }}_mersis_number" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>DETSİS Numarası :</label>
                                                        <input type="text" class="form-control mersismask" name="claimant_{{ $index }}_detsis_number" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adres :</label>
                                                        <textarea class="form-control" name="claimant_{{ $index }}_address" autocomplete="off">{{ $claimant['Adres'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sabit Telefon Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="claimant_{{ $index }}_fixed_phone" value="{{ $claimant['Tel'] ?? '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-posta Adresi :</label>
                                                        <input type="text" class="form-control emailmask" name="claimant_{{ $index }}_email" autocomplete="off" >
                                                    </div>
                                                    <input type="hidden" name="claimant_{{ $index }}_side_applicant_type_id" value="2">
                                                    <input type="hidden" name="claimant_{{ $index }}_side_type_id" value="1">
                                                    <a href="javascript:;" class="btn btn-sm btn-success addLawyer" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addAuthorized" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addEmployee" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addRepresentative" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni Temsilci Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addExpert" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="1" data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi Ekle</a></div>`
                        );
                    }
                });
            }

            function karsiSelectValue() {
                $("#karsi-custom-select").change(function() {
                    var value = $('#karsi-custom-select').val();

                    if (value == "Gercek") {
                        $('.karsitaraf .form-content').remove();
                        $('.karsitaraf').append(
                            `<div class='form-content'><div class="form-group">
                                                        <label>T.C. Kimlik No :</label>
                                                        <input type="text" class="form-control tcmask" name="defendant_{{ $index }}_tc" value="{{ $defendant['TC Kimlik No'] ?? '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adı Soyadı :</label>
                                                        <input type="text" class="form-control" name="defendant_{{ $index }}_name" value="{{ isset($defendant['Adı Soyadı']) ? explode('(', $defendant['Adı Soyadı'])[0] : '' }}" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adres :</label>
                                                        <textarea class="form-control" name="defendant_{{ $index }}_address" autocomplete="off">{{ $defendant['Adres'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>GSM Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="defendant_{{ $index }}_phone" value="{{ $defendant['Cep'] ?? '' }}" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sabit Telefon Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="defendant_{{ $index }}_fixed_phone" value="{{ $defendant['Tel'] ?? '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-posta Adresi :</label>
                                                        <input type="text" class="form-control emailmask" name="defendant_{{ $index }}_email" autocomplete="off" >
                                                    </div>
                                                    <input type="hidden" name="defendant_{{ $index }}_side_applicant_type_id" value="1">
                                                    <input type="hidden" name="defendant_{{ $index }}_side_type_id" value="2">
                                                    <a href="javascript:;" class="btn btn-sm btn-success addLawyer" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addAuthorized" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addEmployee" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addRepresentative" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni Temsilci Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addExpert" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi Ekle</a></div>`
                        );
                    } else {
                        $('.karsitaraf .form-content').remove();
                        $('.karsitaraf').append(
                            `<div class='form-content'><div class="form-group">
                                                        <label>Tüzel Kişi - Ünvanı Adı :</label>
                                                        <input type="text" class="form-control" name="defendant_{{ $index }}_name" value="{{ isset($defendant['Adı Soyadı']) || isset($defendant['Kurum Adı']) ? explode('(', $defendant['Adı Soyadı'] ?? $defendant['Kurum Adı'])[0] : '' }}" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Vergi Numarası :</label>
                                                        <input type="text" class="form-control taxmask" name="defendant_{{ $index }}_tax_number" value="" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Vergi Dairesi :</label>
                                                        <input type="text" class="form-control" name="defendant_{{ $index }}_tax_office" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>MERSİS Numarası :</label>
                                                        <input type="text" class="form-control mersismask" name="defendant_{{ $index }}_mersis_number" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>DETSİS Numarası :</label>
                                                        <input type="text" class="form-control mersismask" name="defendant_{{ $index }}_detsis_number" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adres :</label>
                                                        <textarea class="form-control" name="defendant_{{ $index }}_address" autocomplete="off">{{ $defendant['Adres'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sabit Telefon Numarası :</label>
                                                        <input type="text" class="form-control phonemask" name="defendant_{{ $index }}_fixed_phone" value="{{ $defendant['Tel'] ?? '' }}" autocomplete="off" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-posta Adresi :</label>
                                                        <input type="text" class="form-control emailmask" name="defendant_{{ $index }}_email" autocomplete="off">
                                                    </div>
                                                    <input type="hidden" name="defendant_{{ $index }}_side_applicant_type_id" value="2">
                                                    <input type="hidden" name="defendant_{{ $index }}_side_type_id" value="2">
                                                    <a href="javascript:;" class="btn btn-sm btn-success addLawyer" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::LAWYER }}">Vekil Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addAuthorized" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::AUTHORIZED }}">Yetkili Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addEmployee" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::EMPLOYEE }}">Çalışan Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addRepresentative" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::REPRESENTATIVE }}">Kanuni Temsilci Ekle</a>
                                                    <a href="javascript:;" class="btn btn-sm btn-success addExpert" data-sideid="{{ $index }}" data-udf="1" data-sidetypeid="2" data-applicanttypeid="{{ ApplicantTypeOptions::EXPERT }}">Uzman Kişi Ekle</a></div>`
                        );
                    }
                })
            }
        </script>
        <script src="{{ asset('js/addSubSide.js') }}?v={{ time() }}"></script>
        <script>
            $("#save").on('click', function() {
                var btn = $(this);
                var form = $("#udf_form");

                var validator = form.validate({
                    lang: "tr",
                    focusInvalid: false,
                    invalidHandler: function(form, validator) {

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: ($(validator.errorList[0].element).offset().top - 300)
                        }, 2000);

                    }
                    // Specify validation rules
                });

                if (validator.form() === true) {
                    KTApp.progress(btn);

                    form.ajaxSubmit({
                        data: {
                            sides: sides
                        },
                        success: function(data) {
                            $("#next_button").show();
                            KTApp.unprogress(btn);
                            btn.hide();

                            $("#next_button_udf").attr('href', '/dosya/' + data.id + '/davet-mektubu');
                            $("#lawsuits").attr('href', '/dosyalar');

                            $("#next_level_udf").modal("show");
                        },
                        error: function(err) {
                            var data = JSON.parse(err.responseText);
                            if (data.errors && data.errors.mediation_document_no && data.errors
                                .mediation_document_no[0]) {
                                $('.custom-arabuluculuk-no').css('border-color', 'red');
                                swal.fire(
                                    'Hata!',
                                    data.errors.mediation_document_no[0],
                                    'error'
                                );
                            } else if (data.errors && data.errors.job_date && data.errors.job_date[0]) {
                                swal.fire(
                                    'Hata!',
                                    data.errors.job_date[0],
                                    'error'
                                );
                            }


                        }
                    });
                }
            });
            $(".custom-arabuluculuk-no").focus(function() {
                $(this).css("border", "1px solid #e2e5ec");
            });
        </script>
        <script>
            // $(document).ready(function() {
            //     if ($('#lawsuit_subject_types option:selected').text() !== "Seçin") {
            //         $("#lawsuit_subjects_select").show();
            //         $.ajax({
            //             url: '/lawsuit_subjects/' + $('#lawsuit_subject_types').val(),
            //             type: 'GET',
            //             data: '',
            //             success: function(data) {
            //                 $("#lawsuit_subjects").html('');
            //                 $("#lawsuit_subjects").append(
            //                     '<option value="" disabled selected>Seçin</option>');
            //                 $.each(data, function(index, value) {
            //                     $("#lawsuit_subjects").append('<option value="' + value.id + '">' +
            //                         value.name + '</option>');
            //                 });
            //             }
            //         });
            //     }
            // });
            // $('#lawsuit_subject_types').on('change', function() {
            //     if (parseInt($(this).val()) > 0) {
            //         $("#lawsuit_subjects_select").show();
            //         $.ajax({
            //             url: '/lawsuit_subjects/' + $(this).val(),
            //             type: 'GET',
            //             data: '',
            //             success: function(data) {
            //                 $("#lawsuit_subjects").html('');
            //                 $("#lawsuit_subjects").append(
            //                     '<option value="" disabled selected>Seçin</option>');
            //                 $.each(data, function(index, value) {
            //                     $("#lawsuit_subjects").append('<option value="' + value.id + '">' +
            //                         value.name + '</option>');
            //                 });
            //             }
            //         });
            //     } else {
            //         $("#lawsuit_subjects").html('');
            //         $("#lawsuit_subjects").hide();
            //     }
            // });

            $("#lawsuitSubjectTypes").on("change", function() {
                var value = $(this).val();
                if (value > 0) {
                    $.ajax({
                        url: '/lawsuit_subjects/' + value,
                        type: 'GET',
                        data: '',
                        success: function(data) {
                            $("#lawsuitSubjects").html('');
                            $("#lawsuitSubjects").append(
                                '<option value="" disabled selected>--Seçiniz--</option>');
                            $.each(data, function(index, value) {
                                $("#lawsuitSubjects").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                }
            });
        </script>
    @endsection
