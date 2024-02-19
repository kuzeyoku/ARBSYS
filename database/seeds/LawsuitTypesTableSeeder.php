<?php


use App\Models\Lawsuit\LawsuitType;
use Illuminate\Database\Seeder;

class LawsuitTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawsuit_types = [
            ['name' => 'Dava şartı arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak Adliye Arabuluculuk Bürosu tarafından görevlendirildim.'],
            ["name" => "İhtiyari arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak Adliye Arabuluculuk Bürosu tarafından görevlendirildim."],
            ["name" => "Dava şartı arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak taraflarca seçildim."],
            ["name" => "İhtiyari arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak taraflarca seçildim."],
            ["name" => "Dava şartı arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak Arabuluculuk Merkezi tarafından görevlendirildim."],
            ["name" => "İhtiyari arabuluculuk kapsamındaki bir uyuşmazlıkla ilgili olarak Arabuluculuk Merkezi tarafından görevlendirildim."],
        ];

        foreach ($lawsuit_types as $name) {
            LawsuitType::create(
                $name
            );
        }
    }
}
