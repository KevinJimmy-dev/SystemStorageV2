<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Http\Traits\CheckAuth;
use App\Models\{
    Product,
    Category,    
};

class ProductController extends Controller
{
    use CheckAuth;

    public function index()
    {
        $search = request('search');

        $builder = Product::query();

        if (!is_null($search)) {
            $builder = $builder->where('name', 'like', "%$search%");
        }

        $products = $builder->paginate(10);

        return view('user.index', [
            'products' => $products,
            'search' => $search
        ]);
    }
    
    public function create(){
        return view('product.register', [
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::where('name', $request->name)->first();

        if (!is_null($product)) {
            return redirect()->route('user.index')->with('msgError', "O produto $request->name já existe!");
        }

        (new ProductService($this->getUser()))->create($request);

        return redirect()->route('user.index')->with('msg', "Produto cadastrado com sucesso!");
    }

    public function edit($id){
        $product = Product::find($id);

        if(is_null($product)){
            return redirect()->back();
        }

        $categories = Category::all();

        return view('product.edit', [
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