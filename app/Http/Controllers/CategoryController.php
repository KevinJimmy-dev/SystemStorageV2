<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Traits\CheckAuth;
use App\Models\{
    Category,
    Product,
};
use Illuminate\Http\Request;

class CategoryController extends Controller{

    use CheckAuth;
    
    public function index(){
        return view('category.index', [
            'categories' => Category::paginate(10)
        ]);
    }

    public function create(){
        return view('category.create');
    }

    public function store(CategoryRequest $request){
        $category = Category::where('name_category', $request->name_category)->first();

        if(!is_null($category)){
            return redirect()->route('category.index')->with('msgError', "A categoria $request->name_category já existe!");
        }

        Category::create([
            'user_id' => $this->getUser()->id,
            'name_category' => $request->name_category,
        ]);

        return redirect()->route('category.index')->with('msg', "Categoria cadastrada com sucesso!");
    }

    public function show($id){
        $products = Product::where('category_id', $id)->paginate(10);

        $category = Category::find($id);

        return view('category.show', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function edit($id){
        $category = Category::find($id);

        if(is_null($category)) {
            return redirect()->back();
        }

        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request){
        $category = Category::find($request->id);

        if(is_null($category)) {
            return redirect()->back();
        }

        $category->update([
            'name_category' => $request->name_category,
        ]);

        return redirect()->route('category.index')->with('msg', "Categoria editada com sucesso!");
    }

    public function destroy(Request $request){
        $category = Category::find($request->id);

        if(is_null($category)) {
            return redirect()->back();
        }

        if (count($category->products) > 0) {
            return redirect()->back()->with('msgError', 'Você não pode excluir essa categoria, pois possui produtos vinculados a ela!');
        }

        $category->delete();

        return redirect()->route('category.index')->with('msg', "Categoria excluida com sucesso!");
    }
}
