<?php

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
            $table->bigIncrements('id');
            $table->boolean('is_admin')->default(false);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('email', 191)->unique();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('phone_number')->nullable();
            $table->json('settings')->nullable();
            $table->string('password', 255);
            $table->string('recovery_token', 255)->nullable();
            $table->string('otp', 255);
            $table->dateTime('otp_expires_at')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->dateTime('suspended_at')->nullable();
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
}
