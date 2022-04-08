<?php

namespace Database\Seeders;

use App\Models\Categorie;
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
        Categorie::create([
            'name_categorie' => 'Hortifruti'
        ]);

        Categorie::create([
            'name_categorie' => 'Açougue'
        ]);

        Categorie::create([
            'name_categorie' => 'Padaria'
        ]);

        Categorie::create([
            'name_categorie' => 'Bebidas'
        ]);

        Categorie::create([
            'name_categorie' => 'Mercearia'
        ]);

        Categorie::create([
            'name_categorie' => 'Frios e Laticínios'
        ]);

        Categorie::create([
            'name_categorie' => 'Categoria 7'
        ]);

        Categorie::create([
            'name_categorie' => 'Categoria 8'
        ]);

        Categorie::create([
            'name_categorie' => 'Categoria 9'
        ]);

        Categorie::create([
            'name_categorie' => 'Categoria 10'
        ]);

        Categorie::create([
            'name_categorie' => 'Categoria 11'
        ]);
    }
}
