<?php echo e(Form::hidden('type', 2)); ?>

<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Kişilerimden Seç', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::select('person', App\Models\Side\People::selectToArray(), 'default', ['class' => 'form-control selectSearch personSelect', 'placeholder' => '--Seçiniz--', 'data-url' => route('api.get_person_data')])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Adı Soyadı', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Yazınız', 'required' => ''])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('T.C. Kimlik No', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('identification', null, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No Yazınız'])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Vergi Dairesi', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::select('tax_office', App\Models\TaxOffice::selectToArray(), 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Adres', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::textarea('address', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Adres Yazınız'])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('GSM Numarası', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız'])); ?>

        <?php echo e(Form::checkbox('check[phone]', true, false)); ?> Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('fixed_phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız'])); ?>

        <?php echo e(Form::checkbox('check[fixed_phone]', true, false)); ?> Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('E-posta Adresi', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('email', null, ['class' => 'form-control emailmask', 'placeholder' => 'E-posta Adresi Yazınız'])); ?>

        <?php echo e(Form::checkbox('check[email]', true, false)); ?> Tutanakta Yazsın
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('KEP Adresi', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('kep_address', null, ['class' => 'form-control kepmask', 'placeholder' => 'KEP Adresi Yazınız'])); ?>

        <?php echo e(Form::checkbox('check[kep_address]', true, false)); ?> Tutanakta Yazsın
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/person/modals/general_person.blade.php ENDPATH**/ ?>