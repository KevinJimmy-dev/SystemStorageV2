<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name_category' => 'Hortifruti'
        ]);

        Category::create([
            'name_category' => 'Açougue'
        ]);

        Category::create([
            'name_category' => 'Padaria'
        ]);

        Category::create([
            'name_category' => 'Bebidas'
        ]);

        Category::create([
            'name_category' => 'Mercearia'
        ]);

        Category::create([
            'name_category' => 'Frios e Laticínios'
        ]);

        Category::create([
            'name_category' => 'Categoria 7'
        ]);

        Category::create([
            'name_category' => 'Categoria 8'
        ]);

        Category::create([
            'name_category' => 'Categoria 9'
        ]);

        Category::create([
            'name_category' => 'Categoria 10'
        ]);

        Category::create([
            'name_category' => 'Categoria 11'
        ]);
    }
}
