<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call("UserSeeder");
		$this->call("ProfilesTableSeeder");
		// $this->call('UserTableSeeder');
		$this->call('FriendsTableSeeder');
		$this->call('ActivitiesTableSeeder');
	}

}