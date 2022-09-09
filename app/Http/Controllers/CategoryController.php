<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Traits\CheckAuth;
use App\Models\{
    Category,
    Product,
    User
};
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller{

    use CheckAuth;
    
    public function index(){
        $categories = Category::paginate(10);

        return view('category.index', [
            'user' => $this->getUser(),
            'categories' => $categories
        ]);
    }

    public function create(){
        return view('category.create', [
            'user' => $this->getUser(),
        ]);
    }

    // Cria uma nova categoria se tudo estiver correto
    public function store(CategoryRequest $request){
        $category = Category::where('name_category', $request->name_category)->first();

        if(!is_null($category)){
            return redirect()->route('category.index')->with('msgError', "A categoria $request->name_category já existe!");
        }

        Category::create([
            'user_id' => $request->user_id,
            'name_category' => $request->name_category,
        ]);

        return redirect()->route('category.index')->with('msg', "Categoria cadastrada com sucesso!");
    }

    // Lista todos os produtos pertencentes a X categoria
    public function show($id){
        $products = Product::where('category_id', $id)->paginate(10);

        $nameCategory = Category::find($id);

        return view('category.show', [
            'products' => $products,
            'category' => $nameCategory,
            'user' => $this->getUser(),
        ]);
    }

    // Retorna a view para editar
    public function edit($id){
        $category = Category::findOrFail($id);

        return view('category.edit', [
            'category' => $category,
            'user' => $this->getUser()
        ]);
    }

    // Faz o update no banco
    public function update(CategoryRequest $request){
        $data = $request->all();

        $update = Category::findOrFail($request->id)->update($data);

        if($update){
            return redirect()->route('category.index')->with('msg', "Categoria editada com sucesso!");
        } else{
            return redirect()->route('category.index')->with('msgError', "Erro ao editar a Categoria!");
        }
    }

    // Remove categoria do banco
    public function destroy(Request $request){
        $id = $request['id'];

        $category = Category::find($id);

        try{
            $category->delete();

            return redirect()->route('category.index')->with('msg', "Categoria excluida com sucesso!");
        } catch(Exception $e){
            return redirect()->route('category.index')->with('msgError', "Você não pode excluir essa categoria, porque ela possui produtos cadastrados com ela!");  
        }
    }
}
