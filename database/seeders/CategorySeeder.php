<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Basketball', 'Hockey', 'Football', 'NBA', 'UEFA', 'World cup', 'ŅHL', 'FIFA', 'Euroleague', 'Olympics'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

