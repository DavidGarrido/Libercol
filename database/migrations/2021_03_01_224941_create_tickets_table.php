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
        Schema::disableForeignKeyConstraints();

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total');
            $table->bigInteger('utc');
            $table->foreignId('point_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('code');
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
        Schema::dropIfExists('tickets');
    }
}
