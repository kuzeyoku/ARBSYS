<?php
use Illuminate\Support\Facades\DB;
$is_sozlesmeleri = [
"Tüketici Tazminatı Alacağı",
"Asgari Geçim İndirimi (AGİ) Alacağı",
"Bakiye Süre Ücret Alacağı",
"Cezai Şart Alacağı",
"Çocuk Parası Alacağı",
"Eğitim Yardımı Alacağı",
"Fazla Çalışma Ücreti Alacağı",
"Fazla Sürelerle Çalışma Ücret Alacağı",
"Gece Vardiyası Zammı Alacağı",
"Gemiadamı İaşe Bedeli Alacağı",
"Hafta Tatili Ücreti Alacağı",
"Haksız Fesih Tazminatı Alacağı",
"İhbar Tazminatı Alacağı",
"İlave Tediye Alacağı",
"İş Arama İzni Ücreti Alacağı",
"İşe İade Sonrası Boşta Geçen Süre Alacağı",
"İşe Başlatmama Tazminatı Alacağı",
"Kıdem Tazminatı Alacağı",
"Kötü Niyet Tazminatı Alacağı",
"Maddi Tazminat Alacağı",
"Manevi Tazminat Alacağı",
"Ölüm Tazminatı Alacağı",
"Prim/İkramiye Alacağı",
"Sendikal Tazminat Alacağı",
"Toplu İş Söz. Kaynaklı Alacaklar",
"Transfer Ücreti Alacağı",
"TİS ten Kaynaklanan Ücret Alacağı",
"TİS ten Kaynaklanan Sosyal Yardım Alacağı",
"Ulusal Bayram ve Genel Tatil Ücreti",
"Ücret (Maaş) Alacağı",
"Yemek Parası Alacağı",
"Yıllık Ücretli İzin Alacağı",
"Yarım Ücret Alacağı",
"Yol Parası Alacağı"
];

$new_data = [];
$id = explode("/",(string) url()->current())[4];
$data = DB::table('understood_status')->where("lawsuit_id", "=",(int) $id)->get();

foreach ($data as $key => $value) {
array_push($new_data, $value->name);
}
?>
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="select_subject_modal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">İş sözleşmesinin feshi sebebiyle</h5>
            </div>
            <div class="modal-body">
                <div class="kt-checkbox-list">
                    <div class="row">
                        <?php $__currentLoopData = $is_sozlesmeleri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-4">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                <input type="checkbox" name="subject_radio" value="<?php echo e($value); ?>"
                                    <?php if(!!array_search($value, $new_data)): ?> checked <?php endif; ?>> <?php echo e($value); ?>

                                <span></span>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background: #149FFC; color: white;"
                    id="select_subject_button">Ekle</button>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/lawsuit/partials/subject_replace_modal.blade.php ENDPATH**/ ?>