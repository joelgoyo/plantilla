<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('usuario al que le pertenece la wallet');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('referred_id')->unsigned()->nullable();
            $table->foreign('referred_id')->references('id')->on('users')->onUpdate('cascade')->nullable();
            $table->foreignId('inversion_id')->nullable()->constrained('inversions')->comment('inversion la cual produce esta wallet');
            $table->double('amount')->nullable();
            $table->double('amount_fondo')->nullable();
            $table->double('percentage')->nullable();
            $table->bigInteger('liquidation_id')->unsigned()->nullable();
            $table->string('descripcion');
            $table->string('wallet_usd')->nullable();
            $table->string('code_security')->nullable();
            $table->tinyInteger('option')->default(0)->comment('0 - desmarcada, 1 - marcada');
            $table->tinyInteger('tipo_transaction')->default(0)->comment('0 - comision, 1 - retiro');
            $table->tinyInteger('type')->nullable()->comment('0 - Bono Inicio nivel 1, 1 - Bono Recompra, 2 - Bono Cartera, 3 - rendimiento, 4 - operador bonos, 5 - Pago rentabilidad, 6 - Bono inicio nivel 2"');
            $table->tinyInteger('status')->default(0)->comment('0 - En espera, 1 - Pagado (liquidado), 2 - Cancelado');
            $table->tinyInteger('liquidado')->default(0)->comment('0 - sin liquidar, 1 - liquidado');
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
        Schema::dropIfExists('wallets');
    }
}
