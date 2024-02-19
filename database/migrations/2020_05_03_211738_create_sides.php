<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawsuit_id');
            $table->unsignedBigInteger('side_type_id');
            $table->unsignedBigInteger('side_applicant_type_id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('lawyer_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->timestamps();

            $table->foreign('lawsuit_id')->references('id')->on('lawsuits')->onDelete('cascade');
            $table->foreign('side_type_id')->references('id')->on('side_types');
            $table->foreign('side_applicant_type_id')->references('id')->on('side_applicant_types');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('lawyer_id')->references('id')->on('lawyers');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('parent_id')->references('id')->on('sides')->onDelete('cascade'); // cascade delete children when deleting parent
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sides');
    }
}
