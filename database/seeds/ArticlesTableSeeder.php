<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\Article;
class ArticlesTableSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create();

		$limit = 10;

		for ($i = 0; $i < $limit; $i++) {
			Article::create([
				'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
				'slug'=>$faker->slug(),
				'thumbnail'=>$faker->imageUrl($width = 640, $height = 480),
				'content'=>$faker->text($maxNbChars = 200)
			]);
		}
	}
}
