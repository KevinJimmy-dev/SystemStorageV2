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
                        <th>Data de Cadastro</th>
                        <th>Ações</td>
                    </tr>
                </thead>
                <tbody>
                @if($employees)
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
                                    <a href="{{ route('edit.employee', $employees[$i]['id']) }}">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a>
                                    
                                    <strong style="margin: 0 10px;">|</strong>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fa-solid fa-user-minus"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endfor
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
    </div>
@endsection