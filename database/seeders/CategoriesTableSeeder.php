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
            'name_categorie' => 'Hortifruti'
        ]);

        Category::create([
            'name_categorie' => 'Açougue'
        ]);

        Category::create([
            'name_categorie' => 'Padaria'
        ]);

        Category::create([
            'name_categorie' => 'Bebidas'
        ]);

        Category::create([
            'name_categorie' => 'Mercearia'
        ]);

        Category::create([
            'name_categorie' => 'Frios e Laticínios'
        ]);

        Category::create([
            'name_categorie' => 'Categoria 7'
        ]);

        Category::create([
            'name_categorie' => 'Categoria 8'
        ]);

        Category::create([
            'name_categorie' => 'Categoria 9'
        ]);

        Category::create([
            'name_categorie' => 'Categoria 10'
        ]);

        Category::create([
            'name_categorie' => 'Categoria 11'
        ]);
    }
}
