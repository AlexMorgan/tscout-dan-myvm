<?php

class UserSeeder extends DatabaseSeeder {

	public function run()
	{
	
		$users = [
			[
				"username" => "christopher.pitt",
				"password" => Hash::make('hello'),
				"email"    => "chris@example.com"
			] 
		];

		foreach ($users as $user)
		{
			User::create($user);
		}
		
	}

}