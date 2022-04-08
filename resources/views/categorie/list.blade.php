@extends('layouts.template')

@section('title', 'Produtos cadastrados - Categoria ' . $categorie->name_categorie . ' - Storage System')

@section('content')

    <h1 class="text-center mt-4 mb-4">Produtos cadastrados com a categoria {{ $categorie->name_categorie }}</h1>

    <div class="container mt-3 mb-3 my-3">
        <div class="table-responsive" id="tbl">
            <table class="tabela table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Produto</td>
                        <th>Quantidade</td>
                        <th>Entrega</td>
                        <th>Validade</td>
                        <th>Observação</td>
                        <th>Ações</td>
                    </tr>
                </thead>
                <tbody>
                @if(count($products) > 0)
                    @for($i = 0; $i < count($products); $i++)
                        <tr>
                            <td>{{ $products[$i]['name'] }}</td>
                            <td class="text-center">{{ $products[$i]['quantity'] . " " . $products[$i]['storageUnity'] }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($products[$i]['deliveryDate'])) }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($products[$i]['expirationDate'])) }}</td>
                            <td>{{ $products[$i]['observation'] }}</td>
                            <td class="text-center">
                                <abbr title="Editar">
                                    <a href="{{ route('edit.product', $products[$i]['id']) }}">
                                        <i class="fa-solid fa-pen btn-edit black-color"></i>
                                    </a>
                                </abbr>
                                
                                <strong style="margin: 0 10px;">|</strong>

                                <abbr title="Excluir">
                                    <a href="{{ route('delete.product', $products[$i]['id']) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $products[$i]['id']}}">
                                        <i class="fa-solid fa-trash btn-delete black-color"></i>
                                    </a>
                                </abbr>

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
                @else
                    <tr>
                        <td colspan="7">
                            <p>Ainda não há nenhum produto cadastrado... <a href="{{ route('viewRegister.product') }}">Clique aqui para cadastrar o primeiro.</a></p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            
        </div>
    </div>

@endsection