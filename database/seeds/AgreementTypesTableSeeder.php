<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('agreement_types')->truncate();
        DB::table('agreement_types')->insert([
            [
                'name' => 'İşe iade edilme',
                'description' => 'Taraflar işçinin işe iade edilmesi hususunda anlaşılmıştır.',
                'template' => '<p>Taraflar arasında yapılan müzakereler neticesinde işçinin işe iadesine karar verilmiş olup taraflar aşağıdaki hususlarda anlaşmışlardır:</p>
<p class="paragraph">a) İşçi …………….  XX.XX.2021 tarihinde işe başlayacaktır.</p>
<p class="paragraph">b) İşçinin boşta kaldığı süreye ilişkin olarak işveren ……………. tarafından ödenmesi gereken ücret tutarı net #X.XXX-TL dir.</p>
<p>Bu maddeye istinaden belirlenen ücret tutarları ……………. tarafından XX.XX.20XX tarihinde #X.XXX-TL, XX.XX.XXXX tarihinde #X.XXX-TL olmak üzere …………………. adına açılmış, Para Bank A.Ş. de bulunan, TRXX XXXX XXXX XXXX XXXX XXXX XX nolu IBAN hesabına yatırılacaktır.</p>
<p class="paragraph">c) İşçi …………….nin işe başlatılmaması halinde işveren ……………. tarafından ödenmesi gereken tazminat tutarı net #X.XXX-TL dir.</p>
<p>İşçi …………….in belirlenen tarihte fiilen işe başlatılmaması halinde işveren ……………. tarafından ödenmesi gereken toplam tutar XX.XXX-TL olup bu tutar ……………………. tarafından XX.XX.20XX tarihinde X.XXX-TL, XX.XX.XXXX tarihinde X.XXX-TL olmak üzere ………………adına açılmış ve yukarıda bilgileri verilen IBAN hesabına yatırılacaktır.</p>
<p>Ödemelerden herhangi birinin belirlenen vadede ifa edilmemesi halinde kalan tüm taksitler muaccel hale gelecek ve toplam tutara muacceliyet tarihinden itibaren yıllık %..... faiz uygulanacaktır.</p>
<p>İşbu anlaşma belgesi, (   ) sayfa ve (   ) nüsha olarak düzenlenmiş olup taraflarla birlikte imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. XX.XX.2021</p>',
                'back_to_work' => true
            ],
            [
                'name' => 'İşe iade edilmeme',
                'description' => 'Taraflar işçinin işe iade edilmemesi hususunda anlaşılmıştır.',
                'template' => '<p>Taraflar arasında yapılan müzakereler neticesinde taraflar, işçi …………….in işe başlatılmaması hususunda mutabık kalmışlar ve aşağıdaki hususlarda anlaşmışlardır:</p>
<p class="paragraph">a) İşçi …………….in boşta kaldığı süreye ilişkin olarak işveren ……………. tarafından ödenmesi gereken ücret tutarı net #X.XXX-TL dir.</p>
<p>Bu maddeye istinaden belirlenen ücret tutarları ………………. tarafından XX.XX.20XX tarihinde #X.XXX-TL, XX.XX.XXXX tarihinde #X.XXX-TL olmak üzere ………………………. adına açılmış, Para Bank A.Ş. de bulunan, TRXX XXXX XXXX XXXX XXXX XXXX XX nolu IBAN hesabına yatırılacaktır.</p>
<p class="paragraph">b) İşçi …………….in işe başlatılmaması nedeniyle işveren ……………. tarafından ödenmesi gereken tazminat tutarı net #X.XXX-TL dir.</p>
<p>Bu maddeye istinaden belirlenen tazminat tutarı net #XX.XXX-TL olup bu tutar ………………….. tarafından XX.XX.20XX tarihinde #X.XXX-TL, XX.XX.XXXX tarihinde X.XXX-TL olmak üzere ………………… adına açılmış ve yukarıda bilgileri verilen IBAN hesabına yatırılacaktır.</p>
<p class="paragraph">c) Taraflar işçinin iş sözleşmesinin geçerli sebeple sona ermiş olduğu ve ………………… ‘ın işçilik alacaklarına (ücret alacağı için net X.XXX,XX-TL, kıdem tazminatı için net X.XXX,XX -TL, ihbar tazminatı için net X.XXX,XX-TL, yıllık izin ücreti alacağı için net X.XXX,XX-TL) ilişkin tutarların toplam bedelinin net #X.XXX-TL olduğu, fazla çalışma ücretine ilişkin alacağı olmadığı hususunda taraflar anlaşmışlardır.</p>
<p>Bu maddeye istinaden belirlenen tazminat tutarı  …………… tarafından XX.XX.20XX tarihinde X.XXX-TL, XX.XX.20XX tarihinde X.XXX-TL, XX.XX.20XX tarihinde X.XXX-TL ve  XX.XX.XXXX tarihinde X.XXX-TL olmak üzere …………….. adına açılmış, Para Bank A.Ş. de bulunan, TRXX XXXX XXXX XXXX XXXX XXXX XX nolu IBAN hesabına yatırılacaktır. </p>
<p>Ödemelerden herhangi birinin belirlenen vadede ifa edilmemesi halinde kalan tüm taksitler muaccel hale gelecek ve toplam tutara muacceliyet tarihinden itibaren yıllık %..... faiz uygulanacaktır.</p>
<p>İşbu anlaşma belgesi, (    ) sayfa ve (    ) nüsha olarak düzenlenmiş olup taraflarla birlikte imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. XX.XX.2021</p>',
                'back_to_work' => true
            ],
            [
                'name' => 'Anlaşma',
                'description' => 'Taraflar müzakere edilen hususlarda anlaşmaya varmışlardır.',
                'template' => null,
                'back_to_work' => false
            ],
            [
                'name' => 'Kısmen anlaşma',
                'description' => 'Taraflar müzakere edilen hususlarda kısmen anlaşmaya varmışlardır.',
                'template' => null,
                'back_to_work' => false
            ],
            [
                'name' => 'Anlaşmama',
                'description' => 'Taraflar müzakere edilen hususlarda anlaşmaya varamamışlardır.',
                'template' => null,
                'back_to_work' => false
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
