<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogRentabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_rentabilidads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inversion_id')->constrained('inversions');
            $table->foreignId('wallet_id')->nullable()->constrained('wallets');
            $table->foreignId('rentabilidad_id')->nullable()->constrained('rentabilidads');
            $table->double('amount');
            $table->double('percentage');
            $table->date('payment_date');
            $table->double('previoues_capital');
            $table->double('current_capital');
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
        Schema::dropIfExists('log_rentabilidads');
    }
}
