@extends('layouts.template')

@section('title', 'Pesquisar Produto - Storage System')

@section('content')
<h1 class="text-center mt-4 mb-5">Pesquisar Produto</h1>

<main>
    <div class="container">
        <form method="POST" action="{{ route('search.product', 'search') }}" class="mb-3">
            @csrf

            <div class="input-group">
                <input id="input-pesq" class="form-control" name="search" type="text" placeholder="Digite o nome do produto...">
                <button id="btn-pesq" class="btn btn-default" type="submit" name="pesquisarProduto">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            
        </form>

        <h2>Pesquisa feita: {{$search}}</h2>
        @if($products != [])
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
                                    <a href="{{ route('edit.product', $products[$i]['id']) }}">
                                        <i class="fa-solid fa-pen btn-edit black-color"></i> 
                                    </a>
                                    
                                    <strong style="margin: 0 10px;">|</strong>

                                    <a href="{{ route('delete.product', $products[$i]['id']) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $products[$i]['id']}}">
                                        <i class="fa-solid fa-trash btn-delete black-color"></i>
                                    </a>

                                    <form action="{{ route('delete.product', $products[$i]['id']) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="modal fade" id="deleteModal{{ $products[$i]['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Produto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Deseja realmente excluir o produto <strong>{{ $products[$i]['name'] }}</strong>?
                                                    <input type="hidden" name="id" id="id" value="{{ $products[$i]['id'] }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                
                                </td>
                            </tr>
                        @endfor
                    
                    </tbody>
                </table>
            </div>
        @else
            <p>Nenhum resultado para sua busca... <a href="{{ route('home.user') }}">Clique aqui para ver todos os produtos</a> ou faça uma nova pesquisa acima.</p>
        @endif
    </div>
</main>

@endsection