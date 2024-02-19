<?php

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LawsuitSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('lawsuit_subjects')->truncate();
        $lawsuit_subjects = [
            ['lawsuit_subject_type_id' => 1, 'name' => 'Mal Rejiminin Tasfiyesi Hk.'],
            ['lawsuit_subject_type_id' => 1, 'name' => 'Yoksulluk Nafakası Hk.'],
            ['lawsuit_subject_type_id' => 1, 'name' => 'Diğer Talepler'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Banka ve Finans Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Aşkın Sigorta Uygulamasından Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'İnşaat Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Fikri ve Sınai Haklar Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Enerji Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Spor Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Sağlık Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Cari Hesaptan Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Eser Sözleşmesinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Hakimiyetin Hukuka Aykırı Kullanılması Nedeniyle Tazminat Talebinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'İtirazın İptali Talebinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Kambiyo Senedinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Menfi Tesbit Talebinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Sigorta Hukuku – Cismani Zarar Tazmini Talebinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Portföy Tazminatı Talebi Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Taşımacılık Sözleşmesinden Kaynaklanan Uyuşmazlıklar Hk.'],
            ['lawsuit_subject_type_id' => 2, 'name' => 'Diğer Talepler Hk.'],
            ['lawsuit_subject_type_id' => 3, 'name' => 'İşçilik Alacakları ve Tazminatları Hk.', "matters_discussed" => json_encode([
                1 => "Ayrımcılık Tazminatı Alacağı",
                2 => "Asgari Geçim İndirimi (AGİ) Alacağı",
                3 => "Bakiye Süre Ücret Alacağı",
                4 => "Cezai Şart Alacağı",
                5 => "Çocuk Parası Alacağı",
                6 => "Eğitim Yardımı Alacağı",
                7 => "Fazla Çalışma Ücreti Alacağı",
                8 => "Gece Vardiyası Zammı Alacağı",
                9 => "Gemiadamı İaşe Bedeli Alacağı",
                10 => "Hafta Tatili Ücreti Alacağı",
                11 => "Haksız Fesih Tazminatı Alacağı",
                12 => "İhbar Tazminatı Alacağı",
                13 => "İlave Tediye Alacağı",
                14 => "İş Arama İzni Ücreti Alacağı",
                15 => "İşe İade Sonrası Boşta Geçen Süre Alacağı",
                16 => "İşe Başlatmama Tazminatı Alacağı",
                17 => "Kıdem Tazminatı Alacağı",
                18 => "Kötü niyet Tazminatı Alacağı",
                19 => "Manevi Tazminat Alacağı",
                20 => "Ölüm Tazminatı Alacağı",
                21 => "Prim/ikramiye Alacağı",
                22 => "Sendikal Tazminat Alacağı",
                23 => "Toplu İş Söz. Kaynaklı Alacaklar",
                24 => "Transfer Ücreti Alacağı",
                25 => "Ulusal Bayram ve Genel Tatil Ücreti",
                26 => "Ücret (Maaş) Alacağı",
                27 => "Yıllık Ücretli İzin Alacağı",
                28 => "Yarım Ücret Alacağı",
                29 => "Yol Parası Alacağı",
            ])],
            ['lawsuit_subject_type_id' => 3, 'name' => 'İşe İade Talebi Hk.'],
            ['lawsuit_subject_type_id' => 3, 'name' => 'Diğer Talepler'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Banka ve Finans Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'İnşaat Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Enerji Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Fikri ve Sınai Haklar Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Spor Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Sağlık Hukuku Uyuşmazlığı Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'İtirazın İptali Talebi Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Vekalet Sözleşmeleri Hk.'],
            ['lawsuit_subject_type_id' => 4, 'name' => 'Diğer Talepler'],
            ["lawsuit_subject_type_id" => 5, "name" => "Kira Hukukundan Kaynaklanan Uyuşmazlıklar"],
            ["lawsuit_subject_type_id" => 5, "name" => "Komşuluk Hukukundan Kaynaklanan Uyuşmazlıklar"],
            ["lawsuit_subject_type_id" => 5, "name" => "Kat Mülkiyeti Kanunundan Kaynaklanan Uyuşmazlıklar"],
            ["lawsuit_subject_type_id" => 6, "name" => "Taşınır ve Taşınmazların Paylaştırılmasına ve Ortaklığın Giderilmesine İlişkin Uyuşmazlıklar"],
            ['lawsuit_subject_type_id' => 7, 'name' => 'Diğer Uyuşmazlıklar Hk.']
        ];
        foreach ($lawsuit_subjects as $subject) {
            LawsuitSubject::create(
                $subject
            );
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
