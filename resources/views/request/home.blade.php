@extends('layouts.template')

@section('title', 'Requisições - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-4">Requisições Feitas</h1>

    <div class="container mt-3 mb-3 my-3">

        <div class="table-responsive" id="tbl">
            <table class="tabela table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nome Do Produto</th>
                        <th>Quantidade Requerida</td>
                        <th>Funcionário(a) Que Fez</td>
                        <th>Quando Foi Feita</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($requests) > 0)
                    {{-- dd($requests[1]->quantity_request) --}}
                        @for($i = 0; $i < count($requests); $i++)
                            @foreach($requests[$i]->products as $product)
                                <tr class="text-center">
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $requests[$i]->quantity_request}} {{$product->storageUnity}}</td>
                                    <td>{{ $users[$i]['name'] }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($requests[$i]->created_at)) }}</td>
                                </tr>
                            @endforeach
                        @endfor
                    @else
                        <tr>
                            <td colspan="7">
                                <p>Ainda não foi feita nenhuma requisição... <a href="{{ route('home.request') }}">Clique aqui para fazer a primeira.</a></p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
                {{ $requests->appends([
                    'sort' => 'department',
                ])->links() }}
        </div>
    </div>

    @section('modalContent')
        <div>
            <h4># O que essa página contém?</h4>
            <ul>
                <li>- Menu de navegação;</li>
                <li>- Tabela que mostra todas as requisições (com paginação);</li>
                <li>- E um rodapé;</li>
            </ul>
        </div>

        <div>
            <h4># Qual o Objetivo da página?</h4>
            <p>
                - O principal objetivo é o usuário consiguir visualizar todos as requisições feitas..
            </p>
        </div>

        <br>
        
        <div>
            <h4># Como usar a página?</h4>
            <ul>
                <li>- <strong>Requisições na Tabela:</strong> Você pode visualizar todos as requisições na tabela, vendo até 10 requisições por página, para ver mais você pode usar a paginação que está abaixo dela;</li>
            </ul>
        </div>
    @endsection
@endsection