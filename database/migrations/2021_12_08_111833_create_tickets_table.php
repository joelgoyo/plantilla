<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->boolean('categories', [0, 1, 2, 3, 4, 5])->default(0)->comment('0 - Ayuda, 1 - Soporte técnico, 2 - , 3 - Corrección de datos, 4 - Bonos, 5 - Inversión total');
            $table->boolean('priority', [0, 1, 2])->default(2)->comment('0 - Alta, 1 - Media, 2 - Baja');
            $table->boolean('status', [0, 1])->default(0)->comment('0 - Abierto, 1 - Cerrado');
            $table->longtext('issue');
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
        Schema::dropIfExists('tickets');
    }
}
