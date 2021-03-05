<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tel')->nullable();
            $table->bigInteger('cel_one')->nullable();
            $table->bigInteger('cel_two')->nullable();
            $table->bigInteger('whatsapp')->nullable();
            $table->bigInteger('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->foreignId('address_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('contacts');
    }
}
