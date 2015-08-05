<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'schedules', function( $table ){
			$table->increments( 'id' );
			$table->date( 'date' );
			$table->integer( 'period' );
			$table->integer( 'doctor_id' )->unsigned();
			$table->timestamps();

			$table->index( 'doctor_id' );
			$table->foreign( 'doctor_id' )
				  ->references( 'id' )
				  ->on( 'doctors' )
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists( 'schedules' );
	}

}
