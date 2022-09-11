@extends('layouts.template')

@section('title', 'Funcionarios - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-4">Funcionários Cadastrados</h1>

    <div class="container mt-3 mb-3 my-3">
        @if(count($employees) > 0)
            <div class="table-responsive" id="tbl">
                <table class="tabela table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Nome</td>
                            @if(!is_null($user->admin_id))
                                <th>Função</th>
                            @endif
                            <th>Email</td>
                            <td>Cpf</td>
                            <td>Telefone</td>
                            <th>Status</td>
                            <th>Data de Cadastro</th>
                            <th>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>

                                @if(!is_null($user->admin_id))
                                    @if (!is_null($employee->employee_id))
                                        <td class="text-center">Funcionário(a)</td> 
                                    @elseif(!is_null($employee->coordinator_id))   
                                        <td class="text-center">Cordenador(a)</td>          
                                    @else
                                        <td class="text-center">Administrador(a)</td>                          
                                    @endif
                                @endif

                                <td>{{ $employee->email }}</td>

                                <td class="text-center">{{ $employee->cpf }}</td>
                                <td class="text-center">{{ $employee->phone }}</td>

                                @if($employee->status == 0)
                                    <td class="text-center">Inativo</td>
                                @else
                                    <td class="text-center">Ativo</td>
                                @endif

                                <td class="text-center">
                                    {{ date('d/m/Y', strtotime($employee->created_at)) }}
                                </td>
                                
                                <td class="text-center">
                                    <a href="{{ route('employee.edit', $employee->id) }}">
                                        <i class="fa-solid fa-user-pen black-color"></i>
                                    </a>
                                    
                                    <strong style="margin: 0 10px;">|</strong>

                                    <a href="{{ route('employee.destroy', $employee->id  ) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employee->id }}">
                                        <i class="fa-solid fa-user-minus black-color"></i>
                                    </a>

                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir 
                                                            {{ !is_null($employee->employee_id) ? 'funcionário' : 'coordinator' }}(a)
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        Deseja realmente excluir o {{ !is_null($employee->employee_id) ? 'funcionário' : 'coordinator' }}(a) <strong>{{ $employee->name }}</strong>?
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="d-flex justify-content-center">
                {{ $employees->appends(['sort' => 'department'])->links() }}
            </div>
        @else
            <tr>
                <td colspan="7">
                    <p>Ainda não há nenhum funcionário cadastrado... <a href="#">Clique aqui para cadastrar o primeiro.</a></p>
                </td>
            </tr>
        @endif
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