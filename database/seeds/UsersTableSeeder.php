<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\User;
class UsersTableSeeder extends Seeder
{
	public function run()
	{
        // TestDummy::times(20)->create('App\Post');

		$faker = Faker\Factory::create();

		$limit = 10;
		User::create([
			'name'=>"Nguyễn Văn Hiệp",
			'email'=>"Nguyenhiepvan.bka@gmail.com",
			'password'=>\Hash::make('12345678')
		]);
		for ($i = 0; $i < $limit; $i++) {
			User::create([
				'name'=>$faker->name,
				'email'=>$faker->email,
				'password'=>\Hash::make('12345678')
			]);
		}
	}
}
