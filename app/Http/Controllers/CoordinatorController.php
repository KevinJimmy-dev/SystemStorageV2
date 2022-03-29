<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Product;

class CoordinatorController extends Controller
{
    public function index(){

        $userLevel = User::userLevel();

        $products = Product::all()->toArray();

        $categorie_id = [];
        if($products){
            foreach($products as $product){
                    $categorie_id[] = $product['categorie_id']; 
                }

                for($i = 0; $i < count($products); $i++){
                    $categories[] = Categorie::where('id', $categorie_id[$i])->first()->toArray(); 
                }
        }

        return view('user.admin.home', [
            'userLevel' => $userLevel,
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
