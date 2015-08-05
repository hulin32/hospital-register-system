<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'comments', function( $table ){
			$table->increments( 'id' );
			$table->text( 'content' );
			$table->integer( 'user_id' )->unsigned();
			$table->integer( 'record_id' )->unsigned();
			$table->integer( 'doctor_id' )->unsigned();
			$table->timestamps();

			$table->index( 'user_id' );
			$table->foreign( 'user_id' )
				  ->references( 'id' )
				  ->on( 'users' )
				  ->onDelete( 'cascade' )
				  ->onUpdate( 'cascade' );

			$table->index( 'record_id');
			$table->foreign( 'record_id' )
				  ->references( 'id' )
				  ->on( 'register_records' )
				  ->onDelete( 'cascade' )
				  ->onUpdate( 'cascade' );

			$table->index( 'doctor_id' );
			$table->foreign( 'doctor_id' )
				  ->references( 'id' )
				  ->on( 'doctors' )
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
		Schema::dropIfExists( 'comments' );
	}

}
