<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\{
    Product,
    User,
    Category,    
};

class ProductController extends Controller{

    // Retorna todos os produtos na view 
    public function index(){
        $userLevel = User::userLevel();

        if($search = request('search')){
            $products = Product::where([
                ['name', 'like', '%' . $search . '%']
            ])->with('category')->paginate(10);
        } else{
            $products = Product::with('category')->paginate(10);
        }

        return view('user.index', [
            'userLevel' => $userLevel,
            'products' => $products,
            'search' => $search
        ]);
    }
    
    // Retorna a view de cadastro
    public function create(){
        $userLevel = User::userLevel();

        $categories = Category::all();

        return view('product.register', [
            'userLevel' => $userLevel,
            'categories' => $categories
        ]);
    }

    // Cria um novo produto
    public function store(ProductRequest $request){
        $user = auth()->user();

        $exists = Product::where('name', $request->name)->first();

        if($exists){
            return redirect()->route('user.index')->with('msgError', "O produto $request->name já existe!");
        } else{
            if(Product::newProduct($request, $user)){
                return redirect()->route('user.index')->with('msg', "Produto cadastrado com sucesso!");
            } else{
                return redirect()->route('user.index')->with('msgError', "Erro ao cadastrar o produto!");
            }
        }  
    }

    // Retorna a view para editar o produto
    public function edit($id){
        $userLevel = User::userLevel();

        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('product/edit', [
            'userLevel' => $userLevel,
            'product' => $product,
            'categories' => $categories   
        ]);
    }

    // Faz o update no banco de X produto
    public function update(ProductRequest $request){
        $data = $request->all();

        $update = Product::findOrFail($request->id)->update($data);

        if($update){
            return redirect()->route('user.index')->with('msg', "Produto editado com sucesso!");
        } else{
            return redirect()->route('user.index')->with('msgError', "Erro ao editar o produto!");
        }
    }

    // Exclui X produto do banco
    public function destroy(HttpRequest $request){
        $id = $request['id'];

        $product = Product::find($id);

        $delete = $product->delete();

        if($delete){
            return redirect()->route('user.index')->with('msg', "Produto excluido com sucesso!");
        } else{
            return redirect()->route('user.index')->with('msgError', "Erro ao excluir o produto!");
        }
    }
}