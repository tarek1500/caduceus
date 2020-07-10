<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_profiles', function (Blueprint $table) {
			$table->id();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->date('birthdate')->nullable();
			$table->tinyInteger('gender')->default(0);
			$table->string('country')->nullable();
			$table->text('occupation')->nullable();
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
		Schema::dropIfExists('patient_profiles');
	}
}