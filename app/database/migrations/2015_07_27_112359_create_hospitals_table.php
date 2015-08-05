<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'hospitals', function( $table ){
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->string( 'address' );
			$table->string( 'phone' );
			$table->string( 'logo' )->nullable();
			$table->string( 'photo' )->nullable();
			$table->time( 'register_start' )->nullable();
			$table->time( 'register_stop' )->nullable();
			$table->text( 'specialty' )->nullable();
			$table->text( 'description' )->nullable();
			$table->text( 'traffic_intro' )->nullable();
			$table->text( 'traffic_guide' )->nullable();
			$table->float( 'longtitude' )->nullable();
			$table->float( 'latitude' )->nullable();
			$table->timestamps();

			$table->index( 'name' );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists( 'hospitals' );
	}

}
