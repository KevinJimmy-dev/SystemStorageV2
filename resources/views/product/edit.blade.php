@extends('layouts.template')

@section('title', 'Editar ' . $product->name . ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar Produto: {{  $product->name }} </h1>
    {{-- <p>Criado por {{ $product->user }}</p> --}}

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" placeholder="Nome do Produto" required onkeyup="check();">
                    <label for="name" class="required">Produto</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="storage_unity" class="form-select" id="storage_unity" required onchange="check();">
                        <option value="Kg" {{ $product->storage_unity == "Kg" ? "selected='selected'" : "" }}>Kg - Quilograma</option>
                        <option value="g" {{ $product->storage_unity == "g" ? "selected='selected'" : "" }}>g - Grama</option>        
                        <option value="L" {{ $product->storage_unity == "L" ? "selected='selected'" : "" }}>L - Litro</option>
                        <option value="Un" {{ $product->storage_unity == "Un" ? "selected='selected'" : "" }}>Un - Unidades</option>                    
                    </select>
                    <label for="storage_unity" class="required">Unidade de medida</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="quantity" class="form-control" id="quantity" step=".01" value="{{ $product->quantity }}" placeholder="Insira a quantidade" required onkeyup="check();">
                    <label for="quantity" class="required">Quantidade</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="delivery" class="form-control" id="delivery" value="{{ $product->delivery }}" min="2022-01-01" placeholder="Insira a data de entrega" required onchange="check();">
                    <label for="delivery" class="required">Data de entrega</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="expiration" class="form-control" id="expiration" value="{{ $product->expiration }}" min="2022-01-01" placeholder="Insira a data de validade" required onchange="check();">
                    <label for="expiration" class="required">Data de Validade</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea type="text" name="observation" class="form-control" id="observation" placeholder="Insira uma obsevação (se tiver)" onkeyup="check();">{{ $product->observation }}</textarea>
                    <label for="obsevation">Observação</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select" id="category_id" required onclick="check();">
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $categorie->id == $product->category_id ? "selected='selected'" : "" }}>
                                {{ $categorie->name_category }}
                            </option>
                        @endforeach            
                    </select>
                    <label for="category_id" class="required">Categoria</label>
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
                    <li>- Campos já preenchidos com os dados do produto selecionado;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder editar o produto que selecionou.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Podendo Editar:</strong> Você pode editar o nome, a unidade de medida, a quantidade, a data de entrega e validade, a observação e a categoria que ele pertence;</li>
                    <li>- <strong>Editar Produto:</strong> No começo o botão vem desativado, para ativa-lo você tem que mudar alguma informação dentro do campo, para ficar diferente da original. Depois disso basta clicar no botão "Editar";</li>
                </ul>
            </div>
        @endsection

    </main>

    <script>
        const productValue = "{{ $product->name }}";
        const storageUnityValue = "{{ $product->storage_unity }}";
        const quantityValue = "{{ $product->quantity }}";
        const deliveryValue = "{{ $product->delivery }}";
        const expirationValue = "{{ $product->expiration }}";
        const obsevationValue = "{{ $product->observation }}";
        const categoryValue = "{{ $product->category_id }}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newProduct = document.querySelector("#name").value;
            var newStorageUnity = document.querySelector("#storage_unity").value;
            var newQuantity = document.querySelector("#quantity").value;
            var newDeliveryDate = document.querySelector("#delivery").value;
            var newExpirationDate = document.querySelector("#expiration").value;
            var newObservation = document.querySelector("#observation").value;
            var newCategory = document.querySelector("#category_id").value;

            if(productValue != newProduct || storageUnityValue != newStorageUnity || quantityValue != newQuantity || deliveryValue != newDeliveryDate || expirationValue != newExpirationDate || obsevationValue != newObservation || categoryValue != newCategory){
               btnSubmit.removeAttribute("disabled");
            } else{
                btnSubmit.setAttribute("disabled", "disabled");
            }
        }
    </script>
@endsection