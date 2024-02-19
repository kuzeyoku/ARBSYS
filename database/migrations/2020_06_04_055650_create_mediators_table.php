<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("identification")->nullable();
            $table->integer('registration_no')->nullable();
            $table->string('iban')->nullable();
            $table->unsignedBigInteger('letter_option_id')->default(LetterOptions::STANDARD);
            $table->foreign('letter_option_id')->references('id')->on('letter_options');
            $table->string('letter_logo')->nullable();
            $table->string('letter_top')->nullable();
            $table->string('letter_bottom')->nullable();
            $table->integer("mediation_center_id")->nullable();
            $table->string('meeting_address')->nullable();
            $table->boolean('meeting_address_proposal')->nullable()->default(false);
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
        Schema::dropIfExists('mediators');
    }
}
