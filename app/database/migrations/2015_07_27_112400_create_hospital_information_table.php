<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'hospital_information', function( $table ){
			$table->increments( 'id' );
			$table->string( 'title' );
			$table->string( 'image' );
			$table->datetime( 'time' );
			$table->text( 'content' );
			$table->boolean( 'is_new' )->default( true );
			$table->integer( 'hospital_id' )->unsigned();
			$table->timestamps();

			$table->index( 'hospital_id' );
			$table->foreign( 'hospital_id' )
				  ->references( 'id' )
				  ->on( 'hospitals' )
				  ->onDelete( 'cascade' )
				  ->onUpdate( 'cascade' );
		}); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists( 'hospital_information' );
	}

}
