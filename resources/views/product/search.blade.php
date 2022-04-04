@extends('layouts.template')

@section('title', 'Pesquisar Produto - Storage System')

@section('content')
<h1 class="text-center mt-4 mb-5">Pesquisar Produto</h1>

<main>
    <div class="container">
        <form method="POST" action="{{ route('search.product', 'search') }}">
            @csrf

            <div class="input-group">
                <input id="input-pesq" class="form-control" name="search" type="text" placeholder="Digite o nome do produto...">
                <button id="btn-pesq" class="btn btn-default" type="submit" name="pesquisarProduto">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            
        </form>
    </div>
</main>

@endsection