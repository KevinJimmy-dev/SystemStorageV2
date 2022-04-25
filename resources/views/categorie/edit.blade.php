@extends('layouts.template')

@section('title', 'Editar ' . $categorie->name_categorie .  ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar Categoria: {{$categorie->name_categorie}}</h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('category.update', $categorie->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="newCategorie" required name="name_categorie" maxlength="75" placeholder="Digite o nome da categoria" value="{{$categorie->name_categorie}}" onkeyup="check();">
                    <label for="newCategorie" class="required">Nome da Categoria</label>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input class="btn btn-info mt-4" id="btn-update" type="submit" value="Editar" disabled>
                    </div>
                </div>
            </form>
        </div>

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Campo já preenchido com o nome da categoria selecionada;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder editar a categoria que selecionou.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Podendo Editar:</strong> O nome da categoria;</li>
                    <li>- <strong>Editar Produto:</strong> No começo o botão vem desativado, para ativa-lo você tem que mudar alguma informação dentro do campo, para ficar diferente da original. Depois disso basta clicar no botão "Editar";</li>
                </ul>
            </div>
        @endsection

    </main>
    
    <script>
        const categorieValue = "{{$categorie->name_categorie}}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newCategorie = document.querySelector("#newCategorie").value;

            if(categorieValue != newCategorie){
               btnSubmit.removeAttribute("disabled");
            } else{
                btnSubmit.setAttribute("disabled", "disabled");
            }
        }
    </script>
@endsection