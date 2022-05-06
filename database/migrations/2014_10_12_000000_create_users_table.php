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
            $table->id();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('admin', [0, 1])->default(0)->comment('permite saber si un usuario es admin o no');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - inactivo, 1 - activo, 2 - eliminado');
            $table->date('date_activo')->nullable();
            $table->bigInteger('referred_id')->nullable()->comment('ID del usuario patrocinador');
            $table->foreignId('countrie_id')->nullable()->constrained('countries')->comment('el id del pais del usuario');
            $table->foreignId('prefix_id')->nullable()->constrained('prefixes')->comment('el id del prefijo del tlf');
            $table->string('birthdate')->nullable()->comment('Fecha de nacimiento del usuario');
            $table->string('identification_document')->nullable()->unique()->comment('identificacion del usuario');
            $table->string('type_document')->nullable()->comment(' tipo de identificacion del usuario');
            $table->string('gender')->nullable()->comment('genero del usuario');
            $table->string('phone')->nullable();
            $table->string('direction')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('city')->nullable();
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
