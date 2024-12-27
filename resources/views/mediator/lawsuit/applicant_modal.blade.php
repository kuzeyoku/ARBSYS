<div class="modal" tabindex="-1" role="dialog" id="applicantModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Taraf Bilgileri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="applicant_type">Taraf Sıfatı</label>
                    <select class="form-control" id="applicant_type" name="applicant_type">
                        <option value="0">-- Seçiniz --</option>
                        <option value="1">Başvurucu</option>
                        <option value="2">Diğer Taraf</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gerçek Kişi/Tüzel Kişi</label>
                    <div class="kt-radio-inline">
                        <label class="kt-radio">
                            <input type="radio" data-type="person" name="isPerson" class="personTypeSelect"
                                   data-url="{{route("api.get_person_modal_content")}}">
                            Gerçek Kişi
                            <span></span>
                        </label>
                        <label class="kt-radio">
                            <input type="radio" data-type="company" name="isPerson" class="personTypeSelect"
                                   data-url="{{route("api.get_person_modal_content")}}">
                            Tüzel Kişi
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Vazgeç</button>
            </div>
        </div>
    </div>
</div>
