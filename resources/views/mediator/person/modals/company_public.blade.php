@if (isset($item))
    {{ Form::hidden('id', $item->id, ['id' => 'person_id']) }}
@endif
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Tipi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        @if (isset($item))
            {{ Form::select("person_type_id", App\Models\PersonType::selectToArray(), $item->personType->id, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', "disabled"]) }}
        @else
            {{ Form::select("person_type_id", App\Models\PersonType::selectToArray(), $personType->id, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'data-url' => route('api.get_person_modal_content')]) }}
        @endif
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Ünvanı', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('name', $item->name ?? null, ['class' => 'form-control', 'placeholder' => 'Tüzel Kişi - Ünvanı Yazınız', 'required' => '']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Detsis Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('detsis_number', $item->detsis_number ?? null, ['class' => 'form-control detsismask', 'placeholder' => 'Detsis No Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[detsis]', true, isset($item) ? GlobalFunction::checkControl('detsis', $item->check) : null) }}
            Tutanakta Yazsın
            <span></span>
        </label>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Dairesi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('tax_office_id', App\Models\TaxOffice::selectToArray(), $item->tax_office_id ?? 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--', 'data-live-search' => 'true']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('tax_number', $item->tax_number ?? null, ['class' => 'form-control taxmask', 'placeholder' => 'Vergi No Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Adres', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::textarea('address', $item->address ?? null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Adres Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('GSM Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('phone', $item->phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'GSM Numarası Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[phone]', true, isset($item) ? GlobalFunction::checkControl('phone', $item->check) : null) }}
            Tutanakta Yazsın
            <span></span>
        </label>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('fixed_phone', $item->fixed_phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'Sabit Telefon Numarası Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[fixed_phone]', true, isset($item) ? GlobalFunction::checkControl('fixed_phone', $item->check) : null) }}
            Tutanakta Yazsın
            <span></span>
        </label>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('E-posta Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('email', $item->email ?? null, ['class' => 'form-control emailmask', 'placeholder' => 'E-posta Adresi Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[email]', true, isset($item) ? GlobalFunction::checkControl('email', $item->check) : null) }}
            Tutanakta Yazsın
            <span></span>
        </label>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('KEP Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('kep_address', $item->kep_address ?? null, ['class' => 'form-control kepmask', 'placeholder' => 'KEP Adresi Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[kep_address]', true, isset($item) ? GlobalFunction::checkControl('kep_address', $item->check) : null) }}
            Tutanakta Yazsın
            <span></span>
        </label>
    </div>
</div>
