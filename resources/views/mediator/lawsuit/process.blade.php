<span class="dropleft">
    <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="true">
        @svg('fas-file')
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item"
           href="{{ route('invitation_letter.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(1))
                @svg('fas-check-double',"text-success") Davet Mektubu Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Davet Mektubu Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('arbiter_process_info_protocol.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(2))
                @svg('fas-check-double', "text-success") Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Yeniden
                Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('kvkk.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(3))
                @svg('fas-check-double', "text-success") KVKK Belgesi Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") KVKK Belgesi Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('arbiter_define_protocol.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(15))
                @svg('fas-check-double',"text-success") Arabulucu Belirleme Tutanağı Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Arabulucu Belirleme Tutanağı Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('meeting_protocol.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(4))
                @svg('fas-check-double',"text-success") Toplantı Tutanağı Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Toplantı Tutanağı Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('agreement_document.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(5))
                @svg('fas-check-double',"text-success") Anlaşma Belgesi Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Anlaşma Belgesi Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('wage_agreement.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(7))
                @svg('fas-check-double',"text-success") Ücret Sözleşmesi Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Ücret Sözleşmesi Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('final_protocol.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(8))
                @svg('fas-check-double',"text-success") Son Tutanak Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Son Tutanak Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('authority_objection.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(16))
                @svg('fas-check-double',"text-success") Yetki İtirazı Üst Yazı Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Yetki İtirazı Üst Yazı Oluştur
            @endif
        </a>
        <a class="dropdown-item" href="{{ route('authority_document.create', $lawsuit) }}">
            @if($lawsuit->hasDocument(17))
                @svg('fas-check-double',"text-success") Yetki Belgesi Yeniden Oluştur
            @else
                @svg('fas-file-medical', "text-danger") Yetki Belgesi Oluştur
            @endif
        </a>
        <a class="dropdown-item"
           href="{{ route('lawsuit.archive', $lawsuit) }}">@svg('fas-file-archive',"text-warning") Arşivle</a>
    </div>
</span>
<span class="dropleft dropdown-inline">
    <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="true">
        @svg('fas-cog')
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a class="dropdown-item" href="{{ route('lawsuit.document', $lawsuit) }}">@svg("far-file") Evraklarım</a>
        <a class="dropdown-item" href="{{ route('lawsuit.note_view', $lawsuit) }}">@svg("far-sticky-note") Notlarım</a>
        <a class="dropdown-item" href="{{ route('lawsuit.sides', $lawsuit) }}">@svg("far-user") Taraflar</a>
        <a class="dropdown-item" href="{{ route('lawsuit.logs', $lawsuit) }}">@svg("far-list-alt") İşlemler</a>
        <a class="dropdown-item" href="{{ route('lawsuit.edit', $lawsuit) }}">@svg("far-edit") Düzenle</a>
        {{ Form::open(['url' => route('lawsuit.destroy', $lawsuit), 'method' => 'delete']) }}
        <button type="button"
                class="dropdown-item text-danger delete-btn pl-3 py-2">@svg('fas-times') Dosyayı Sil</button>
        {{ Form::close() }}
    </div>
</span>
