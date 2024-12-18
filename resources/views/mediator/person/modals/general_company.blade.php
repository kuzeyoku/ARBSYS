<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Kişilerimden Seç', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('company', $companies, 'default', ['class' => 'form-control selectSearch companySelect', 'placeholder' => '--Seçiniz--', 'data-url' => route('api.get_company_data')]) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Ünvanı', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tüzel Kişi - Ünvanı Yazınız', 'required' => '']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Mersis Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('mersis_number', null, ['class' => 'form-control mersismask', 'placeholder' => 'Mersis No Yazınız']) }}
        {{ Form::checkbox('check[mersis]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Detsis Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('detsis_number', null, ['class' => 'form-control detsismask', 'placeholder' => 'Detsis No Yazınız']) }}
        {{ Form::checkbox('check[detsis]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Dairesi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('tax_office', App\Models\TaxOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('tax_number', null, ['class' => 'form-control taxmask', 'placeholder' => 'Vergi No Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Adres', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Adres Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('GSM Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'GSM Numarası Yazınız']) }}
        {{ Form::checkbox('check[phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('fixed_phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Sabit Telefon Numarası Yazınız']) }}
        {{ Form::checkbox('check[phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('E-posta Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('email', null, ['class' => 'form-control emailmask', 'placeholder' => 'E-posta Adresi Yazınız']) }}
        {{ Form::checkbox('check[phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('KEP Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('kep_address', null, ['class' => 'form-control kepmask', 'placeholder' => 'KEP Adresi Yazınız']) }}
        {{ Form::checkbox('check[phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
