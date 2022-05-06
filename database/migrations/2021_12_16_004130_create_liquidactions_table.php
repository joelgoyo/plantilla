<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->foreign('iduser')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('inversion_id')->unsigned()->nullable();
            $table->foreign('inversion_id')->references('id')->on('inversions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('referencia')->nullable();
            $table->double('total');
            $table->double('monto_bruto');
            $table->double('feed');
            $table->string('hash')->nullable();
            $table->string('wallet_used')->nullable();
            $table->string('code_correo')->nullable();
            $table->dateTime('fecha_code')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0 - Comisiones. 1 - Capital');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('liquidactions');
    }
}
