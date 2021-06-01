<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('full_name',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->text('street_address')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('leads');
    }
}
