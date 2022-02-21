<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
// Per usare la funzione slug()
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $newPost = new Post();
            $newPost->title = $faker->words(7, true);
            $newPost->slug = Str::of($newPost->title)->slug("-"); // Separatore a nostra scelta
            $newPost->content = $faker->text(600);
            $newPost->published = rand(0,1);
            $newPost->save();
        }
    }
}
