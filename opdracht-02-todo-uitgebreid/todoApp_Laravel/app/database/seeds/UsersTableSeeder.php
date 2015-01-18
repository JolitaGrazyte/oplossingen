<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		
		DB::table('users')->truncate();

		$users = array(
			array('email' => 'hello@jolita.be', 
			'password' => Hash::make('secret') )
		

		 	);
		 DB::table('users')->insert($users);


	}

}