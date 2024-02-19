<?php if(isset($item)): ?>
    <?php echo e(Form::hidden('id', $item->id, ['id' => 'person_id'])); ?>

    <?php echo e(Form::hidden('old_type', $item->type->id, ['id' => 'old-type'])); ?>

<?php endif; ?>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Tipi', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php if(isset($item)): ?>
            <?php echo e(Form::select('type', App\Models\PersonType::selectToArray(), $item->type->id, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'id' => 'person_type', 'data-url' => route('person.getEditModalContent', $item)])); ?>

        <?php else: ?>
            <?php echo e(Form::select('type', App\Models\PersonType::selectToArray(), $type->id, ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'id' => 'person_type', 'data-url' => route('person.getModalContent')])); ?>

        <?php endif; ?>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Adı Soyadı', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('name', $item->name ?? null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Yazınız', 'required' => ''])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('T.C. Kimlik No', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::text('identification', $item->identification ?? null, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No Yazınız'])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Adres', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::textarea('address', $item->address ?? null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Adres Yazınız'])); ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('GSM Numarası', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::text('phone', $item->phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[phone]', true, isset($item) ? GlobalFunction::checkControl('phone', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Sabit Telefon Numarası', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::text('fixed_phone', $item->fixed_phone ?? null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Yazınız'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[fixed_phone]', true, isset($item) ? GlobalFunction::checkControl('fixed_phone', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('E-posta Adresi', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::text('email', $item->email ?? null, ['class' => 'form-control emailmask', 'placeholder' => 'E-posta Adresi Yazınız'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[email]', true, isset($item) ? GlobalFunction::checkControl('email', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>


    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Kayıtlı Olduğu Baro', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::select('baro', App\Models\Baro::selectToArray(), $item->baro_id ?? 'default', ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[baro]', true, isset($item) ? GlobalFunction::checkControl('baro', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('Baro Sicil No', null, ['class' => 'font-weight-bold'])); ?>

    </div>
    <div class="col-sm-8">
        <?php echo e(Form::text('registration_no', $item->registration_no ?? null, ['class' => 'form-control registrationmask', 'placeholder' => 'Baro Sicil No Yazınız'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[registration_no]', true, isset($item) ? GlobalFunction::checkControl('registration_no', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>

    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">
        <?php echo e(Form::label('KEP Adresi', null, ['class' => 'font-weight-bold'])); ?></div>
    <div class="col-sm-8">
        <?php echo e(Form::text('kep_address', $item->kep_address ?? null, ['class' => 'form-control kepmask', 'placeholder' => 'KEP Adresi Yazınız'])); ?>

        <label class="kt-checkbox">
            <?php echo e(Form::checkbox('check[kep_address]', true, isset($item) ? GlobalFunction::checkControl('kep_address', $item->check) : false)); ?>

            Tutanakta Yazsın
            <span></span>
        </label>

    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/person/modals/person_lawyer.blade.php ENDPATH**/ ?>