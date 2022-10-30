<?php

namespace App\Http\Controllers;

use App\Http\Traits\CheckAuth;
use Illuminate\Http\Request as HttpRequest;
use App\Models\{
    Product,
    Request,
};

class RequestController extends Controller
{
    use CheckAuth;

    public function index()
    {
        $requests = Request::with(['products', 'user'])->paginate(10);

        return view('request.index', [
            'user' => $this->getUser(),
            'requests' => $requests
        ]);
    }

    public function create()
    {
        return view('request.request', [
            'user' => $this->getUser()
        ]);
    }

    public function search(HttpRequest $request)
    {
        $request->word;

        $products = Product::where([
            ['name', 'like', '%' . $request->word . '%']
        ])->get()->toArray();

        if (count($products) <= 0) {
            echo "<li>Nenhum produto encontrado...</li>";
        } else {
            foreach ($products as $product) {
                echo "
                      <li>
                           $product[name]

                            <abbr title='Adicionar'>
                                <button class='btn-add' id='$product[id]' name='$product[name]' onclick='add(id, name, $product[quantity], `$product[storage_unity]`), noFocus()'>
                                    <i class='fa-solid fa-plus direita'></i>
                                </button>
                            </abbr>
                      </li>
                    ";
            }
        }
    }

    public function request(HttpRequest $request)
    {
        $newRequest = Request::newRequest($request);

        switch ($newRequest) {
            case 0:
                return redirect()->route('request.create')->with('msgWarning', "Você precisa selecionar um ou mais produtos para fazer uma requisição!");
                break;

            case 1:
                return redirect()->route('request.index')->with('msgError', "A requisição de algum produto não foi feita, pois o valor inserido era invalido!");
                break;

            case 2:
                return redirect()->route('request.index')->with('msgError', "A quantidade requerida de algum produto é maior do que a quantidade disponível!");
                break;

            case 3:
                return redirect()->route('request.index')->with('msg', "Requisição de um ou mais produtos feita com sucesso!");
                break;

            case 4:
                return redirect()->route('request.request')->with('msgError', "Erro ao fazer a requisição de um ou mais produtos!");
                break;
        }
    }
}
