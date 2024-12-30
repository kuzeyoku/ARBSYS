@if (isset($item))
    {{ Form::hidden('id', $item->id, ['id' => 'person_id']) }}
    {{ Form::hidden('person_type_id', $item->personType->id) }}
@else
    {{ Form::hidden('person_type_id', $personType->id) }}
@endif
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Tipi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        @if (isset($item))
            {{ Form::select('type', App\Models\PersonType::selectToArray(), $item->personType->key, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', "disabled"]) }}
        @else
            {{ Form::select('type', App\Models\PersonType::selectToArray(), $personType->key, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'data-url' => route('api.get_person_modal_content')]) }}
        @endif
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Adı Soyadı', null, ['class' => 'font-weight-bold']) }} <span class="text-danger">*</span>
    </div>
    <div class="col-sm-8">
        {{ Form::text('name', $item->name ?? null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Yazınız', 'required' => '']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('T.C. Kimlik No', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('identification', $item->identification ?? null, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Dairesi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('tax_office_id', App\Models\TaxOffice::selectToArray(), $item->tax_office_id ?? 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
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
        {{ Form::text('phone', $item->phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız']) }}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[phone]', true, isset($item) ? GlobalFunction::checkControl('phone', $item->check) : null) }}
            Tutanakta
            Yazsın
            <span></span>
        </label>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('fixed_phone', $item->fixed_phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız']) }}
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
        {!! Form::text('email', $item->email ?? null, [
            'class' => 'form-control emailmask',
            'placeholder' => 'E-posta Adresi Yazınız',
        ]) !!}
        <label class="kt-checkbox">
            {{ Form::checkbox('check[email]', true, isset($item) ? GlobalFunction::checkControl('email', $item->check) : null) }}
            Tutanakta
            Yazsın
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
