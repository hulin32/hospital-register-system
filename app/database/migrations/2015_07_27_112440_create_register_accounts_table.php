<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'register_accounts', function( $table ){
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->integer( 'age' );
			$table->integer( 'gender' );
			$table->float( 'weight' );
			$table->string( 'blood_type' );
			$table->string( 'phone' );
			$table->string( 'id_card' );
			$table->string( 'type' )->nullable();
			$table->string( 'emergency_name' )->nullable();
			$table->string( 'emergency_phone' )->nullable();
			$table->integer( 'user_id' )->unsigned();
			$table->timestamps();

			$table->index( 'phone' );
			$table->unique( 'id_card' );
			
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
		Schema::dropIfExists( 'register_accounts' );
	}

}
