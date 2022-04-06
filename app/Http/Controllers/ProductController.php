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

            $control = new Control();

            $control->observation_control = $request->observation;
            $control->user_id = $user->id;

            $createControl = $control->save();

            if($createControl){

                $control->products()->attach([
                    1 => ['control_id' => $control->id, 'product_id' => $product->id]
                ]);

                return redirect()->route('home.user')->with('msg', "Produto cadastrado com sucesso!");
            }
        } else{
            return redirect()->route('home.user')->with('msgError', "Erro ao cadastrar o produto!");
        }
    }

    public function viewSearch(){

        $userLevel = User::userLevel();

        $categories = Categorie::all();

        return view('product.search', [
            'userLevel' => $userLevel,
            'categories' =>$categories
        ]);
    }

    public function search(){

        $userLevel = User::userLevel();

        $categories = Categorie::all();
        
        $search = request('search');

        $products = Product::where([
            ['name', 'like', '%' . $search . '%']
        ])->get()->toArray();

        return view('product.resultsSearch', [
            'userLevel' => $userLevel,
            'categories' => $categories,
            'products' => $products,
            'search' => $search
        ]);
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
                            <button class='btn-add' id='$product[id]' name='$product[name]' onclick='add(id, name, $product[quantity], `$product[storageUnity]`);'>
                                <i class='fa-solid fa-plus direita'></i>
                            </button>
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