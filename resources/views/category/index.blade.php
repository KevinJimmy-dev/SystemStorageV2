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

                                <abbr title="Editar">
                                    <a href="{{ route('category.edit', $categories[$i]['id']) }}">
                                        <i class="fa-solid fa-pen btn-edit black-color"></i>
                                    </a>
                                </abbr>

                                <strong style="margin: 0 10px;">|</strong>

                                <abbr title="Produtos pertencentes">
                                    <a href="{{ route('category.list', $categories[$i]['id']) }}">
                                        <i class="fa-solid fa-clipboard-list black-color"></i>
                                    </a>
                                </abbr>

                                <strong style="margin: 0 10px;">|</strong>

                                <abbr title="Excluir">
                                    <a href="{{ route('category.destroy', $categories[$i]['id']) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $categories[$i]['id']}}">
                                        <i class="fa-solid fa-trash btn-delete black-color"></i>
                                    </a>
                                </abbr>

                                <form action="{{ route('category.destroy', $categories[$i]['id']) }}" method="POST">
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
                            <p>Ainda não há nenhuma categoria cadastrada... <a href="{{ route('category.viewRegister') }}">Clique aqui para cadastrar a primeira.</a></p>
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

    @section('modalContent')
        <div>
            <h4># O que essa página contém?</h4>
            <ul>
                <li>- Menu de navegação;</li>
                <li>- Tabela que mostra todas as categorias (com paginação);</li>
                <li>- Três botões, para editar, visualizar produtos que estão nessa categoria e excluir;</li>
                <li>- E um rodapé;</li>
            </ul>
        </div>

        <div>
            <h4># Qual o Objetivo da página?</h4>
            <p>
                - O principal objetivo é o usuário consiguir visualizar todos as categorias já cadastradas, vendo na tabela ou até pesquisando.
            </p>
        </div>

        <br>
        
        <div>
            <h4># Como usar a página?</h4>
            <ul>
                <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                <li>- <strong>Categorias na Tabela:</strong> Você pode visualizar todos os produtos na tabela, vendo até 10 produtos nela, para ver mais você pode usar a paginação que está abaixo dela;</li>
                <li>- <strong>Ações:</strong> Cada categoria possui três ações, sendo: 
                    <br> -- <i class="fa-solid fa-pen btn-edit black-color"></i> para editar; 
                    <br> -- <i class="fa-solid fa-clipboard-list black-color"></i> para visualizar produtos cadastrados com essa categoria; 
                    <br> -- <i class="fa-solid fa-trash btn-delete black-color"></i> para excluir a categoria. 
                </li>

                <hr>

                <p><strong>OBS:</strong> Talvez você não consigar excluir uma categoria porque ela possui produtos cadastrados com ela. Se você REALMENTE quer excluir ela, você precisará editar a categoria de todos os produtos, alterando para outra!</p>
            </ul>
        </div>
    @endsection
@endsection