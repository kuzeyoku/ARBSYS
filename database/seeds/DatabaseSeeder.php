<?php

use App\CalculationTool;
use App\Models\MinisteriesOpinion;
use Illuminate\Database\Seeder;
use PhpOffice\PhpWord\Media;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LawsuitTypesTableSeeder::class);
        $this->call(CalculationToolsSeeder::class);
        $this->call(LawsuitSubjectTypesTableSeeder::class);
        $this->call(LawsuitSubjectsTableSeeder::class);
        $this->call(LawsuitProcessTypesTableSeeder::class);
        $this->call(LawsuitResultTypesTableSeeder::class);
        $this->call(LetterOptionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SideTypesSeeder::class);
        $this->call(SideApplicantTypesSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(NotificationCategoriesSeeder::class);
        $this->call(TaxOfficeSeeder::class);
        $this->call(SystemRequestCategoriesSeeder::class);
        $this->call(MediationCenterSeeder::class);
        $this->call(BarolarTableSeeder::class);
        $this->call(TradeRegistrySeeder::class);
        $this->call(PersonTypesSeeder::class);
        $this->call(DocumentTypeTemplatesTableSeeder::class);
        $this->call(MinisteriesOpinionsSeeder::class);
        $this->call(MediationOfficesSeeder::class);
    }
}
