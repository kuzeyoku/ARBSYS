<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string("borndate", 100)->nullable();
            $table->string("gender", 20)->nullable();
            $table->string('email', 191)->nullable()->unique();
            $table->string('request_email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean("change_request")->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('reject_description')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade'); // Kullanici bilgileri guncelleme parent ile yapilir.
            $table->rememberToken();
            $table->string('end', 255)->default(Carbon::now()->format("d-m-Y"));
            $table->integer('restriction')->default(0);
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
        Schema::dropIfExists('users');
    }
}
