<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="lawyerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Vekil Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="lawyerId" value="">
                    <div class="form-group row">
                        <label for="lawyerName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadLawyer">
                            <input class="form-control subside_lrq typeahead" id="lawyerName"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadLawyer">
                            <input class="form-control tc typeahead tcmask" id="lawyerTcNo"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_lrq" rows="3" id="lawyerAddress"
                                placeholder="Açık adres yazınız" autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phone phonemask" id="lawyerPhone" placeholder="Telefon yazınız"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8 d-flex flex-row align-items-center">
                            <input class="form-control fixed_phone phonemask" id="lawyerFixedPhone"
                                placeholder="Sabit Telefon yazınız" autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="lawyerTcNoCheck">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8 d-flex flex-row align-items-center">
                            <input class="form-control email emailmask" id="lawyerEmail"
                                placeholder="E-posta adresini yazınız" autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="lawyerEmailCheck">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="baroName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Kayıtlı Olduğu Baro</label>
                        <div class="input-group col-sm-8 d-flex flex-row" id="baroNameTypeaheadLawyer">
                            <input class="form-control typeahead" id="lawyerBaroName" name="baro_name"
                                placeholder="Baro adı yazınız" autocomplete="off" aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">Barosu</span>
                            <input type="hidden" id="lawyerBaroId" name="baro_id">
                            <input class="form-check-input mt-3" type="checkbox" name="" id="lawyerBaroNameCheck">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="registrationNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Baro Sicil No</label>
                        <div class="col-sm-8 d-flex flex-row align-items-center">
                            <input class="form-control" id="registrationNo" placeholder="Baro Sicil No yazınız"
                                autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="registrationNoCheck">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="saveLawyer">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="otherModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Yetkili Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="otherId" value="">
                    <div class="form-group row">
                        <label for="otherName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadOther">
                            <input class="form-control subside_orq typeahead" id="otherName"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadOther">
                            <input class="form-control tc typeahead tcmask" id="otherTcNo" placeholder="T.C. No yazınız"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_orq" rows="3" id="otherAddress"
                                placeholder="Açık adres yazınız" autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="otherPhone" placeholder="Telefon yazınız"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="otherFixedPhone"
                                placeholder="Sabit Telefon yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="otherEmail" placeholder="E-posta adresini yazınız"
                                autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="saveOther">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="workerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Çalışan Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="workerId" value="">
                    <div class="form-group row">
                        <label for="workerName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadWorker">
                            <input class="form-control subside_wrq typeahead" id="workerName"
                                placeholder="Ad Soyad yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadWorker">
                            <input class="form-control tc typeahead tcmask" id="workerTcNo"
                                placeholder="T.C. No yazınız" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_wrq" rows="3" id="workerAddress"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="workerPhone" placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="workerFixedPhone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="workerEmail"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="saveWorker">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="representativeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Kanuni Temsilci Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="representativeId" value="">
                    <div class="form-group row">
                        <label for="representativeName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadRepresentative">
                            <input class="form-control subside_rrq typeahead" id="representativeName"
                                placeholder="Ad Soyad yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadRepresentative">
                            <input class="form-control tc typeahead tcmask" id="representativeTcNo"
                                placeholder="T.C. No yazınız" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_rrq" rows="3" id="representativeAddress"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativePhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="representativePhone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="representativeFixedPhone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="representativeEmail"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="saveRepresentative">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="expertModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Uzman Kişi Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="expertId" value="">
                    <div class="form-group row">
                        <label for="expertName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadExpert">
                            <input class="form-control subside_erq typeahead" id="expertName"
                                placeholder="Ad Soyad yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadExpert">
                            <input class="form-control tc typeahead tcmask" id="expertTcNo"
                                placeholder="T.C. No yazınız" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_erq" rows="3" id="expertAddress"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="expertPhone" placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="expertFixedPhone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="expertEmail"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="saveExpert">Ekle</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#lawyerFixedPhone").prop( "disabled", true );
    $("#lawyerEmail").prop( "disabled", true );
    $("#lawyerBaroName").prop( "disabled", true );
    $("#registrationNo").prop( "disabled", true );

    $('#lawyerTcNoCheck').change(function() {
        if(this.checked) {
            console.log(this.checked);
            $("#lawyerFixedPhone").prop( "disabled", false );
            // true
        } else {
            console.log(this.checked);
            $("#lawyerFixedPhone").prop( "disabled", true );
        }
    });

    $('#lawyerEmailCheck').change(function() {
        if(this.checked) {
            console.log(this.checked);
            $("#lawyerEmail").prop( "disabled", false );
            // true
        } else {
            console.log(this.checked);
            $("#lawyerEmail").prop( "disabled", true );
        }
    });

    $('#lawyerBaroNameCheck').change(function() {
        if(this.checked) {
            console.log(this.checked);
            $("#lawyerBaroName").prop( "disabled", false );
            // true
        } else {
            console.log(this.checked);
            $("#lawyerBaroName").prop( "disabled", true );
        }
    });

    $('#registrationNoCheck').change(function() {
        if(this.checked) {
            console.log(this.checked);
            $("#registrationNo").prop( "disabled", false );
            // true
        } else {
            console.log(this.checked);
            $("#registrationNo").prop( "disabled", true );
        }
    });
</script><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/partials/add_sub_side.blade.php ENDPATH**/ ?>