<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawsuit_id');
            $table->unsignedBigInteger('document_type_id');
            $table->string('name')->nullable();
            $table->longText('html');
            $table->integer("side_id")->nullable();
            $table->unsignedBigInteger('created_user_id');
            $table->timestamps();
            $table->foreign('lawsuit_id')->references('id')->on('lawsuits');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('created_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
