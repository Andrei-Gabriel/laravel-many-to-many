<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Antipasti", "Primi", "Secondi", "Contorni", "Dolci", "Bevande"];

        foreach($categories as $category) {
            $newCatogery = new Category();
            $newCatogery->name = $category;
            $newCatogery->slugCat = Str::of($newCatogery->name)->slug("-");
            $newCatogery->save();
        }
    }
}
