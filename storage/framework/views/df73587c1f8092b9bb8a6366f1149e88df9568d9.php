<span class="dropleft">
    <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="true">
        <?php echo e(svg('fas-file')); ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?php echo e(route('invitation_letter.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Davet Mektubu
            Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('kvkk.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> KVKK Belgesi Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('arbiter_process_info_protocol.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?>
            Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('arbiter_define_protocol.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Arabulucu
            Belirleme Tutanağı Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('meeting_protocol.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Toplantı
            Tutanağı Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('agreement_document.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Anlaşma
            Belgesi Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('wage_agreement.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Ücret Sözleşmesi
            Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('final_protocol.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Son Tutanak
            Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('authority_objection.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Yetki İtirazı
            Üst Yazı Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('authority_document.create', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Yetki Belgesi
            Oluştur</a>
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.archive', $item)); ?>"><?php echo e(svg('fas-envelope-open-text')); ?> Arşivle</a>
    </div>
</span>
<span class="dropleft dropdown-inline">
    <button class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="true">
        <?php echo e(svg('fas-cog')); ?>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.document', $item)); ?>"><?php echo e(svg("far-file")); ?> Evraklarım</a>
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.note_view', $item)); ?>"><?php echo e(svg("far-sticky-note")); ?> Notlarım</a>
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.sides', $item)); ?>"><?php echo e(svg("far-user")); ?> Taraflar</a>
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.logs', $item)); ?>"><?php echo e(svg("far-list-alt")); ?> İşlemler</a>
        <a class="dropdown-item" href="<?php echo e(route('lawsuit.edit', $item)); ?>"><?php echo e(svg("far-edit")); ?> Düzenle</a>
        <?php echo e(Form::open(['url' => route('lawsuit.destroy', $item), 'method' => 'delete'])); ?>

        <button type="button" class="dropdown-item text-danger delete-btn pl-3 py-2"><?php echo e(svg('fas-times')); ?> Dosyayı Sil</button>
        <?php echo e(Form::close()); ?>

    </div>
</span>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/process.blade.php ENDPATH**/ ?>