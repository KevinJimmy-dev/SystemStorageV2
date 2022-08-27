<?php

namespace Database\Seeders;


use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Batata',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Kg',
            'quantity' => '35',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'batatinhas frescas',
        ]);

        Product::create([
            'name' => 'Leite',
            'user_id' => 1,
            'category_id' => 6,
            'storage_unity' => 'L',
            'quantity' => '25',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'Desnatado',
        ]);

        Product::create([
            'name' => 'Pão Francês',
            'user_id' => 1,
            'category_id' => 3,
            'storage_unity' => 'Un',
            'quantity' => '100',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Kiwi',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Kg',
            'quantity' => '15',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Carne bovina',
            'user_id' => 1,
            'category_id' => 2,
            'storage_unity' => 'Kg',
            'quantity' => '10',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Carne suína',
            'user_id' => 1,
            'category_id' => 2,
            'storage_unity' => 'Kg',
            'quantity' => '15',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Frango',
            'user_id' => 1,
            'category_id' => 2,
            'storage_unity' => 'Kg',
            'quantity' => '20',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Apresuntado',
            'user_id' => 1,
            'category_id' => 6,
            'storage_unity' => 'Kg',
            'quantity' => '5',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Presunto',
            'user_id' => 1,
            'category_id' => 6,
            'storage_unity' => 'Kg',
            'quantity' => '3',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'Marca: Seara',
        ]);

        Product::create([
            'name' => 'Mussarela',
            'user_id' => 1,
            'category_id' => 6,
            'storage_unity' => 'Kg',
            'quantity' => '3',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'Marca: Seara',
        ]);

        Product::create([
            'name' => 'Mortandela',
            'user_id' => 1,
            'category_id' => 3,
            'storage_unity' => 'Kg',
            'quantity' => '7',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'Sem gordura, fatiada',
        ]);

        Product::create([
            'name' => 'Abacate',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Kg',
            'quantity' => '2',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Banana',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Kg',
            'quantity' => '4',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => 'Nanica',
        ]);

        Product::create([
            'name' => 'Tomate',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Kg',
            'quantity' => '2',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Leite condensado',
            'user_id' => 1,
            'category_id' => 7,
            'storage_unity' => 'Un',
            'quantity' => '20',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Repolho',
            'user_id' => 1,
            'category_id' => 1,
            'storage_unity' => 'Un',
            'quantity' => '20',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Carne moida',
            'user_id' => 1,
            'category_id' => 2,
            'storage_unity' => 'Kg',
            'quantity' => '5',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Chocolate em barra',
            'user_id' => 1,
            'category_id' => 5,
            'storage_unity' => 'Un',
            'quantity' => '100',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Chocolate em pó',
            'user_id' => 1,
            'category_id' => 5,
            'storage_unity' => 'Kg',
            'quantity' => '10',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);

        Product::create([
            'name' => 'Café',
            'user_id' => 1,
            'category_id' => 5,
            'storage_unity' => 'Kg',
            'quantity' => '20',
            'delivery' => '2022-03-20',
            'expiration' => '2022-05-01',
            'observation' => '',
        ]);
    }
}
