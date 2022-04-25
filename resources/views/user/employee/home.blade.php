@extends('layouts.template')

@section('title', 'Funcionarios - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-4">Funcionários Cadastrados</h1>

    <div class="container mt-3 mb-3 my-3">
        <div class="table-responsive" id="tbl">
            <table class="tabela table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nome</td>
                        <th>Nome de Usuário</td>
                        <th>Status</td>
                        @if($userLevel['level'] == 3)
                            <th>Função</th>
                        @endif
                        <th>Data de Cadastro</th>
                        <th>Ações</td>
                    </tr>
                </thead>
                <tbody>
                @if(count($employees) > 0)
                    @if($userLevel['level'] == 2)
                        @for($i = 0; $i < count($employees); $i++)
                            @if($employees[$i]['level'] == 1)
                                <tr>
                                    <td>{{ $employees[$i]['name'] }}</td>
                                    <td class="text-center">{{ $employees[$i]['username'] }}</td>

                                    @if($employees[$i]['stats'] == 0)
                                        <td class="text-center">Inativo</td>
                                    @elseif($employees[$i]['stats'] == 1)
                                        <td class="text-center">Ativo</td>
                                    @endif

                                    <td class="text-center">{{ date('d/m/Y', strtotime($employees[$i]['created_at'])) }}</td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('employee.edit', $employees[$i]['id']) }}">
                                            <i class="fa-solid fa-user-pen black-color"></i>
                                        </a>
                                        
                                        <strong style="margin: 0 10px;">|</strong>

                                        <a href="{{ route('employee.destroy', $employees[$i]['id']  ) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employees[$i]['id'] }}">
                                            <i class="fa-solid fa-user-minus black-color"></i>
                                        </a>

                                        <form action="{{ route('employee.destroy', $employees[$i]['id']) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal fade" id="deleteModal{{ $employees[$i]['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Excluir Produto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Deseja realmente excluir o(a) funcionário(a) <strong>{{ $employees[$i]['name'] }}</strong>?
                                                        <input type="hidden" name="id" id="id" value="{{ $employees[$i]['id'] }}">
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
                            @endif
                        @endfor
                    @elseif($userLevel['level'] == 3)
                        @for($i = 0; $i < count($employees); $i++)
                            @if($employees[$i]['level'] != 3)
                                <tr>
                                    <td>{{ $employees[$i]['name'] }}</td>
                                    <td class="text-center">{{ $employees[$i]['username'] }}</td>
                                    @if($employees[$i]['stats'] == 0)
                                        <td class="text-center">Inativo</td>
                                    @elseif($employees[$i]['stats'] == 1)
                                        <td class="text-center">Ativo</td>
                                    @endif

                                    @if($employees[$i]['level'] == 1)
                                        <td class="text-center">Funcionário(a)</td>
                                    @elseif($employees[$i]['level'] == 2)
                                        <td class="text-center">Cordenador(a)</td>
                                    @endif

                                    <td class="text-center">{{ date('d/m/Y', strtotime($employees[$i]['created_at'])) }}</td>
                                    
                                    <td class="text-center">
                                        <abbr title="Editar">
                                            <a href="{{ route('employee.edit', $employees[$i]['id']) }}">
                                                <i class="fa-solid fa-user-pen black-color"></i>
                                            </a>
                                        </abbr>
                                        
                                        <strong style="margin: 0 10px;">|</strong>

                                        <abbr title="Excluir">
                                            <a href="{{ route('employee.destroy', $employees[$i]['id']  ) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employees[$i]['id'] }}">
                                                <i class="fa-solid fa-user-minus black-color"></i>
                                            </a>
                                        </abbr>

                                        <form action="{{ route('employee.destroy', $employees[$i]['id']) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal fade" id="deleteModal{{ $employees[$i]['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Excluir {{ $employees[$i]['level'] == 1 ? "Funcionario(a)" : "Cordenador(a)" }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($employees[$i]['level'] == 2)
                                                                Deseja realmente excluir o(a) cordenador(a) <strong>{{ $employees[$i]['name'] }}</strong>?
                                                            @else
                                                                Deseja realmente excluir o(a) funcionário(a) <strong>{{ $employees[$i]['name'] }}</strong>?
                                                            @endif
                                                        <input type="hidden" name="id" id="id" value="{{ $employees[$i]['id'] }}">
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
                            @endif
                        @endfor
                    @endif
                @else
                    <tr>
                        <td colspan="7">
                            <p>Ainda não há nenhum funcionário cadastrado... <a href="#">Clique aqui para cadastrar o primeiro.</a></p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $employees->appends(['sort' => 'department'])->links() }}
        </div>

    </div>

    @section('modalContent')
        <div>
            <h4># O que essa página contém?</h4>
            <ul>
                <li>- Menu de navegação;</li>
                <li>
                    - Tabela que mostra todos os usuários cadastrados (com paginação), e que possui duas ações também, editar e excluir;
                </li>
                <li>- E um rodapé;</li>
            </ul>
        </div>

        <div>
            <h4># Qual o Objetivo da página?</h4>
            <p>
                - O principal objetivo é o usuário consiguir visualizar todos os usuários atualmente cadastrados.
            </p>
        </div>

        <br>
        
        <div>
            <h4># Como usar a página?</h4>
            <ul>
                <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                <li>- <strong>Usuários na Tabela:</strong> Você pode visualizar todos os usuários na tabela, vendo até 10 usuários nela, para ver mais você pode usar a paginação que está abaixo dela;</li>
                <li>- <strong>Editar:</strong> Para editar basta você clicar no icone <i class="fa-solid fa-user-minus black-color"></i> que irá te encaminhar para uma página para editar o usuário que você deseja;</li>
                <li>- <strong>Excluir:</strong> Para excluir basta você clicar no icone <i class="fa-solid fa-user-minus black-color"></i> que irá apresentar uma janela que perguntará se você realmente quer cometer essa ação, caso queira clique no botão "Excluir";</li>

                <br>

                <hr>
                
                <p><strong>OBS:</strong> Excluir um usuário talvez cause alguns problemas, talvez a melhor opção seja deixar ele <strong>inativo</strong>, para isso acesse a função editar <i class="fa-solid fa-user-pen black-color"></i> do usuário selecionado. </p>
            </ul>
        </div>
    @endsection
@endsection