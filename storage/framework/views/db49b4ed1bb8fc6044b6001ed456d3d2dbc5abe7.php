<a href="javascript:;" class="btn btn-sm btn-success addLawyer" data-sideid="<?php echo e($side->id); ?>"
    data-sidetypeid="<?php echo e($side->side_type_id); ?>" data-applicanttypeid="<?php echo e(ApplicantTypeOptions::LAWYER); ?>">Vekil Ekle</a>
<a href="javascript:;" class="btn btn-sm btn-success addRepresentative" data-sideid="<?php echo e($side->id); ?>"
    data-sidetypeid="<?php echo e($side->side_type_id); ?>" data-applicanttypeid="<?php echo e(ApplicantTypeOptions::REPRESENTATIVE); ?>">Kanuni
    Temsilci Ekle</a>
<a href="javascript:;" class="btn btn-sm btn-success addExpert" data-sideid="<?php echo e($side->id); ?>"
    data-sidetypeid="<?php echo e($side->side_type_id); ?>" data-applicanttypeid="<?php echo e(ApplicantTypeOptions::EXPERT); ?>">Uzman Kişi
    Ekle</a>
<a href="javascript:;" class="btn btn-sm btn-success addAuthorized" data-sideid="<?php echo e($side->id); ?>"
    data-sidetypeid="<?php echo e($side->side_type_id); ?>" data-applicanttypeid="<?php echo e(ApplicantTypeOptions::AUTHORIZED); ?>">Yetkili
    Ekle</a>
<a href="javascript:;" class="btn btn-sm btn-success mt-1 addWorker" data-sideid="<?php echo e($side->id); ?>"
    data-sidetypeid="<?php echo e($side->side_type_id); ?>" data-applicanttypeid="<?php echo e(ApplicantTypeOptions::WORKER); ?>">Çalışan
    Ekle</a><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/partials/add_sub_side_buttons.blade.php ENDPATH**/ ?>