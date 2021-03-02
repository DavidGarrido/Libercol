<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletmovimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('walletmoviments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('value');
            $table->bigInteger('interest');
            $table->bigInteger('utc_start')->nullable();
            $table->bigInteger('utc_end')->nullable();
            $table->enum('type', ["inc","dec"]);
            $table->enum('state', ["aprobado","desaprobado"]);
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('walletmoviments');
    }
}
