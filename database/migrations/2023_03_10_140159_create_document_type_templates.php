<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypeTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type_templates', function (Blueprint $table) {
            $table->id();
            $table->longText("html")->nullable();
            $table->foreignId("document_type_id")->nullable()->constrained("document_types");
            $table->unsignedBigInteger("lawsuit_subject_type_id");
            $table->foreign("lawsuit_subject_type_id")->references("id")->on("lawsuit_subject_types");
            $table->unsignedBigInteger("lawsuit_subject_id")->nullable();
            $table->foreign('lawsuit_subject_id')->references('id')->on('lawsuit_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_type_templates');
    }
}
