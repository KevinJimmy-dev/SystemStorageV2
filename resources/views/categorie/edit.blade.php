@extends('layouts.template')

@section('title', 'Editar ' . $categorie->name_categorie .  ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar Categoria: {{$categorie->name_categorie}}</h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('update.categorie', $categorie->id) }}" enctype="multipart/form-data">
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