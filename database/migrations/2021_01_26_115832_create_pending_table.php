<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending', function (Blueprint $table) {
            $table->id();
            $table->integer('tiket_id');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('reason')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('action_by')->nullable();
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
        Schema::dropIfExists('pending');
    }
}
