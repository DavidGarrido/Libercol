<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('userdatas', function (Blueprint $table) {
            $table->id();
            $table->integer('stature')->nullable();
            $table->integer('weight')->nullable();
            $table->string('size');
            $table->enum('gender', ["masculino","femenino"]);
            $table->enum('type_document', ["cc","ce","ti","rc","pp"])->nullable();
            $table->bigInteger('number_document')->nullable();
            $table->string('modeltable_type')->nullable();
            $table->unsignedBigInteger('modeltable_id')->nullable();
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
        Schema::dropIfExists('userdatas');
    }
}
