<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'user_id' => 1,
            'name_category' => 'Hortifruti'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Açougue'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Padaria'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Bebidas'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Mercearia'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Frios e Laticínios'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Categoria 7'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Categoria 8'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Categoria 9'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Categoria 10'
        ]);

        Category::create([
            'user_id' => 1,
            'name_category' => 'Categoria 11'
        ]);
    }
}
