<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('inventaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('point_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('units')->default('1');
            $table->integer('max')->nullable();
            $table->integer('min')->default('1');
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
        Schema::dropIfExists('inventaries');
    }
}
