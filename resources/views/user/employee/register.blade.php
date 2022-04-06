@extends('layouts.template')

@section('title', 'Cadastrar Funcionário(a) - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Funcionário</h1>

    <main>
        <div class="container w-50 p-3 form">
            <form method="POST" action="{{ route('create.employee') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo do funcionário(a)" required>
                    <label for="name" class="required">Nome Completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Nome de usuário" required>
                    <label for="username" class="required">Nome de Usuário</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Insira a senha" required onkeyup="check();">
                    <label for="password" class="required">Senha</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="passwordConf" class="form-control" id="passwordConf" placeholder="Confirme a senha" required onkeyup="check();">
                    <label for="passwordConf" class="required">Confirme a Senha</label>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <input type='submit' class="btn btn-info text-center" id="btn-register" value='Cadastrar'>
                    </div>
                </div>  

            </form>
        </div>
    </main>

    <script>
        var btnRegister = document.querySelector('#btn-register');

        function check(){
            var password = document.querySelector('#password').value;
            var passwordConf = document.querySelector('#passwordConf').value;

            if(password != passwordConf || password == "" || passwordConf == ""){
                btnRegister.setAttribute('disabled', 'disabled');
            } else{
                btnRegister.removeAttribute("disabled");
            }
        }
    </script>
@endsection