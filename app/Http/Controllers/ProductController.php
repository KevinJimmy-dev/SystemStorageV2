<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    User,
    Categorie,
    Control,
    Request
};
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{

    public function index(){
        
    }

    public function home(){

        $userLevel = User::userLevel();

        if($search = request('search')){

            $products = Product::where([
                ['name', 'like', '%' . $search . '%']
            ])->paginate(10);

            $categories = [];
            $categories_id = [];

            foreach($products as $product){
                $categories_id[] = $product['categorie_id'];
            }

            for($i = 0; $i < count($products); $i++){
                $categories[] = Categorie::where('id', $categories_id[$i])->first()->toArray();
            }

            return view('user.home', [
                'userLevel' => $userLevel,
                'categories' => $categories,
                'products' => $products,
                'search' => $search
            ]);

        } else{
            
            $products = Product::paginate(10);

            $categorie_id = [];
            $categories = [];

            if($products){
                foreach($products as $product){
                        $categorie_id[] = $product['categorie_id']; 
                    }

                    for($i = 0; $i < count($products); $i++){
                        $categories[] = Categorie::where('id', $categorie_id[$i])->first()->toArray();   
                    }
                
                return view('user.home', [
                    'userLevel' => $userLevel,
                    'products' => $products,
                    'categories' => $categories,
                    'search' => $search
                ]);

            } else{
                return view('user.home', [
                    'userLevel' => $userLevel,
                    'products' => $products,
                    'search' => $search
                ]);
            }
        }
    }

    public function viewRegister(){

        $userLevel = User::userLevel();

        $categories = Categorie::all();

        return view('product.register', [
            'userLevel' => $userLevel,
            'categories' =>$categories
        ]);
    }

    public function create(HttpRequest $request){

        $user = auth()->user();

        $exists = Product::where('name', $request->name)->first();

        if($exists){

            return redirect()->route('home.user')->with('msgError', "O produto $request->name já existe!");

        } else{

            $info = $request->all();

            $create = Product::create($info);

            if($create){

                $control = new Control();

                $control->observation_control = $request->observation;
                $control->user_id = $user->id;

                $createControl = $control->save();

                if($createControl){

                    $control->products()->attach([
                        1 => ['control_id' => $control->id, 'product_id' => $create->id]
                    ]);

                    return redirect()->route('home.user')->with('msg', "Produto cadastrado com sucesso!");
                }
            } else{
                return redirect()->route('home.user')->with('msgError', "Erro ao cadastrar o produto!");
            }
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

    public function update(HttpRequest $request){

        $data = $request->all();

        $update = Product::findOrFail($request->id)->update($data);

        if($update){
            return redirect()->route('home.user')->with('msg', "Produto editado com sucesso!");

        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao editar o produto!");
        }
    }

    public function destroy(HttpRequest $request){

        $id = $request['id'];

        $product = Product::find($id);

        $delete = $product->delete();

        if($delete){
            return redirect()->route('home.user')->with('msg', "Produto excluido com sucesso!");
            
        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao excluir o produto!");
        }
    }

    public function requestView(){

        $userLevel = User::userLevel();

        return view('request/home', [
            'userLevel' => $userLevel
        ]);
    }

    public function requestSearch(HttpRequest $request){

        $products = $request->word;

        $products = Product::where([
            ['name', 'like', '%' . $products . '%']
        ])->get()->toArray();

        if(count($products) <= 0){
            echo "<li>Nenhum produto encontrado...</li>";

        } else{

            foreach($products as $product){  

                echo "
                        <li>
                            $product[name] 
                            <abbr title='Adicionar'>
                                <button class='btn-add' id='$product[id]' name='$product[name]' onclick='add(id, name, $product[quantity], `$product[storageUnity]`), noFocus()'>
                                    <i class='fa-solid fa-plus direita'></i>
                                </button>
                            </abbr>
                        </li>
                    "; 
            }  
        }
    }

    public function request(HttpRequest $request){

        $user = auth()->user();
        
        $quantity = $request->quantity;
        $requests = $request->request_value;
        $id = $request->id_product;
        $name = $request->name_product;

        try{
            if(empty($quantity)){

                return redirect()->route('requestView')->with('msgWarning', "Você precisa selecionar um ou mais produtos para fazer uma requisição!");
    
            } else{
                
                for($i = 0; $i < count($requests); $i++){
                    if($requests[$i] <= 0){
    
                        return redirect()->route('requestView')->with('msgError', "A requisição do produto $name[$i] não foi feita, pois o valor inserido era invalido!");
    
                    } elseif($quantity[$i] < $requests[$i]){
                         
                        return redirect()->route('requestView')->with('msgError', "A quantidade requerida do produto $name[$i] é maior do que a quantidade disponível!");
    
                    } else{
    
                        $newQuantity = $quantity[$i] - $requests[$i];
                        
                        $update = Product::findOrFail($id[$i])->update(['quantity' => $newQuantity]);

                        if($update){

                            $requestModel = new Request();
        
                            $requestModel->quantity_request = $requests[$i];
                            $requestModel->user_id = $user->id;

                            $createRequest = $requestModel->save();
        
                            if($createRequest){

                                $productRequest = $requestModel->products()->attach([
                                    1 => ['product_id' => $id[$i], 'request_id' => $requestModel->id]
                                ]);
                            } else{

                                return redirect()->route('home.user')->with('msgError', "Erro ao requisitar um ou mais produtos!");
                            }
                        } else{
            
                            return redirect()->route('home.user')->with('msgError', "Erro ao requisitar um ou mais produtos!");
                        }
                    }
                }

                return redirect()->route('home.user')->with('msg', "Requisição de um ou mais produtos feita com sucesso!");
                
            }
        } catch(Exception){
            return redirect()->route('home.user')->with('msgError', "Erro ao fazer a requisição!");
        }
    }
}