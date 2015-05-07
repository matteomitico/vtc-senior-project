<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVmTable extends Migration {

	//creates user, vm, user-vm tables

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('email', 127);
            $table->unique('email');
            $table->string('username', 63);
            $table->unique('username');
            $table->string('password', 63);
            $table->string('first_name', 127);
            $table->string('last_name', 127);
            $table->boolean('admin')->default(false);
            $table->boolean('active');
            $table->string('settings');
          	$table->string('remember_token', 100)->nullable();			// required for Laravel 4.1.26
			$table->timestamps();
		});
                
                Schema::create('vm', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('name', 127);
                        $table->unique('name');
                        $table->string('settings');
			$table->timestamps();
		});
                
                Schema::create('user_vm', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
                        $table->foreign('user_id')
                                ->references('id')->on('user')
                                ->onDelete('cascade');
                        $table->integer('vm_id')->unsigned();
                        $table->foreign('vm_id')
                                ->references('id')->on('vm')
                                ->onDelete('cascade');
                        $table->primary(array('user_id', 'vm_id'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
		Schema::drop('vm');
		Schema::drop('user_vm');
	}

}
