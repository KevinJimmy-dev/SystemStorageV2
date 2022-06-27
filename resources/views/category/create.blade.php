@extends('layouts.template')

@section('title', 'Cadastrar Categoria - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Categoria</h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('category.create') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="newCategorie" required name="name_category" minlength="3" maxlength="20" placeholder="Digite o nome da categoria">
                    <label for="newCategorie" class="required">Nome da Categoria</label>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <input class="btn btn-info mt-4" id="btn-register" type="submit" value="Cadastrar">
                    </div>
                </div>
            </form>
        </div>

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Campo para cadastrar uma nova categoria;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder cadastrar uma nova categoria.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Cadastrar Categoria:</strong> Para cadastrar basta preencher o campo corretamente e clicar no botão "Cadastrar", e depois disso a categoria já sera cadastrada no sistema!</li>   
                </ul>
            </div>
        @endsection

    </main>
@endsection