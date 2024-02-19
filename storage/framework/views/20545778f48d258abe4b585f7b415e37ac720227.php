<div class="page-title">
    ARABULUCU BELİRLEME TUTANAĞI
</div>
<div class="template text-justify" identifier="template">
    <table>
        <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>BAŞVURUCU</td>
                <td>:</td>
                <td>
                    <?php if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                        <?php echo e($claimant->detail->name); ?> (T.C. Kimlik No:<?php echo e($claimant->detail->identification); ?>)<br>
                    <?php elseif($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
                        <?php echo e($claimant->detail->name); ?><br>
                        (Mersis No: <?php echo e($claimant->detail->mersis_number); ?>) (<?php echo e($claimant->detail->tax_office); ?> V.D.
                        <?php echo e($claimant->detail->tax_number); ?>)<br>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>ADRESİ</td>
                <td>:</td>
                <td>
                    <?php echo e($claimant->detail->address); ?>

                </td>
            </tr>
            <tr>
                <td>İLETİŞİM</td>
                <td>:</td>
                <td>
                    <?php echo e(!is_null($claimant->detail->phone) ? $claimant->detail->phone . ' - ' : ''); ?>

                    <?php echo e($claimant->detail->email); ?>

                </td>
            </tr>
            <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(Str::upper($side->applicant_title)); ?></td>
                    <td>:</td>
                    <td>
                        <?php echo e($side->detail->name); ?> (T.C. Kimlik No:<?php echo e($side->detail->identification); ?>)
                    </td>
                </tr>
                <tr>
                    <td>ADRESİ</td>
                    <td>:</td>
                    <td>
                        <?php echo e($side->detail->address); ?>

                    </td>
                </tr>
                <tr>
                    <td>İLETİŞİM</td>
                    <td>:</td>
                    <td>
                        <?php echo e(!is_null($side->detail->phone) ? $side->detail->phone . ' - ' : ''); ?>

                        <?php echo e($side->detail->email); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>DİĞER TARAF</td>
                <td>:</td>
                <td>
                    <?php if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL): ?>
                        <?php echo e($defendant->detail->name); ?> (T.C. Kimlik No:<?php echo e($defendant->detail->identification); ?>)<br>
                    <?php elseif($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY): ?>
                        <?php echo e($defendant->detail->name); ?><br>
                        (Mersis No: <?php echo e($defendant->detail->mersis_number); ?>) (<?php echo e($defendant->detail->tax_office); ?>

                        V.D. <?php echo e($defendant->detail->tax_number); ?>)<br>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>ADRESİ</td>
                <td>:</td>
                <td>
                    <?php echo e($defendant->detail->address); ?>

                </td>
            </tr>
            <tr>
                <td>İLETİŞİM</td>
                <td>:</td>
                <td>
                    <?php echo e(!is_null($defendant->detail->phone) ? $defendant->detail->phone . ' - ' : ''); ?>

                    <?php echo e($defendant->detail->email); ?>

                </td>
            </tr>
            <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(ucwords($side->applicant_title)); ?></td>
                    <td>:</td>
                    <td>
                        <?php echo e($side->detail->name); ?> (T.C. Kimlik No:<?php echo e($side->detail->identification); ?>)
                    </td>
                </tr>
                <tr>
                    <td>ADRESİ</td>
                    <td>:</td>
                    <td>
                        <?php echo e($side->detail->address); ?>

                    </td>
                </tr>
                <tr>
                    <td>İLETİŞİM</td>
                    <td>:</td>
                    <td>
                        <?php echo e(!is_null($side->detail->phone) ? $side->detail->phone . ' - ' : ''); ?>

                        <?php echo e($side->detail->email); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>UYUŞMAZLIK TÜRÜ</td>
            <td>:</td>
            <td>@UyusmazlikTuru</td>
        </tr>
        <tr>
            <td>UYUŞMAZLIK KONUSU</td>
            <td>:</td>
            <td>@UyusmazlıkKonu</td>
        </tr>
    </table>
</div>
<p class="paragraph" style="margin-top: 20px;">
    <?php echo $result ?? ''; ?>

</p>
<p class="paragraph">
    Arabuluculuk Bürosu’ndaki başvuru ve kayıt işlemlerinin bu bilgiler ışığında yapılmasını talep ederiz. @BugunTarih
</p>
<table>
    <tr class="vertical-top font-bold">
        <td>Başvurucu</td>
        <td>Muhatap</td>
        <td>Arabulucu</td>
    </tr>
    <tr class="vertical-top">
        <td>
            <?php $__currentLoopData = $lawsuit->getClaimants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claimant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h1 class="title">TARAF</h1>
                <div class="line"><?php echo e($claimant->detail->name); ?></div>
                <?php if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($claimant->id, $side_ids)): ?>
                    <br><br><br><br>
                <?php endif; ?>
                <?php $__currentLoopData = $claimant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($side->id, $side_ids)): ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <div class="side" identifier="randomUuid1side">
                        <div class="line"><?php echo e($side->applicant_title); ?></div>
                        <div class="line"><?php echo e($side->detail->name); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td>
            <?php $__currentLoopData = $lawsuit->getDefendants(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $defendant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h1 class="title">TARAF</h1>
                <p><?php echo e($defendant->detail->name); ?></p>
                <?php if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($defendant->id, $side_ids)): ?>
                    <br><br><br><br>
                <?php endif; ?>
                <?php $__currentLoopData = $defendant->sub_sides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($side->id, $side_ids)): ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <div class="side" identifier="randomUuid2side">
                        <div class="line"><?php echo e($side->applicant_title); ?></div>
                        <div class="line"><?php echo e($side->detail->name); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
        <td>
            <p>Arb. Av. <?php echo e(auth()->user()->name); ?> <br />(ADB Sicil No:
                <?php echo e(auth()->user()->mediator->registration_no); ?>) </p>
        </td>
    </tr>
</table>
<p class="text-center font-bold" style="margin-top: 50px;">
    İşbu tutanak @TeslimEdenAdSoyad (T.C. Kimlik No: @TeslimEdenTCKNo) tarafından teslim edilecektir.
</p>
<?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/document/arbiter_define_protocol/template.blade.php ENDPATH**/ ?>