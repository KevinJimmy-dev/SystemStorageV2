@extends('layouts.template')

@section('title', 'Cadastrar Categoria - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Categoria</h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('create.categorie') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="newCategorie" required name="name_categorie" maxlength="75" placeholder="Digite o nome da categoria">
                    <label for="newCategorie" class="required">Nome da Categoria</label>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input class="btn btn-info mt-4" id="btn-register" type="submit" value="Cadastrar">
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection