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
			$table->time( 'start' );
			$table->time( 'end' );
			$table->integer( 'period' );
			$table->integer( 'status' );
			$table->text( 'advice' )->nullable();
			$table->date( 'return_date' )->nullable();
			$table->integer( 'doctor_id' )->unsigned();
			$table->integer( 'account_id' )->unsigned();
			$table->timestamps();

			$table->index( 'doctor_id' );
			$table->foreign( 'doctor_id' )
				  ->references( 'id' )
				  ->on( 'doctors' )
				  ->onDelete( 'cascade' )
				  ->onUpdate( 'cascade' );

			$table->index( 'account_id' );
			$table->foreign( 'account_id' )
				  ->references( 'id' )
				  ->on( 'register_accounts' )
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
		Schema::dropIfExists( 'register_records' );
	}

}
