<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallettypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('wallettypes', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ["efectivo","ahorros","daviplata","nequi","movi","ticket","credito"]);
            $table->foreignId('bank_id')->nullable()->constrained()->cascadeOnDelete();
            $table->bigInteger('limit')->nullable();
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
        Schema::dropIfExists('wallettypes');
    }
}
