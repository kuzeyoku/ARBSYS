<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Kişilerimden Seç', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('person', App\Models\Side\People::selectToArray(), 'default', ['class' => 'form-control selectSearch personSelect', 'placeholder' => '--Seçiniz--', 'data-url' => route('api.get_person_data')]) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Adı Soyadı', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Yazınız', 'required' => '']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('T.C. Kimlik No', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('identification', null, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No Yazınız']) }}
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Vergi Dairesi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::select('tax_office_id', App\Models\TaxOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
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
        {{ Form::text('phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız']) }}
        {{ Form::checkbox('check[phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('fixed_phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız']) }}
        {{ Form::checkbox('check[fixed_phone]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('E-posta Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('email', null, ['class' => 'form-control emailmask', 'placeholder' => 'E-posta Adresi Yazınız']) }}
        {{ Form::checkbox('check[email]', true, false) }} Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        {{ Form::label('KEP Adresi', null, ['class' => 'font-weight-bold']) }}
    </div>
    <div class="col-sm-8">
        {{ Form::text('kep_address', null, ['class' => 'form-control kepmask', 'placeholder' => 'KEP Adresi Yazınız']) }}
        {{ Form::checkbox('check[kep_address]', true, false) }} Tutanakta Yazsın
    </div>
</div>
