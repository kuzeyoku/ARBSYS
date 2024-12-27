<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sürece Nasıl Devam Etmek İstersiniz ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Dosya Kaydedildi Davet mektubu oluşturulabilir veya Tutanak Düzenleme için Dosyalarım kısmına
                gidebilirsiniz.
            </div>
            <div class="modal-footer">
                <a href="{{ route('invitation_letter.create', 0) }}" id="davet-mektubu-olustur"
                   class="btn btn-primary">Davet
                    Mektubu
                    Oluştur</a>
                <button type="button" id="dosya-olustur" class="btn btn-success">Kaydet ve Dosyalarıma Git
                </button>
            </div>
        </div>
    </div>
</div>