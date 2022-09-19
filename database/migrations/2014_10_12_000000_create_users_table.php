<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_level');
            $table->string('name');
            $table->string('password');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('nomor_kwh');
            $table->foreignId('id_tarif');
            $table->rememberToken();
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
};
