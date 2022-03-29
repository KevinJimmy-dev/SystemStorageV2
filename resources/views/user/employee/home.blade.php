@extends('layouts.template')

@section('title', 'Homes - Storage System')

@section('content')
<h1 class="text-center mt-5 mb-5">Produtos Cadastrados</h1>

<div class="container mt-5 mb-3 my-3">
    <div class="table-responsive" id="tbl">
        <table class="tabela table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Produto</td>
                    <th>Quantidade</td>
                    <th>Entrega</td>
                    <th>Validade</td>
                    <th>Observação</td>
                    <th>Categoria</td>
                    <th>Ações</td>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($products); $i++)
                    <tr>
                        <td>{{ $products[$i]['name'] }}</td>
                        <td class="text-center">{{ $products[$i]['quantity'] . " " . $products[$i]['storageUnity'] }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($products[$i]['deliveryDate'])) }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($products[$i]['expirationDate'])) }}</td>
                        <td>{{ $products[$i]['observation'] }}</td>
                        <td>{{ $categories[$i]['name_categorie'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('categorias/editar/', $product[$i][$id]) }}">EDITAR </a>
                            |
                            <a href="">EXCLUIR </a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>        
</div>
@endsection