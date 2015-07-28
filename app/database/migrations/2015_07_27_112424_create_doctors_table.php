<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'doctors', function( $table ){
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->string( 'photo' );
			$table->string( 'title' );
			$table->string( 'specialty' )->nullable();
			$table->text( 'description' )->nullable();
			$table->boolean( 'is_chief' )->default( false );
			$table->boolean( 'is_consultable' )->default( true );
			$table->integer( 'hospital_id' )->unsigned();

			$table->index( 'hospital_id' );
			$table->foreign( 'hospital_id' )
				  ->references( 'id' )->on( 'hospitals' )
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
		Schema::drop( 'doctors' );
	}

}
