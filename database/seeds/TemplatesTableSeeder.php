<?php

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('templates')->truncate();
        $system_categories = [
            [
                'document_type_id' => 3,
                'subject_type_id' => 1,
                'result' => 'Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ve İş Mahkemeleri Kanunu gereğince dava şartı arabuluculuk hükümleri çerçevesinde uyuşmazlığımızın arabuluculuk yoluyla çözümü için tarafımızca arabulucu olarak Adalet Bakanlığı Arabuluculuk Daire Başkanlığı siciline @ArabulucuSicilNo sicil numarasıyla kayıtlı Arabulucu @ArabulucuAdSoyad belirlenmiştir.',
            ],
            [
                'document_type_id' => 3,
                'subject_type_id' => 2,
                'result' => 'Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ve 7155 Sayılı Kanun gereğince dava şartı arabuluculuk hükümleri çerçevesinde ticari uyuşmazlığımızın arabuluculuk yoluyla çözümü için tarafımızca arabulucu olarak Adalet Bakanlığı Arabuluculuk Daire Başkanlığı siciline @ArabulucuSicilNo sicil numarasıyla kayıtlı Arabulucu @ArabulucuAdSoyad belirlenmiştir.',
            ],
            [
                'document_type_id' => 3,
                'subject_type_id' => 3,
                'result' => 'Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ve 6052 sayılı Tüketicinin korunması hakkında Kanun gereğince dava şartı arabuluculuk hükümleri çerçevesinde uyuşmazlığımızın arabuluculuk yoluyla çözümü için tarafımızca arabulucu olarak Adalet Bakanlığı Arabuluculuk Daire Başkanlığı siciline @ArabulucuSicilNo sicil numarasıyla kayıtlı Arabulucu @ArabulucuSicilNo belirlenmiştir.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 1,
                'matters_discussed' => 'İş sözleşmesinin feshi sebebiyle, işçinin, iş yerinde çalışmış olduğu süreye ilişkin olarak eksik ödenen veya hiç ödenmeyen @konu_popup olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 2,
                'matters_discussed' => 'İşçinin iş sözleşmesinin feshinin haklı / geçerli sebebe dayanıp dayanmadığı ve işçinin işe iade talebi ile işçinin boşta geçen sürelerine ilişkin ücret alacağı bulunup bulunmadığı ve işçinin işe başlatılmaması halinde işçiye ödenmesi gereken bir tazminat bulunup bulunmadığı hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 5,
                'matters_discussed' => 'Taraflar arasındaki ticari kredi sözleşmesinden kaynaklanan uyuşmazlık nedeniyle ödenmesi gereken bir tutar olup olmadığı, olması halinde bu tutarın ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 6,
                'matters_discussed' => 'Taraflar arasındaki XX.XX.2022 tarihli sigorta sözleşmesinden kaynaklanan sigorta bedelinin sigorta olunan menfaatin üzerinde olup olmadığı, üzerinde olması halinde ne şekilde ve ne zaman iade edileceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 8,
                'matters_discussed' => 'XXX ‘a ait “XXX” adlı tiyatro eserinin gösterimleri nedeniyle, Fikir ve Sanat Eserleri Kanunu ‘ndan doğan bir ihlal olup olmadığı, ihlal olması halinde maddi ve manevi tazminat ödenmesini ve/veya elde edilen kârın iadesini gerektirip gerektirmediği, tazminat ödenmesi ve/veya elde edilen kârın iadesinin gerekmesi halinde ödemenin ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 12,
                'matters_discussed' => 'Taraflar arasındaki XX.XX.2022 tarihli …… sebebi ile oluşan cari hesap dökümüne dayalı olarak herhangi bir alacak olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 13,
                'matters_discussed' => 'Her iki tarafın da tacir olduğu durumlarda taraflar arasındaki eser sözleşmesinden kaynaklanan uyuşmazlık konusunda temerrüdün / eksik – kusurlu imalatın söz konusu olup olmadığı, olması halinde taraflardan birinin kusuru olup olmadığı, kusurun mevcudiyeti halinde tazminat ödenmesini gerektirip gerektirmediği, tazminat gerektirmesi halinde bu tazminatın ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 14,
                'matters_discussed' => 'Bağlı şirkette kayıp oluşup oluşmadığı, kayıp oluştuğunun kabulü halinde bağlı şirket alacaklılarının zarara uğrayıp uğramadıkları, zarara uğramış olmaları halinde hakim şirketin ve onun kayıptan sorumlu yönetim kurulu üyelerinin ödemeleri gereken bir tazminat olup olmadığı, olması halinde ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 15,
                'matters_discussed' => 'Taraflar arasındaki İzmir XX. İcra Müdürlüğü ‘nün 2020/…… E. sayılı dosyasına itirazın haklı olup olmadığı, takibe konu ödenmesi gereken bir tutar olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 16,
                'matters_discussed' => 'Taraflar arasındaki kambiyo senedinin aradaki anlaşmaya aykırı şekilde doldurulup doldurulmadığı ve buna bağlı olarak ödenmesi gereken bir alacak olup olmadığı, olması halinde ne şekilde ve ne zaman iade edileceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 17,
                'matters_discussed' => 'Taraflar arasındaki ……….. numaralı, XX/XX2021 vadeli, #X.XXX-TL bedelli ve …………. numaralı, XX/XX2021 vadeli, #X.XXX-TL bedelli çekler yönünden ödenmesi gereken bir bedel olup olmadığı, bu çeklerle ilgili teslim edilmiş bir mal veya sunulmuş bir hizmet olup olmadığı, bu çeklerle ilgili olarak ödenmesi gereken bir tutar olması halinde ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 18,
                'matters_discussed' => 'XX.XX.XXXX tarihinde meydana gelen, XXXXXX sevk ve idaresindeki 35 XX 000 plakalı aracın karıştığı trafik kazası ile ilgili olarak ödenmesi gereken bir tutar (tazminat) olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 19,
                'matters_discussed' => 'Taraflar arasındaki XX.XX.2021 tarihli acentelik sözleşmesinin sona ermesi sonucunda tacir müvekkilin acenteye ödemesi gereken bir tazminat olup olmadığı, olması halinde ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 5,
                'subject_id' => 20,
                'matters_discussed' => 'Taraflar arasındaki taşıma sözleşmesinden kaynaklanan ve taşıyana muhafazası için teslim edilmiş olan eşyanın zayi / hasarı nedeniyle bir tazminat ödenmesi gerekip gerekmediği gerekmesi halinde tazminatın ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 6,
                'subject_id' => 1,
                'agreement' => '………………… ‘ın işçilik alacaklarına (ücret alacağı için net X.XXX,XX-TL, kıdem tazminatı için net X.XXX,XX -TL, ihbar tazminatı için net X.XXX,XX-TL, yıllık izin ücreti alacağı için net X.XXX,XX-TL) ilişkin tutarların toplam bedelinin net #X.XXX-TL olduğu, fazla çalışma ücretine ilişkin alacağı olmadığı hususunda taraflar anlaşmışlardır.&nbsp;<br><br>Bu tutar …………… tarafından XX.XX.20XX tarihinde X.XXX-TL, XX.XX.20XX tarihinde X.XXX-TL, XX.XX.20XX tarihinde X.XXX-TL ve  XX.XX.XXXX tarihinde X.XXX-TL olmak üzere …………….. adına açılmış, Para Bank A.Ş. de bulunan, TRXX XXXX XXXX XXXX XXXX XXXX XX nolu IBAN hesabına yatırılacaktır.&nbsp;<br><br>Ödemelerden herhangi birinin belirlenen vadede ifa edilmemesi halinde kalan tüm taksitler muaccel hale gelecek ve toplam tutara muacceliyet tarihinden itibaren yıllık %..... faiz uygulanacaktır.<br><br>İşbu anlaşma belgesi, (    ) sayfa ve ( @NushaAdet ) nüsha olarak düzenlenmiş olup taraflarla @İmzaYöntemi imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. @BugunTarih',
                'matters_discussed' => 'İş sözleşmesinin feshi sebebiyle, işçinin, iş yerinde çalışmış olduğu süreye ilişkin olarak eksik ödenen veya hiç ödenmeyen @konu_popup olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.'
            ],
            [
                'document_type_id' => 6,
                'subject_id' => 12,
                'matters_discussed' => 'Taraflar arasındaki XX.XX.2022 tarihli ………..….sebebi ile oluşan cari hesap dökümüne dayalı olarak herhangi bir alacak olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
                'agreement' => 'Taraflar arasındaki XX.XX.2022 tarihli ………….sebebi ile oluşan cari hesap dökümüne dayalı olarak ………………. San. ve Tic. A.Ş. ‘nin ……………… San. ve Tic. A.Ş. ‘ye ödemesi gereken #X.XXX-TL borcu olduğu hususunda taraflar anlaşmışlardır. Bu tutar ………………….. San. ve Tic. A.Ş. tarafından XX.XX.20XX tarihinde #X.XXX-TL, XX.XX.20XX tarihinde #X.XXX-TL olmak üzere …………….. San. ve Tic. A.Ş. ‘ye adına açılmış, Para Bank A.Ş. de bulunan, TRXX XXXX XXXX XXXX XXXX XXXX XX nolu IBAN hesabına yatırılacaktır.&nbsp;<br><br>İşbu anlaşma belgesi, (    ) sayfa ve ( @NushaAdet ) nüsha olarak düzenlenmiş olup taraflarla birlikte imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 6,
                'subject_id' => 15,
                'matters_discussed' => 'Taraflar arasındaki İzmir XX. İcra Müdürlüğü ‘nün 2022/………. E. sayılı dosyasına itirazın haklı olup olmadığı, takibe konu ödenmesi gereken bir tutar olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
                'agreement' => 'Taraflar arasındaki İzmir XX. İcra Müdürlüğü ‘nün 2022/………. E. sayılı dosyasına itirazın (kısmen) haklı olduğu ………….<br>İşbu anlaşma belgesi, (  ) sayfa ve ( @NushaAdet ) nüsha olarak düzenlenmiş olup taraflarla birlikte imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 6,
                'subject_id' => 18,
                'matters_discussed' => 'XX.XX.2022 tarihinde meydana gelen, ……………… sevk ve idaresindeki 35 XX 000 plakalı aracın karıştığı trafik kazası ile ilgili olarak ödenmesi gereken bir tutar (tazminat) olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
                'agreement' => 'XX.XX.2022 tarihinde meydana gelen, ……………… sevk ve idaresindeki 35 XX 000 plakalı aracın karıştığı trafik kazası ile ilgili olarak ödenmesi gereken tazminat tutarının XX0.000,00-TL olduğu ve ayrıca Av. ……………. lehine #X.000,00-TL de vekalet ücreti ödeneceği hususlarında taraflar anlaşmışlardır. Bu tutar ……………… Sigorta A.Ş. tarafından en geç XX.XX.2022 tarihinde, nakden ve defaten ……………. adına açılmış, Para Banka A.Ş. ‘de bulunan, TR00 0000 0000 0000 0000 0000 00 nolu IBAN hesabına yatırılacaktır.<br> ………..İşbu anlaşma belgesi, (    ) sayfa ve ( @NushaAdet ) nüsha olarak düzenlenmiş olup taraflarla birlikte imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 6,
                'agreement' => '…………. İşbu anlaşma belgesi, (  ) sayfa ve ( @NushaAdet ) nüsha olarak düzenlenmiş olup taraflarla @İmzaYöntemi imza altına alınarak birer nüshası taraflara elden teslim edilmiştir. @BugunTarih'
            ],
            [
                'document_type_id' => 7,
                'subject_id' => 1,
                'matters_discussed' => 'İş sözleşmesinin feshi sebebiyle, işçinin, iş yerinde çalışmış olduğu süreye ilişkin olarak eksik ödenen veya hiç ödenmeyen @konu_popup olup olmadığı, varsa ne şekilde ve ne zaman ödeneceği hususları.',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 1,
                'result' => 'Arabuluculuk süreci sonunda taraflar anlaşmaya varmışlardır. İşbu arabuluculuk son tutanağı 6325 Sayılı Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ‘nun 17. maddesi ve dava şartına ilişkin özel hükümler uyarınca arabulucu tarafından (   ) sayfa ve ( @NushaAdet ) nüsha olarak hazırlanmış taraflarla @İmzaYöntemi imza altına alınarak birer nüshası taraflara teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 2,
                'result' => 'Arabuluculuk süreci sonunda taraflar anlaşmaya varamamışlardır. İşbu arabuluculuk son tutanağı 6325 Sayılı Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ‘nun 17. maddesi ve dava şartına ilişkin özel hükümler uyarınca arabulucu tarafından (   ) sayfa ve ( @NushaAdet ) nüsha olarak hazırlanmış taraflarla @İmzaYöntemi imza altına alınarak birer nüshası taraflara teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 3,
                'matters_discussed' => '(Belirlenen ilk toplantıya @ToplantiyaKatilmayanTaraf temsilen hiç kimse katılmamış, mazeret de bildirmemiş olduğu için uyuşmazlık konuları taraflar arasında müzakere edilememiştir.)',
                'result' => 'Arabuluculuk süreci @ToplantiyaKatilmayanTaraf toplantıya katılım sağlamamış olması nedeniyle görüşme yapılmaksızın anlaşamama olarak kapatılmış olup işbu arabuluculuk son tutanağı 6325 Sayılı Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ‘nun 17. maddesi ve dava şartına ilişkin özel hükümler uyarınca arabulucu tarafından (   ) sayfa ve (  @NushaAdet ) nüsha olarak hazırlanarak toplantıda hazır bulunanlarca imzalanmış ve bir nüshası katılan tarafa teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'subject_type_id' => 1,
                'result_type_id' => 4,
                'result' => 'Başvurusu konusu uyuşmazlık arabuluculuğa elverişli olmayıp “iş hukuku uyuşmazlıklarında dava şartı” kapsamı dışında kaldığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “arabuluculuğa elverişli olmama” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'subject_id' => 1,
                'result_type_id' => 7,
                'result' => 'Başvurusu konusu uyuşmazlığın arabuluculuğa elverişli olmakla birlikte “iş hukuku uyuşmazlıklarında dava şartı” kapsamı dışında kaldığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “sehven kayıt” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 8,
                'result' => 'Arabuluculuk süreci sonunda taraflar kısmen anlaşmaya varmışlardır. İşbu arabuluculuk son tutanağı 6325 Sayılı Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ‘nun 17. maddesi ve dava şartına ilişkin özel hükümler uyarınca arabulucu tarafından (   ) sayfa ve ( @NushaAdet ) nüsha olarak hazırlanmış taraflarla @İmzaYöntemi imza altına alınarak birer nüshası taraflara teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 4,
                'result' => 'Başvurusu konusu uyuşmazlıkta, müzakere edilmesi istenen hususların arabuluculuğa elverişli olmadığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “arabuluculuğa elverişli olmama” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'subject_type_id' => 2,
                'result_type_id' => 7,
                'result' => 'Başvurusu konusu uyuşmazlıkta, başvurucunun tacir olmaması nedeniyle uyuşmazlığın “nisbi ticari dava” olarak nitelendirilemeyeceği, dolayısıyla “ticari uyuşmazlıklarda dava şartı” kapsamı dışında kaldığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “sehven kayıt” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'subject_type_id' => 3,
                'result_type_id' => 7,
                'result' => 'Başvurusu konusu uyuşmazlığın arabuluculuğa elverişli olmakla birlikte miktar yönünden “tüketici hukuku uyuşmazlıklarında dava şartı” kapsamı dışında kaldığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “sehven kayıt” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'subject_type_id' => 3,
                'result_type_id' => 4,
                'result' => 'Başvurusu konusu uyuşmazlık arabuluculuğa elverişli olmayıp “tüketici hukuku uyuşmazlıklarında dava şartı” kapsamı dışında kaldığı tespit edildiği ve hazırlık aşamasında yapılan görüşme neticesinde bu tespit doğrulanmış olduğu için arabuluculuk süreci “arabuluculuğa elverişli olmama” olarak sonlandırılmış ve işbu belge re’sen hazırlanmıştır. @BugunTarih',
            ],
            [
                'document_type_id' => 7,
                'result_type_id' => 5,
                'matters_discussed' => 'Başvurucu, …………….. Adliyesi Arabuluculuk Bürosu’na yapmış olduğu başvurusundan ……….…. sebeple vazgeçmiştir.',
                'result' => 'İşbu tutanak 6325 sayılı kanunun 17. maddesi uyarınca arabulucu tarafından düzenlenmiş olup başvurucunun vazgeçme beyanı nedeniyle arabuluculuk görüşmelerine başlanmadan dosya “Konusuz Kalma – Başvurucunun Vazgeçmesi” ile kapatılmıştır. İşbu arabuluculuk son tutanağı 6325 Sayılı Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu ‘nun 17. maddesi ve dava şartına ilişkin özel hükümler uyarınca arabulucu tarafından (   ) sayfa ve ( @NushaAdet ) nüsha olarak hazırlanmış ve birer nüshası taraflara teslim edilmiştir. @BugunTarih',
            ],
            [
                'document_type_id' => 9,
                'subject_type_id' => 1,
                'result' => '<p class="paragraph">Yukarıda dosya numarası ve taraf bilgileri yazılı uyuşmazlık dosyasında taraflarla ilk oturum @IlkToplantiTarih tarihinde yapılmış, ilk oturumda taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından yetki itirazında bulunulmuştur.</p><p class="paragraph">Taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından dilekçe halinde sunulan yetki itirazına dayanak olarak @TicaretOdası Ticaret ve Sanayi Odası ‘ndan alınan faaliyet belgesi ve Ticaret Sicil Gazetesi ‘nin @BelgeTarih tarihinde yayımlanan @BelgeSayı sayısının @BelgeSayfa sayfasının çıktısı sunulmuştur. Buna karşılık olarak da başvurucu @BasvuranAdSoyad @BasvuranAvukat tarafından bir dilekçe ile yetki itirazının kabul edilmediği, başvurucunun @ÇalıştığıSüre yıl süreyle @ÇalıştığıYer ‘de çalıştığı bildirilmiştir. Başvurucu @BasvuranAvukat tarafından dilekçe ekinde başvurucu @BasvuranAdSoyad ‘ye ilişkin sigortalılık tescil ve hizmet dökümleri sunulmuştur.</p><p class="paragraph">7036 Sayılı Kanun ‘un 3 maddesinin 9. fıkrasında “Arabulucu, görevlendirmeyi yapan büronun yetkili olup olmadığını kendiliğinden dikkate alamaz. Karşı taraf en geç ilk toplantıda, yerleşim yeri ve işin yapıldığı yere ilişkin belgelerini sunmak suretiyle arabuluculuk bürosunun yetkisine itiraz edebilir. Bu durumda arabulucu, dosyayı derhal ilgili sulh hukuk mahkemesine gönderilmek üzere büroya teslim eder. Mahkeme, harç alınmaksızın dosya üzerinden yapacağı inceleme sonunda yetkili büroyu kesin olarak karara bağlar ve dosyayı büroya iade eder. Mahkeme kararı büro tarafından 11/2/1959 tarihli ve 7201 sayılı Tebligat Kanunu hükümleri uyarınca taraflara tebliğ edilir. Yetki itirazının reddi durumunda aynı arabulucu yeniden görevlendirilir ve onuncu fıkrada belirtilen süreler yeni görevlendirme tarihinden başlar. Yetki itirazının kabulü durumunda ise kararın tebliğinden itibaren bir hafta içinde yetkili büroya başvurulabilir. Bu takdirde yetkisiz büroya başvurma tarihi yetkili büroya başvurma tarihi olarak kabul edilir. Yetkili büro, altıncı fıkra uyarınca arabulucu görevlendirir.” denilmektedir.</p><p class="paragraph">Yine 02.06.2018 tarihli Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu Yönetmeliği ‘nin 25. maddesinin 4. fıkrasında da “Arabulucu, görevlendirmeyi yapan adliye arabuluculuk bürosunun yetkili olup olmadığını kendiliğinden dikkate alamaz. Karşı taraf en geç ilk toplantıda, yerleşim yeri ve işin yapıldığı yere ilişkin belgelerini sunmak suretiyle adliye arabuluculuk bürosunun yetkisine itiraz edebilir. Bu durumda arabulucu, dosyayı derhal ilgili sulh hukuk mahkemesine gönderilmek üzere adliye arabuluculuk bürosuna teslim eder.” şeklinde bir düzenleme mevcuttur.</p><p class="paragraph">İlgili mevzuat hükümleri gereğince dosya UYAP Arabulucu Portal üzerinden yetki itirazı olarak kapatılmış olup, yetki itirazı hakkında gerekli inceleme, değerlendirme ve işlemlerin yapılabilmesi için arabuluculuk dosyasının görevli ve yetkili Sulh Hukuk Mahkemesine sunulmak üzere işbu üst yazı ekinde @ArabuluculukBurosu Arabuluculuk Bürosuna verilmesi zorunluluğu hasıl olmuştur. @BugunTarih</p>',
            ],
            [
                'document_type_id' => 9,
                'subject_type_id' => 2,
                'result' => '<p class="paragraph">Yukarıda dosya numarası ve taraf bilgileri yazılı uyuşmazlık dosyasında taraflarla ilk oturum @IlkToplantiTarih tarihinde yapılmış, ilk oturumda taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından yetki itirazında bulunulmuştur.</p><p class="paragraph">Taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından dilekçe halinde sunulan yetki itirazına dayanak olarak @TicaretOdası Ticaret ve Sanayi Odası ‘ndan alınan faaliyet belgesi ve Ticaret Sicil Gazetesi ‘nin @BelgeTarih tarihinde yayımlanan @BelgeSayı sayısının @BelgeSayfa sayfasının çıktısı sunulmuştur. Buna karşılık olarak da başvurucu @BasvuranAdSoyad @BasvuranAvukat tarafından bir dilekçe ile yetki itirazının kabul edilmediği, başvurucunun @ÇalıştığıSüre yıl süreyle @ÇalıştığıYer ‘de çalıştığı bildirilmiştir. Başvurucu @BasvuranAvukat tarafından dilekçe ekinde taraflar arasındaki sözleşme ve sevk irsaliyeleri sunulmuştur.</p><p class="paragraph">6325 Sayılı Kanun ‘un 18/A maddesinin 8. fıkrasında “Arabulucu, görevlendirmeyi yapan büronun yetkili olup olmadığını kendiliğinden dikkate alamaz. Karşı taraf en geç ilk toplantıda, yetkiye ilişkin belgeleri sunmak suretiyle arabuluculuk bürosunun yetkisine itiraz edebilir. Bu durumda arabulucu, dosyayı derhâl ilgili sulh hukuk mahkemesine gönderilmek üzere büroya teslim eder. Mahkeme, harç alınmaksızın dosya üzerinden yapacağı inceleme sonunda en geç bir hafta içinde yetkili büroyu kesin olarak karara bağlar ve dosyayı büroya iade eder. Mahkeme kararı büro tarafından 11/2/1959 tarihli ve 7201 sayılı Tebligat Kanunu hükümleri uyarınca taraflara tebliğ edilir. Yetki itirazının reddi durumunda aynı arabulucu yeniden görevlendirilir ve dokuzuncu fıkrada belirtilen süreler yeni görevlendirme tarihinden başlar. Yetki itirazının kabulü durumunda ise kararın tebliğinden itibaren bir hafta içinde yetkili büroya başvurulabilir. Bu takdirde yetkisiz büroya başvurma tarihi yetkili büroya başvurma tarihi olarak kabul edilir. Yetkili büro, beşinci fıkra uyarınca arabulucu görevlendirir.” denilmektedir.</p><p class="paragraph">İlgili madde hükmü gereğince dosya UYAP Arabulucu Portal üzerinden yetki itirazı olarak kapatılmış olup, yetki itirazı hakkında gerekli inceleme, değerlendirme ve işlemlerin yapılabilmesi için arabuluculuk dosyasının görevli ve yetkili Sulh Hukuk Mahkemesine sunulmak üzere işbu üst yazı ekinde @ArabuluculukBurosu verilmesi zorunluluğu hasıl olmuştur. @BugunTarih</p>',
            ],
            [
                'document_type_id' => 9,
                'subject_type_id' => 3,
                'result' => '<p class="paragraph">Yukarıda dosya numarası ve taraf bilgileri yazılı uyuşmazlık dosyasında taraflarla ilk oturum @IlkToplantiTarih tarihinde yapılmış, ilk oturumda taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından yetki itirazında bulunulmuştur.</p><p class="paragraph">Taraflardan @BasvuranAdSoyad @BasvuranAvukat tarafından dilekçe halinde sunulan yetki itirazına dayanak olarak @TicaretOdası Ticaret ve Sanayi Odası ‘ndan alınan faaliyet belgesi ve Ticaret Sicil Gazetesi ‘nin @BelgeTarih tarihinde yayımlanan @BelgeSayı sayısının @BelgeSayfa sayfasının çıktısı sunulmuştur. Buna karşılık olarak da başvurucu @BasvuranAdSoyad @BasvuranAvukat tarafından bir dilekçe ile yetki itirazının kabul edilmediği, başvurucunun @ÇalıştığıSüre yıl süreyle @ÇalıştığıYer ‘de çalıştığı bildirilmiştir. Başvurucu @BasvuranAvukat tarafından dilekçe ekinde başvurucu @BasvuranAdSoyad ‘ye ilişkin sigortalılık tescil ve hizmet dökümleri sunulmuştur.</p><p class="paragraph">7036 Sayılı Kanun ‘un 3 maddesinin 9. fıkrasında “Arabulucu, görevlendirmeyi yapan büronun yetkili olup olmadığını kendiliğinden dikkate alamaz. Karşı taraf en geç ilk toplantıda, yerleşim yeri ve işin yapıldığı yere ilişkin belgelerini sunmak suretiyle arabuluculuk bürosunun yetkisine itiraz edebilir. Bu durumda arabulucu, dosyayı derhal ilgili sulh hukuk mahkemesine gönderilmek üzere büroya teslim eder. Mahkeme, harç alınmaksızın dosya üzerinden yapacağı inceleme sonunda yetkili büroyu kesin olarak karara bağlar ve dosyayı büroya iade eder. Mahkeme kararı büro tarafından 11/2/1959 tarihli ve 7201 sayılı Tebligat Kanunu hükümleri uyarınca taraflara tebliğ edilir. Yetki itirazının reddi durumunda aynı arabulucu yeniden görevlendirilir ve onuncu fıkrada belirtilen süreler yeni görevlendirme tarihinden başlar. Yetki itirazının kabulü durumunda ise kararın tebliğinden itibaren bir hafta içinde yetkili büroya başvurulabilir. Bu takdirde yetkisiz büroya başvurma tarihi yetkili büroya başvurma tarihi olarak kabul edilir. Yetkili büro, altıncı fıkra uyarınca arabulucu görevlendirir.” denilmektedir.</p><p class="paragraph">Yine 02.06.2018 tarihli Hukuk Uyuşmazlıklarında Arabuluculuk Kanunu Yönetmeliği ‘nin 25 maddesinin 4. fıkrasında da “Arabulucu, görevlendirmeyi yapan adliye arabuluculuk bürosunun yetkili olup olmadığını kendiliğinden dikkate alamaz. Karşı taraf en geç ilk toplantıda, yerleşim yeri ve işin yapıldığı yere ilişkin belgelerini sunmak suretiyle adliye arabuluculuk bürosunun yetkisine itiraz edebilir. Bu durumda arabulucu, dosyayı derhal ilgili sulh hukuk mahkemesine gönderilmek üzere adliye arabuluculuk bürosuna teslim eder.” şeklinde bir düzenleme mevcuttur.</p><p class="paragraph">İlgili mevzuat hükümleri gereğince dosya UYAP Arabulucu Portal üzerinden yetki itirazı olarak kapatılmış olup, yetki itirazı hakkında gerekli inceleme, değerlendirme ve işlemlerin yapılabilmesi için arabuluculuk dosyasının görevli ve yetkili Sulh Hukuk Mahkemesine sunulmak üzere işbu üst yazı ekinde @ArabuluculukBurosu Arabuluculuk Bürosuna verilmesi zorunluluğu hasıl olmuştur. @BugunTarih</p>',
            ]
        ];

        foreach ($system_categories as $item) {
            Template::create(
                $item
            );
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
