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
                @if(count($categories) > 0)
                    @for($i = 0; $i < count($categories); $i++) 
                        <tr>
                            <td class="text-center">{{ $categories[$i]['name_categorie'] }}</td>
                            <td class="text-center">

                                <a href="{{ route('edit.categorie', $categories[$i]['id']) }}">
                                    <i class="fa-solid fa-pen btn-edit black-color"></i>
                                </a>

                                <strong style="margin: 0 10px;">|</strong>

                                <a href="{{ route('delete.categorie', $categories[$i]['id']) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $categories[$i]['id']}}">
                                    <i class="fa-solid fa-trash btn-delete black-color"></i>
                                </a>

                                <form action="{{ route('delete.categorie', $categories[$i]['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="modal fade" id="deleteModal{{$categories[$i]['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Excluir Categoria</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja realmente excluir a categoria <strong>{{ $categories[$i]['name_categorie'] }}</strong>?
                                                <input type="hidden" name="id" id="id" value="{{ $categories[$i]['id'] }}">
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
                        <td colspan="2">
                            <p>Ainda não há nenhuma categoria cadastrada... <a href="{{ route('viewRegister.categorie') }}">Clique aqui para cadastrar a primeira.</a></p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $categories->appends(['sort' => 'department'])->links() }}
        </div>

    </div>
@endsection