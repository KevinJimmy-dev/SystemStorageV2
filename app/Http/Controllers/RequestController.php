<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\{
    Product,
    User,
    Request,    
};
use Exception;

class RequestController extends Controller{

    // Retorna todas as requisicoes feitas
    public function index(){
        $userLevel = User::userLevel();

        $requests = Request::with(['products', 'user'])->paginate(10);

        return view('request.index', [
            'userLevel' => $userLevel,
            'requests' => $requests
        ]); 
    }

    // Retorna a view para fazer uma nova requisicao
    public function requestView(){
        $userLevel = User::userLevel();

        return view('request.request', [
            'userLevel' => $userLevel
        ]);
    }

    // Faz a busca dos produtos pra requisicao e mostra na hora (sem refresh)
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

    // Executa a requisicao, se tudo der certo
    public function request(HttpRequest $request){
        $newRequest = Request::newRequest($request);

        switch($newRequest){
            case 0: 
                return redirect()->route('request.requestView')->with('msgWarning', "Voc?? precisa selecionar um ou mais produtos para fazer uma requisi????o!");
                break;
            
            case 1:
                return redirect()->route('request.index')->with('msgError', "A requisi????o de algum produto n??o foi feita, pois o valor inserido era invalido!");
                break;

            case 2: 
                return redirect()->route('request.index')->with('msgError', "A quantidade requerida de algum produto ?? maior do que a quantidade dispon??vel!");
                break;

            case 3: 
                return redirect()->route('request.index')->with('msg', "Requisi????o de um ou mais produtos feita com sucesso!");
                break;

            case 4: 
                return redirect()->route('request.request')->with('msgError', "Erro ao fazer a requisi????o de um ou mais produtos!");
                break;
        }
    }
}
