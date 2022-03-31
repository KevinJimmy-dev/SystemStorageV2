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

        return view('categorie.home', [
            'userLevel' => $userLevel,
            'categories' => $categories
        ]);
    }

    public function viewRegister(){

        $userLevel = User::userLevel();

        return view('categorie.register', [
            'userLevel' => $userLevel
        ]);
    }

    public function create(Request $request){

        $categorie = new Categorie();

        $categorie->name_categorie = $request->categorie;

        $read = $categorie->save();

        if($read){
            return redirect()->route('home.categorie')->with('msg', "Categoria cadastrada com sucesso!");
        } else{
            return redirect()->route('home.categorie')->with('msgError', "Erro ao cadastrar a Categoria!");
        }
    }

    public function edit($id){

        $userLevel = User::userLevel();

        $categorie = Categorie::findOrFail($id);

        return view('categorie.edit', [
            'categorie' => $categorie,
            'userLevel' => $userLevel
        ]);
    }

    public function update(Request $request){

        $data = $request->all();

        $update = Categorie::findOrFail($request->id)->update($data);

        if($update){
            return redirect()->route('home.categorie')->with('msg', "Categoria editada com sucesso!");
        } else{
            return redirect()->route('home.categorie')->with('msgError', "Erro ao editar a Categoria!");
        }
    }

    public function destroy(Request $request){

        $id = $request['id'];

        $categorie = Categorie::find($id);

        $delete = $categorie->delete();

        if($delete){
            return redirect()->route('home.categorie')->with('msg', "Categoria excluida com sucesso!");

        } else{
            return redirect()->route('home.categorie')->with('msgError', "Erro ao excluir a categoria!");
        }
    }
}
