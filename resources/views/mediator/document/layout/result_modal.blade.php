<div class="modal" tabindex="-1" role="dialog" id="result-modal", style="z-index:1061;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Toplantı Sonucu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::textarea('result', null, ['class' => 'form-control', 'placeholder' => 'Toplantı Sonucunu Yazınız', 'rows' => 5]) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="result_save()"
                    data-dismiss="modal">Tamam</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
            </div>
        </div>
    </div>
</div>