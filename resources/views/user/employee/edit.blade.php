@extends('layouts.template')

@section('title', 'Editar ' . $employee->name . ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar Funcionário(a): {{  $employee->name }} </h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('update.employee', $employee->id) }}" enctype="multipart/form-data">
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
    </main>

    <script>
        const name = "{{ $employee->name }}";
        const username = "{{ $employee->username }}";
        const stats = "{{ $employee->stats }}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newName = document.querySelector("#name").value;
            var newUsername = document.querySelector("#username").value;
            var newStats = document.querySelector("#stats").value;

            if(name != newName || username != newUsername || stats != newStats){
               btnSubmit.removeAttribute("disabled");
            } else{
                btnSubmit.setAttribute("disabled", "disabled");
            }
        }
    </script>
@endsection