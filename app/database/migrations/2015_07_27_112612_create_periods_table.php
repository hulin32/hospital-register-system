<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'periods', function( $table ){
			$table->increments( 'id' );
			$table->time( 'start' );
			$table->time( 'end' );
			$table->integer( 'total')->unsigned();
			$table->integer( 'current' )->unsigned();
			$table->integer( 'schedule_id' )->unsigned();
			$table->timestamps();

			$table->index( 'schedule_id' );
			$table->foreign( 'schedule_id' )
				  ->references( 'id' )
				  ->on( 'schedules' )
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
		Schema::dropIfExists( 'periods' );
	}

}
