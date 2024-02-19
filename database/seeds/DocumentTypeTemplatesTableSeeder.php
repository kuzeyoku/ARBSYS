<?php

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentTypes = [1, 2, 3, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
        $lawsuitSubjectTypes = [1, 2, 3, 4, 5];

        foreach ($documentTypes as $dtype) {
            foreach ($lawsuitSubjectTypes as $lstype) {
                $data = [
                    "document_type_id" => $dtype,
                    "lawsuit_subject_type_id" => $lstype,
                    "lawsuit_subject_id" => null,
                    "html"  => null
                ];

                DB::table('document_type_templates')->insert($data);
            }
        }

        $documentTypes = [4, 5];
        LawsuitSubject::all()->each(function ($lawsuitSubject) use ($documentTypes) {
            foreach ($documentTypes as $dtype) {
                $data = [
                    "document_type_id" => $dtype,
                    "lawsuit_subject_type_id" => $lawsuitSubject->lawsuit_subject_type_id,
                    "lawsuit_subject_id" => $lawsuitSubject->id,
                    "html"  => null
                ];

                DB::table('document_type_templates')->insert($data);
            }
        });
    }
}
