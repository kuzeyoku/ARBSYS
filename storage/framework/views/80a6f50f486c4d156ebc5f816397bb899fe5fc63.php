<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="personModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Gerçek Kişi Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="personForm">
                    <input type="hidden" id="reelSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="1">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="reelId" value="">
                    <div class="form-group row">
                        <label for="reelTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadReel">
                            <input class="form-control tc typeahead tcmask" id="reelTcNo" name="tc"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reelName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadReel">
                            <input class="form-control typeahead" id="reelName" name="name"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reelAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="reelAddress" name="address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reelPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phone phonemask" id="reelPhone" name="phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reelFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control fixed_phone phonemask" id="reelFixedPhone" name="fixed_phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reelEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control email emailmask" id="reelEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="companyModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Tüzel Kişi - Ünvanı Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="companyForm">
                    <input type="hidden" id="companySideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="2">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="companyId" value="">
                    <div class="form-group row">
                        <label for="companyName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Tüzel Kişi - Adı Syadı </label>
                        <div class="col-sm-8">
                            <input class="form-control" id="companyName" name="name"
                                placeholder="Tüzel Kişi - Adı Syadı Yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyTaxNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Vergi Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control taxmask" id="companyTaxNo" name="tax_number"
                                placeholder="Vergi No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Vergi Dairesi</label>
                        <div class="col-sm-8" id="companyTax">
                            <input class="form-control rq typeahead" id="tax_office" name="tax_office"
                                placeholder="Vergi Dairesi yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyMersis" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">MERSİS Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control mersismask" id="companyMersis" name="mersis"
                                placeholder="Mersis No yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyDetsis" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">DETSİS Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="companyDetsis" name="detsis"
                                placeholder="Detsis No yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="companyAddress" name="address"
                                placeholder="Açık adres yazınız"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="companyFixedPhone" name="fixed_phone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="companyEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="lawyerModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Vekil Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="lawyerForm">
                    <input type="hidden" id="lawyerSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="3">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="lawyerId" value="">
                    <div class="form-group row">
                        <label for="lawyerName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadLawyer">
                            <input class="form-control subside_lrq typeahead" name="name" id="lawyerName"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadLawyer">
                            <input class="form-control tc typeahead tcmask" name="tc" id="lawyerTcNo"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control subside_lrq" rows="3" name="address" id="lawyerAddress"
                                placeholder="Açık adres yazınız" autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phone phonemask" name="phone" id="lawyerPhone"
                                placeholder="Telefon yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8 d-flex flex-row align-items-center">
                            <input class="form-control fixed_phone phonemask" name="fixed_phone" id="lawyerFixedPhone"
                                placeholder="Sabit Telefon yazınız" autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="lawyerTcNoCheck">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lawyerEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8 d-flex flex-row align-items-center">
                            <input class="form-control email emailmask" name="email" id="lawyerEmail"
                                placeholder="E-posta adresini yazınız" autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="lawyerEmailCheck">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="baroName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Kayıtlı Olduğu Baro</label>
                        <div class="input-group col-sm-8 d-flex flex-row" id="baroNameTypeaheadLawyer">
                            <input class="form-control typeahead" name="baro_id" id="lawyerBaroName" name="baro_name"
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
                            <input class="form-control" name="registration_no" id="registrationNo"
                                placeholder="Baro Sicil No yazınız" autocomplete="off">
                            <input class="form-check-input" type="checkbox" name="" id="registrationNoCheck">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="otherModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Yetkili Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="otherForm">
                    <input type="hidden" id="otherSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="4">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="otherId" value="">
                    <div class="form-group row">
                        <label for="otherName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadOther">
                            <input class="form-control typeahead" id="otherName" name="name"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadOther">
                            <input class="form-control tc typeahead tcmask" id="otherTcNo" name="tc"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="otherAddress" name="address"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="otherPhone" name="phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="otherFixedPhone" name="fixed_phone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="otherEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="otherEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="workerModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Çalışan Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="workerForm">
                    <input type="hidden" id="workerSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="5">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="workerId" value="">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadWorker">
                            <input class="form-control typeahead" id="workerName" name="name"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadWorker">
                            <input class="form-control tc typeahead tcmask" id="workerTcNo" name="tc"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="workerAddress" name="address"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="workerPhone" name="phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="workerFixedPhone" name="fixed_phone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workerEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="workerEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="representativeModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Kanuni Temsilci Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="representativeForm">
                    <input type="hidden" id="representativeSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="6">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="representativeId" value="">
                    <div class="form-group row">
                        <label for="representativeName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadRepresentative">
                            <input class="form-control typeahead" id="representativeName" name="name"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadRepresentative">
                            <input class="form-control tc typeahead tcmask" id="representativeTcNo" name="tc"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="representativeAddress" name="address"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativePhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="representativePhone" name="phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="representativeFixedPhone" name="fixed_phone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representativeEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="representativeEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="expertModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Uzman Kişi Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="expertForm">
                    <input type="hidden" id="expertSideId" name="side_id" value="">
                    <input type="hidden" name="side_applicant_type_id" value="7">
                    <input type="hidden" name="lawsuit_id" value="">
                    <input type="hidden" name="id" id="expertId" value="">
                    <div class="form-group row">
                        <label for="expertName" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adı Soyadı</label>
                        <div class="col-sm-8" id="nameTypeaheadExpert">
                            <input class="form-control typeahead" id="expertName" name="name"
                                placeholder="Ad Soyad yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertTcNo" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">T.C. Kimlik No</label>
                        <div class="col-sm-8" id="tcNoTypeaheadExpert">
                            <input class="form-control tc typeahead tcmask" id="expertTcNo" name="tc"
                                placeholder="T.C. No yazınız" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertAddress" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Adres</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" id="expertAddress" name="address"
                                placeholder="Açık adres yazınız"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">GSM Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="expertPhone" name="phone"
                                placeholder="Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">Sabit Telefon Numarası</label>
                        <div class="col-sm-8">
                            <input class="form-control phonemask" id="expertFixedPhone" name="fixed_phone"
                                placeholder="Sabit Telefon yazınız">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expertEmail" class="col-sm-4 col-form-label font-weight-bold"
                            style="color:#2C3E50;">E-posta Adresi</label>
                        <div class="col-sm-8">
                            <input class="form-control emailmask" id="expertEmail" name="email"
                                placeholder="E-posta adresini yazınız">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                <button type="button" class="btn save-side-btn" style="background: #149FFC; color: white;">Ekle</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
    id="editModalSideManagement">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-pills mb-3" id="taraf-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="taraf-gercek-tab" data-toggle="pill" href="#taraf-gercek" role="tab"
                            aria-controls="taraf-gercek" aria-selected="true">Gerçek Kişi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="taraf-tuzel-tab" data-toggle="pill" href="#taraf-tuzel" role="tab"
                            aria-controls="taraf-tuzel" aria-selected="false">Tüzel Kişi - Ünvanı</a>
                    </li>
                    
                    
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="taraf-tabContent">
                    <div class="tab-pane fade" id="taraf-gercek" role="tabpanel" aria-labelledby="taraf-gercek-tab">
                        <form method="POST" action="" id="personEditForm">
                            <input type="hidden" id="sideApplicantOldType" name="side_applicant_old_type" value="">
                            <input type="hidden" id="reelSideId" name="side_id" value="">
                            <input type="hidden" name="side_applicant_type_id" value="1">
                            <input type="hidden" name="lawsuit_id" value="">
                            <input type="hidden" name="id" id="reelId" value="">
                            <div class="form-group row">
                                <label for="reelTcNo" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">T.C. Kimlik No</label>
                                <div class="col-sm-8" id="tcNoTypeaheadReel">
                                    <input class="form-control tc typeahead tcmask" id="reelTcNo" name="tc"
                                        placeholder="T.C. No yazınız" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reelName" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Adı Soyadı</label>
                                <div class="col-sm-8">
                                    <input class="form-control typeahead" id="reelName" name="name"
                                        placeholder="Ad Soyad yazınız" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reelAddress" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Adres</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" id="reelAddress" name="address"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reelPhone" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">GSM Numarası</label>
                                <div class="col-sm-8">
                                    <input class="form-control phone phonemask" id="reelPhone" name="phone"
                                        placeholder="Telefon yazınız">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reelFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Sabit Telefon Numarası</label>
                                <div class="col-sm-8">
                                    <input class="form-control fixed_phone phonemask" id="reelFixedPhone"
                                        name="fixed_phone" placeholder="Telefon yazınız">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reelEmail" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">E-posta Adresi</label>
                                <div class="col-sm-8">
                                    <input class="form-control email emailmask" id="reelEmail" name="email"
                                        placeholder="E-posta adresini yazınız">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn save-side-btn"
                                style="background: #149FFC; color: white;">Gerçek Kişi Güncelle</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="taraf-tuzel" role="tabpanel" aria-labelledby="taraf-tuzel-tab">
                        <form method="POST" action="" id="companyEditForm">
                            <input type="hidden" id="sideApplicantOldType" name="side_applicant_old_type_id" value="">
                            <input type="hidden" id="companySideId" name="side_id" value="">
                            <input type="hidden" name="side_applicant_type_id" value="2">
                            <input type="hidden" name="lawsuit_id" value="">
                            <input type="hidden" name="id" id="companyId" value="">
                            <div class="form-group row">
                                <label for="companyName" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Tüzel Kişi - Adı Soyadı </label>
                                <div class="col-sm-8" id="nameTypeaheadCompany">
                                    <input class="form-control typeahead" id="companyName" name="name"
                                        placeholder="Tüzel Kişi - Adı Soyadı Yazınız" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyTaxNo" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Vergi Numarası</label>
                                <div class="col-sm-8" id="taxNoTypeaheadCompany">
                                    <input class="form-control typeahead taxmask" id="companyTaxNo" name="tax_number"
                                        placeholder="Vergi No yazınız" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Vergi Dairesi</label>
                                <div class="col-sm-8" id="companyTax">
                                    <input class="form-control rq typeahead" id="tax_office" name="tax_office"
                                        placeholder="Vergi Dairesi yazınız" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyMersis" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">MERSİS Numarası</label>
                                <div class="col-sm-8">
                                    <input class="form-control mersismask" id="companyMersis" name="mersis"
                                        placeholder="Mersis No yazınız">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyDetsis" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">DETSİS Numarası</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="companyDetsis" name="detsis"
                                        placeholder="Detsis No yazınız">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyAddress" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Adres</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" id="companyAddress" name="address"
                                        placeholder="Açık adres yazınız"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyFixedPhone" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">Sabit Telefon Numarası</label>
                                <div class="col-sm-8">
                                    <input class="form-control phonemask" id="companyFixedPhone" name="fixed_phone"
                                        placeholder="Sabit Telefon yazınız">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="companyEmail" class="col-sm-4 col-form-label font-weight-bold"
                                    style="color:#2C3E50;">E-posta Adresi</label>
                                <div class="col-sm-8">
                                    <input class="form-control emailmask" id="companyEmail" name="email"
                                        placeholder="E-posta adresini yazınız">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn save-side-btn"
                                style="background: #149FFC; color: white;">Tüzel Kişi Güncelle</button>
                        </div>
                    </div>
                    
                    
                </div>
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
</script><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/partials/side_modals.blade.php ENDPATH**/ ?>