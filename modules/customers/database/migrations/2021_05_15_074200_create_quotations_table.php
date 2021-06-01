<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->json('items')->nullable();
            $table->decimal('total_amount',20,2)->nullable();
            $table->float('discount')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
