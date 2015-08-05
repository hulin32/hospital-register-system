<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'departments', function( $table ){
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->string( 'photo' );
			$table->string( 'icon' );
			$table->text( 'description' );
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
		Schema::dropIfExists( 'departments' );
	}

}
