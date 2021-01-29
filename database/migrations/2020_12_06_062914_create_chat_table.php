<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('sender')->nullable();
            $table->dateTime('start_conversation')->nullable();
            $table->dateTime('end_conversation')->nullable();
            $table->integer('state')->nullable();
            $table->string('status')->nullable();
            $table->string('history')->nullable();
            $table->string('nip')->nullable();
            $table->string('permasalahan')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('is_autoclose')->nullable();
            $table->integer('chat_kategori')->nullable();
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
        Schema::dropIfExists('chat');
    }
}
