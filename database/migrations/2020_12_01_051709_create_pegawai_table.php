<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePegawaiTable extends Migration {

	public function up()
	{
		Schema::create('pegawai', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('	name')->nullable();
			$table->string('nip')->nullable();
			$table->string('username')->nullable();
			$table->string('personnel_area')->nullable();
			$table->string('personnel_subarea')->nullable();
			$table->string('personnel_area_name')->nullable();
			$table->string('personnel_subarea_name')->nullable();
			$table->string('position')->nullable();
			$table->string('email')->nullable();
			$table->string('sender')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('pegawai');
		Schema::dropIfExists('saran');
	}
}