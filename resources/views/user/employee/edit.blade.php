@extends('layouts.template')

@section('title', 'Editar ' . $employee->name . ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">
        Editar {{ !is_null($employee->employee_id) ? "Funcionário(a):" : "Cordenador(a):"}} 
        {{  $employee->name }} 
    </h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $employee->name }}" placeholder="Nome do Funcionário(a)" required onkeyup="check()">
                    <label for="name" class="required">Nome Completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="cpf" class="form-control" id="cpf" placeholder="Cpf" required minlength="1" maxlength="11" value="{{ $employee->cpf }}" onkeyup="check()">
                    <label for="cpf" class="required">Cpf</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Telefone" required minlength="1" maxlength="15" value="{{ $employee->phone }}" onkeyup="check()">
                    <label for="phone" class="required">Número de telefone</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="status" required onchange="check();">
                        <option value="0" {{ $employee->status == 0 ? 'selected' : "" }}>Inativo</option>
                        <option value="1" {{ $employee->status == 1 ? 'selected' : "" }}>Ativo</option>                           
                    </select>
                    <label for="status" class="required">Status</label>
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
        const cpf = "{{ $employee->cpf }}";
        const phone = "{{ $employee->phone }}";
        const status = "{{ $employee->status }}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newName = document.querySelector("#name").value;
            var newCpf = document.querySelector("#cpf").value;
            var newPhone = document.querySelector("#phone").value;
            var newStatus = document.querySelector("#status").value;

            if(name != newName || cpf != newCpf || phone != newPhone || status != newStatus){
                btnSubmit.removeAttribute("disabled");
            } else{
                btnSubmit.setAttribute("disabled", "disabled");
            }
        }
    </script>
@endsection