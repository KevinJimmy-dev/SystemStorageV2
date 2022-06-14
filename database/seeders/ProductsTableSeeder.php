<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'storageUnity' => 'Kg',
            'quantity' => '35',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'batatinhas',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Leite',
            'storageUnity' => 'L',
            'quantity' => '25',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'Desnatado',
            'category_id' => '6'
        ]);

        Product::create([
            'name' => 'Pão Francês',
            'storageUnity' => 'Un',
            'quantity' => '100',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '3'
        ]);

        Product::create([
            'name' => 'Kiwi',
            'storageUnity' => 'Kg',
            'quantity' => '15',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Carne bovina',
            'storageUnity' => 'Kg',
            'quantity' => '10',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '2'
        ]);

        Product::create([
            'name' => 'Carne suína',
            'storageUnity' => 'Kg',
            'quantity' => '15',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '2'
        ]);

        Product::create([
            'name' => 'Frango',
            'storageUnity' => 'Kg',
            'quantity' => '20',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '2'
        ]);

        Product::create([
            'name' => 'Apresuntado',
            'storageUnity' => 'Kg',
            'quantity' => '5',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '6'
        ]);

        Product::create([
            'name' => 'Presunto',
            'storageUnity' => 'Kg',
            'quantity' => '3',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'Marca: Seara',
            'category_id' => '6'
        ]);

        Product::create([
            'name' => 'Mussarela',
            'storageUnity' => 'Kg',
            'quantity' => '3',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'Marca: Seara',
            'category_id' => '6'
        ]);

        Product::create([
            'name' => 'Mortandela',
            'storageUnity' => 'Kg',
            'quantity' => '7',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'Sem gordura, fatiada',
            'category_id' => '3'
        ]);

        Product::create([
            'name' => 'Abacate',
            'storageUnity' => 'Kg',
            'quantity' => '2',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Banana',
            'storageUnity' => 'Kg',
            'quantity' => '4',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => 'Nanica',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Tomate',
            'storageUnity' => 'Kg',
            'quantity' => '2',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Leite condensado',
            'storageUnity' => 'Un',
            'quantity' => '20',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '7'
        ]);

        Product::create([
            'name' => 'Repolho',
            'storageUnity' => 'Un',
            'quantity' => '20',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '1'
        ]);

        Product::create([
            'name' => 'Carne moida',
            'storageUnity' => 'Kg',
            'quantity' => '5',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '2'
        ]);

        Product::create([
            'name' => 'Chocolate em barra',
            'storageUnity' => 'Un',
            'quantity' => '100',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '5'
        ]);

        Product::create([
            'name' => 'Chocolate em pó',
            'storageUnity' => 'Kg',
            'quantity' => '10',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '5'
        ]);

        Product::create([
            'name' => 'Café',
            'storageUnity' => 'Kg',
            'quantity' => '20',
            'deliveryDate' => '2022-03-20',
            'expirationDate' => '2022-05-01',
            'observation' => '',
            'category_id' => '5'
        ]);
    }
}
