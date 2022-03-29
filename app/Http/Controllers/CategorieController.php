<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\User;

class CategorieController extends Controller
{
    public function index(){

        $userLevel = User::userLevel();

        $categories = Categorie::all()->toArray();

        //dd($products);

        return view('categorie.home', [
            'userLevel' => $userLevel,
            'categories' => $categories
        ]);
    }

    public function viewRegister(){

        $userLevel = User::userLevel();

        return view('categorie.register', [
            'userLevel' => $userLevel,
        ]);
    }

    public function create(Request $request){

        $categorie = new Categorie();

        $categorie->name_categorie = $request->categorie;

        $categorie->save();

        return redirect('/categorias')->with('msg', "Categoria criada com sucesso!");
    }
}
