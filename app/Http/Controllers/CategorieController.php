<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class CategorieController extends Controller
{
    public function index(){

        $userLevel = User::userLevel();

        $categories = Categorie::paginate();

        //dd($categories);

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

        $exists = Categorie::where('name_categorie', $request->categorie)->first();

        if($exists){
            
            return redirect()->route('home.categorie')->with('msgError', "A categoria $request->name_categorie já existe!");

        } else{

            $info = $request->all();

            Categorie::create($info);

            return redirect()->route('home.categorie')->with('msg', "Categoria cadastrada com sucesso!");
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

        try{
            $categorie->delete();

            return redirect()->route('home.categorie')->with('msg', "Categoria excluida com sucesso!");

        } catch(Exception $e){

            return redirect()->route('home.categorie')->with('msgError', "Você não pode excluir essa categoria, porque possui produtos cadastrados com ela!");  
        }
    }
}
