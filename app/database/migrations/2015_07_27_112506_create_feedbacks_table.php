<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'feedbacks', function( $table ){
			$table->increments( 'id' );
			$table->string( 'title' );
			$table->string( 'content' );
			$table->integer( 'user_id' )->unsigned();
			$table->timestamps();

			$table->index( 'user_id' );
			$table->foreign( 'user_id' )
				  ->references( 'id' )
				  ->on( 'users' )
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
		Schema::dropIfExists( 'feedbacks' );
	}

}
