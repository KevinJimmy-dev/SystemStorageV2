@extends('layouts.template')

@section('title', 'Cadastrar Funcionário(a)')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Funcionário</h1>

    <main>
        <div class="container w-50 p-3 form">
            <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo do funcionário(a)" required minlength="4" maxlength="20" value="{{ old('name') }}">
                    <label for="name" class="required">Nome Completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required minlength="4" value="{{ old('email') }}">
                    <label for="email" class="required">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="cpf" class="form-control" id="cpf" placeholder="Cpf" required minlength="1" maxlength="11" value="{{ old('cpf') }}">
                    <label for="cpf" class="required">Cpf</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Telefone" required minlength="1" maxlength="15" value="{{ old('phone') }}">
                    <label for="phone" class="required">Número de telefone</label>
                </div>

                @if(!is_null(auth()->user()->admin_id))
                    <div class="form-floating mb-3">
                        <select name="function" class="form-select" id="function" required>
                            <option value="">Selecione a função</option>
                            <option value="employee" {{ old('function') == 'employee' ? 'selected' : '' }}>Funcionário(a)</option>
                            <option value="coordinator" {{ old('function') == 'coordinator' ? 'selected' : '' }}>Cordenador(a)</option>                           
                        </select>
                        <label for="function" class="required">Função</label>
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Insira a senha" required onkeyup="check();">
                    <label for="password" class="required">Senha</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirme a senha" required minlength="3" maxlength="16" onkeyup="check();">
                    <label for="password_confirmation" class="required">Confirme a Senha</label>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <input type='submit' class="btn btn-info text-center" id="btn-register" value='Cadastrar'>
                    </div>
                </div>  

            </form>
        </div>

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Campos para cadastrar um novo funcionário;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder cadastrar um novo funcionário.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Cadastrar Usuário:</strong> Para cadastrar basta preencher todos os campos corretamente e clicar no botão "Cadastrar", e depois disso o funcionário já tera acesso ao sistema!</li>   
                </ul>
            </div>
        @endsection

    </main>

    <script src="/js/password.js"></script>
@endsection