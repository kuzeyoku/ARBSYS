<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawsuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawsuits', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_by')->nullable();
            $table->unsignedBigInteger('lawsuit_type_id')->constrained()->nullable();
            $table->unsignedBigInteger('lawsuit_subject_type_id')->constrained()->nullable();
            $table->unsignedBigInteger('lawsuit_subject_id')->constrained()->nullable();
            $table->unsignedBigInteger('mediation_office_id')->constrained()->nullable();
            $table->unsignedBigInteger("mediation_center_id")->nullable();
            $table->unsignedBigInteger('lawsuit_process_type_id')->constrained();
            $table->unsignedBigInteger('lawsuit_result_type_id')->constrained()->nullable();
            $table->unsignedBigInteger("agreement_type_id")->constrained()->nullable();
            $table->string('udf_subject')->nullable();
            $table->string('application_document_no')->nullable();
            $table->string('mediation_document_no')->nullable();
            $table->date('application_date')->nullable();
            $table->date('process_start_date')->nullable();
            $table->date('job_date')->nullable();
            $table->date('result_date')->nullable();
            $table->longText('matters_discussed')->nullable();
            $table->boolean('is_archive')->default(false)->nullable();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lawsuits');
    }
}
