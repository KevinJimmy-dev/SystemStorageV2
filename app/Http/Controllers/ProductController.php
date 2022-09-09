<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Traits\CheckAuth;
use App\Models\{
    Product,
    Category,    
};

class ProductController extends Controller
{
    use CheckAuth;

    public function index(){
        $search = request('search');

        if(!is_null($search)) {
            $products = Product::where('name', 'like', "%$search%")->paginate(10);
        } else{
            $products = Product::paginate(10);
        }

        return view('user.index', [
            'user' => $this->getUser(),
            'products' => $products,
            'search' => $search
        ]);
    }
    
    public function create(){
        return view('product.register', [
            'user' => $this->getUser(),
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductRequest $request){
        $product = Product::where('name', $request->name)->first();

        if(!is_null($product)) {
            return redirect()->route('user.index')->with('msgError', "O produto $request->name já existe!");
        } 
        
        $newProduct = Product::newProduct($request, $this->getUser());

        if($newProduct) {
            return redirect()->route('user.index')->with('msg', "Produto cadastrado com sucesso!");
        } else{
            return redirect()->route('user.index')->with('msgError', "Erro ao cadastrar o produto!");
        }
    }

    public function edit($id){
        $product = Product::find($id);

        if(is_null($product)){
            return redirect()->back();
        }

        $categories = Category::all();

        return view('product.edit', [
            'user' => $this->getUser(),
            'product' => $product,
            'categories' => $categories   
        ]);
    }

    public function update(ProductRequest $request){
        $product = Product::find($request->id);

        if(is_null($product)) {
            return redirect()->back();
        }

        if($product->update($request->all())){
            return redirect()->route('user.index')->with('msg', "Produto editado com sucesso!");
        } else{
            return redirect()->route('user.index')->with('msgError', "Erro ao editar o produto!");
        }
    }

    public function destroy(HttpRequest $request){
        $product = Product::find($request->id);

        if(is_null($product)) {
            return redirect()->back();
        }

        if($product->delete()){
            return redirect()->route('user.index')->with('msg', "Produto excluido com sucesso!");
        } else{
            return redirect()->route('user.index')->with('msgError', "Erro ao excluir o produto!");
        }
    }
}