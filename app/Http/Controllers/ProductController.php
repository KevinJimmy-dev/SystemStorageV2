<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Categorie;

class ProductController extends Controller{

    public function index(){
        
    }

    public function viewRegister(){

        $userLevel = User::userLevel();

        $categories = Categorie::all();

        return view('product.register', [
            'userLevel' => $userLevel,
            'categories' =>$categories
        ]);
    }

    public function create(Request $request){

        $product = new Product();

        $product->name = $request->name;
        $product->storageUnity = $request->storageUnity;
        $product->quantity = $request->quantity;
        $product->deliveryDate = $request->deliveryDate;
        $product->expirationDate = $request->expirationDate;
        $product->observation = $request->observation;
        $product->categorie_id = $request->categorie_id;

        $create = $product->save();

        if($create){
            return redirect()->route('home.user')->with('msg', "Produto cadastrado com sucesso!");

        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao cadastrar o produto!");
        }
    }

    public function edit($id){

        $userLevel = User::userLevel();

        $product = Product::findOrFail($id);

        $categories = Categorie::all();

        return view('product/edit', [
            'userLevel' => $userLevel,
            'product' => $product,
            'categories' => $categories   
        ]);
    }

    public function update(Request $request){

        $data = $request->all();

        $update = Product::findOrFail($request->id)->update($data);

        if($update){
            return redirect()->route('home.user')->with('msg', "Produto editado com sucesso!");

        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao editar o produto!");
        }
    }

    public function destroy(Request $request){

        $id = $request['id'];

        $product = Product::find($id);

        $delete = $product->delete();

        if($delete){
            return redirect()->route('home.user')->with('msg', "Produto excluido com sucesso!");
            
        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao excluir o produto!");
        }
    }
}