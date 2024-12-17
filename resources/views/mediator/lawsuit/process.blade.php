<span class="dropleft">
    <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="true">
        @svg('fas-file')
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ route('invitation_letter.create', $lawsuit) }}">@svg('fas-envelope-open-text') Davet Mektubu
            Oluştur</a>
        <a class="dropdown-item" href="{{ route('kvkk.create', $lawsuit) }}">@svg('fas-envelope-open-text') KVKK Belgesi Oluştur</a>
        <a class="dropdown-item" href="{{ route('arbiter_process_info_protocol.create', $lawsuit) }}">@svg('fas-envelope-open-text')
            Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluştur</a>
        <a class="dropdown-item" href="{{ route('arbiter_define_protocol.create', $lawsuit) }}">@svg('fas-envelope-open-text') Arabulucu
            Belirleme Tutanağı Oluştur</a>
        <a class="dropdown-item" href="{{ route('meeting_protocol.create', $lawsuit) }}">@svg('fas-envelope-open-text') Toplantı
            Tutanağı Oluştur</a>
        <a class="dropdown-item" href="{{ route('agreement_document.create', $lawsuit) }}">@svg('fas-envelope-open-text') Anlaşma
            Belgesi Oluştur</a>
        <a class="dropdown-item" href="{{ route('wage_agreement.create', $lawsuit) }}">@svg('fas-envelope-open-text') Ücret Sözleşmesi
            Oluştur</a>
        <a class="dropdown-item" href="{{ route('final_protocol.create', $lawsuit) }}">@svg('fas-envelope-open-text') Son Tutanak
            Oluştur</a>
        <a class="dropdown-item" href="{{ route('authority_objection.create', $lawsuit) }}">@svg('fas-envelope-open-text') Yetki İtirazı
            Üst Yazı Oluştur</a>
        <a class="dropdown-item" href="{{ route('authority_document.create', $lawsuit) }}">@svg('fas-envelope-open-text') Yetki Belgesi
            Oluştur</a>
        <a class="dropdown-item" href="{{ route('lawsuit.archive', $lawsuit) }}">@svg('fas-envelope-open-text') Arşivle</a>
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
        <button type="button" class="dropdown-item text-danger delete-btn pl-3 py-2">@svg('fas-times') Dosyayı Sil</button>
        {{ Form::close() }}
    </div>
</span>
