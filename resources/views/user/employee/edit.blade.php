@extends('layouts.template')

@section('title', 'Editar ' . $employee->name . ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar {{ $employee->level == 1 ? "Funcionário(a):" : "Cordenador(a):"}} {{  $employee->name }} </h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $employee->id }}">

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $employee->name }}" placeholder="Nome do Funcionário(a)" required onkeyup="check();">
                    <label for="name" class="required">Nome</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="username" value="{{ $employee->username }}" placeholder="Nome de Usuário do Funcionário(a)" required onkeyup="check();">
                    <label for="username" class="required">Nome de Usuário</label>
                </div>

                @if($userLevel['level'] == 3)
                    <div class="form-floating mb-3">
                        <select name="level" class="form-select" id="level" required onclick="check();">
                            <option value="1" {{ $employee->level == 1 ? "selected='selected'" : "" }}>Funcionário(a)</option>
                            <option value="2" {{ $employee->level == 2 ? "selected='selected'" : "" }}>Cordenador(a)</option>                           
                        </select>
                        <label for="level" class="required">Função</label>
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <select name="stats" class="form-select" id="stats" required onclick="check();">
                        <option value="0" {{ $employee->stats == 0 ? "selected='selected'" : "" }}>Inativo</option>
                        <option value="1" {{ $employee->stats == 1 ? "selected='selected'" : "" }}>Ativo</option>                           
                    </select>
                    <label for="stats" class="required">Status</label>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <input type='submit' class="btn btn-info text-center" id="btn-update" value='Editar' disabled>
                    </div>
                </div>  

            </form>
        </div>

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Campos já preenchidos com os dados do usuário selecionado;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder editar o usuário que selecionou.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Podendo Editar:</strong> Você pode editar o Nome dele, o nome de usuário e o status dele (ativo: pode acessar o sistema, inativo: não podendo acessar o sistema);</li>
                    <li>- <strong>Editar Usuário:</strong> No começo o botão vem desativado, para ativa-lo você tem que mudar alguma informação dentro do campo, para ficar diferente da original. Depois disso basta clicar no botão "Editar";</li>
                    
    
                    <br>

                    <hr>

                    <p><strong>OBS:</strong> Caso mude o nome de usuário, seria bom avisa-lo disso, para ele poder acessar o sistema!</p>
                </ul>
            </div>
        @endsection

    </main>

    <script>
        const name = "{{ $employee->name }}";
        const username = "{{ $employee->username }}";
        const func = "{{ $employee->level }}";
        const stats = "{{ $employee->stats }}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newName = document.querySelector("#name").value;
            var newUsername = document.querySelector("#username").value;
            var newFunc = document.querySelector("#level");
            var newStats = document.querySelector("#stats").value;

            if(newFunc){
                if(name != newName || username != newUsername || func != newFunc.value || stats != newStats){
                    btnSubmit.removeAttribute("disabled");
                } else{
                    btnSubmit.setAttribute("disabled", "disabled");
                }
            } else{
                if(name != newName || username != newUsername || stats != newStats){
                    btnSubmit.removeAttribute("disabled");
                } else{
                    btnSubmit.setAttribute("disabled", "disabled");
                }
            }
        }
    </script>
@endsection