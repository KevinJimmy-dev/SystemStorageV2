@extends('layouts.template')

@section('title', 'Categorias - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-4">Categorias Cadastradas</h1>

    <div class="container mt-3 mb-3 my-3">
        <div class="table-responsive" id="tbl">
            <table class="tabela table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nome da Categoria</td>
                        <th>Ações</td>
                    </tr>
                </thead>
                <tbody>
                
                    @for($i = 0; $i < count($categories); $i++)
                        <tr>
                            <td class="text-center">{{ $categories[$i]['name_categorie'] }}</td>
                            <td class="text-center"> EDITAR | EXCLUIR </td>
                        </tr>
                    @endfor
                
                </tbody>
            </table>
        </div>        
    </div>
@endsection