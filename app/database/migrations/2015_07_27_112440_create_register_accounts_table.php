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
			$table->integer( 'weight' );
			$table->integer( 'gender' );
			$table->string( 'blood_type' );
			$table->string( 'type' )->nullable();
			$table->string( 'phone' );
			$table->string( 'id_card' );
			$table->string( 'emergency_name' );
			$table->string( 'emergency_phone' );
			$table->integer( 'user_id' )->unsigned();
			$table->timestamps();

			$table->index( 'id_card' );
			$table->index( 'phone' );

			$table->index( 'user_id' );
			$table->foreign( 'user_id' )
				  ->references( 'id' )->on( 'users' )
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
		Schema::drop( 'register_accounts' );
	}

}
