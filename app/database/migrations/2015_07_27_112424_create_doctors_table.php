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
			$table->string( 'specialty' )->nullable();
			$table->text( 'description' )->nullable();
			$table->boolean( 'is_chief' )->default( false );
			$table->boolean( 'is_consultable' )->default( true );
			$table->integer( 'title_id')->unsigned();
			$table->integer( 'department_id' )->unsigned();
			$table->timestamps();

			$table->index( 'title_id' );
			$table->foreign( 'title_id' )
				  ->references( 'id' )
				  ->on( 'titles' )
				  ->onDelete( 'cascade' )
				  ->onUpdate( 'cascade' );

			$table->index( 'department_id' );
			$table->foreign( 'department_id' )
				  ->references( 'id' )
				  ->on( 'departments' )
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
		Schema::dropIfExists( 'doctors' );
	}

}
