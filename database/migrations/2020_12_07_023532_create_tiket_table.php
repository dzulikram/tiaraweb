<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('sender')->nullable();
            $table->dateTime('start_conversation')->nullable();
            $table->dateTime('end_conversation')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('assignment_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('state')->nullable();
            $table->string('status')->nullable();
            $table->string('history')->nullable();
            $table->string('no_tiket')->nullable();
            $table->integer('chat_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('status_tiket')->nullable();
            $table->string('it_support')->nullable();
            $table->string('permasalahan')->nullable();
            $table->integer('kategori_id')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('is_autoclose')->nullable();
            $table->string('call_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket');
    }
}
