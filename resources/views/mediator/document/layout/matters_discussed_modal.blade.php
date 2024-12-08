<div class="modal" tabindex="-1" role="dialog" id="matters-discussed-modal" style="z-index:1061;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Müzakere Edilen Hususlar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @foreach (json_decode($lawsuit->lawsuit_subject->matters_discussed, true) ?? [] as $key => $value)
                            <div class="col-lg-4">
                                <div class="kt-checkbox-list">
                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                        <input type="checkbox" name="matters_discussed[]" value="{{ $key }}">
                                        {{ $value }}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="matters_discussed">Müzakere Edilen Hususlar</label>
                    <textarea name="matters_discussed" id="matters-discussed-textarea" class="form-control" rows="5">{{ $lawsuit->matters_discussed }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="matters-discussed-save">Tamam</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
            </div>
        </div>
    </div>
</div>
