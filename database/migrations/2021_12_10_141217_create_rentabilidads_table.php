<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentabilidads', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('user_id')->nullable();
            $table->double('gain')->nullable();
            //$table->bigInteger('inversion_id')->nullable();
            $table->tinyInteger('status')->comment('0 - En Espera. 1- Pagada, 2 - Reinvertida');
            $table->double('percentage');
            $table->date('payment_date');
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
        Schema::dropIfExists('rentabilidads');
    }
}
