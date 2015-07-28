<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'register_records', function( $table ){
			$table->increments( 'id' );
			$table->date( 'date' );
			$table->time( 'start_time' );
			$table->time( 'end_time' );
			$table->integer( 'status' );
			$table->text( 'advice' );
			$table->date( 'return_date' );
			$table->integer( 'doctor_id' )->unsigned();

			$table->index( 'doctor_id' );
			$table->foreign( 'doctor_id' )
				  ->references( 'id' )->on( 'doctors' )
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
		Schema::drop( '' );
	}

}
