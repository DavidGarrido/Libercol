<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->enum('format', ["image","doc","pdf","url"]);
            $table->enum('type', ["transaccion","perfil","producto","rut","cedula","camara","ref_comercial","ref_personal","ref_bancaria","cer_libertad","balance","tarjeta_profesional","extecto","nit"]);
            $table->string('route');
            $table->text('comment')->nullable();
            $table->string('modeltable_type');
            $table->unsignedBigInteger('modeltable_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
