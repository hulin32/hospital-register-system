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
			$table->integer( 'record_id' )->unsigned();
			$table->timestamps();

			$table->index( 'record_id');
			$table->foreign( 'record_id' )
				  ->references( 'id' )
				  ->on( 'register_records' )
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
