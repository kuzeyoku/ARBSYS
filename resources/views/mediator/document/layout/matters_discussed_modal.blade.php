<div class="modal" tabindex="-1" role="dialog" id="matters-discussed-modal" aria-hidden="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Müzakere Edilen Hususlar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @foreach ($lawsuit->lawsuit_subject->matters_discussed_to_array as $key => $value)
                            <div class="col-lg-4">
                                <div class="kt-checkbox-list">
                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                        {{ Form::checkbox('matters_discussed[]', $key,  in_array($key, $lawsuit->matters_discussed_to_array)) }}
                                        {{ $value }}<span></span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label("Müzakere Edilen Hususlar")}}
                    {{Form::textarea("", $lawsuit->matters_discussed_to_string, ["class" => "form-control", "id" => "matters-discussed-textarea", "rows" => 5])}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="matters-discussed-save">Tamam</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
            </div>
        </div>
    </div>
</div>
