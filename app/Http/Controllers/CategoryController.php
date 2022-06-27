<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\{
    Category,
    Product,
    User
};
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller{
    
    // Retorna todas as categorias cadastradas
    public function index(){
        $userLevel = User::userLevel();

        $categories = Category::paginate(10);

        return view('category.index', [
            'userLevel' => $userLevel,
            'categories' => $categories
        ]);
    }

    // Retorna a view para cadastrar
    public function viewRegister(){
        $userLevel = User::userLevel();

        return view('category.create', [
            'userLevel' => $userLevel
        ]);
    }

    // Cria uma nova categoria se tudo estiver correto
    public function create(CategoryRequest $request){
        $exists = Category::where('name_category', $request->name_category)->first();

        if($exists){
            return redirect()->route('category.index')->with('msgError', "A categoria $request->name_category já existe!");
        } else{
            $info = $request->all();

            Category::create($info);

            return redirect()->route('category.index')->with('msg', "Categoria cadastrada com sucesso!");
        }
    }

    // Lista todos os produtos pertencentes a X categoria
    public function list($id){
        $userLevel = User::userLevel();

        $products = Product::where('category_id', $id)->paginate(10);

        $nameCategory = Category::find($id);

        return view('category.list', [
            'products' => $products,
            'category' => $nameCategory,
            'userLevel' => $userLevel
        ]);
    }

    // Retorna a view para editar
    public function edit($id){
        $userLevel = User::userLevel();

        $category = Category::findOrFail($id);

        return view('category.edit', [
            'category' => $category,
            'userLevel' => $userLevel
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
