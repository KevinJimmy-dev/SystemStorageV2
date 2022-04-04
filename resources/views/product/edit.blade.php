@extends('layouts.template')

@section('title', 'Editar ' . $product->name . ' - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Editar Produto: {{  $product->name }} </h1>

    <main>
        <div class="container w-50 p-3">
            <form method="POST" action="{{ route('update.product', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" placeholder="Nome do Produto" required onkeyup="check();">
                    <label for="name" class="required">Produto</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="storageUnity" class="form-select" id="storageUnity" required onkeyup="check();">
                        <option value="Kg" {{ $product->storageUnity == "Kg" ? "selected='selected'" : "" }}>Kg - Quilograma</option>
                        <option value="g" {{ $product->storageUnity == "g" ? "selected='selected'" : "" }}>g - Grama</option>        
                        <option value="L" {{ $product->storageUnity == "L" ? "selected='selected'" : "" }}>L - Litro</option>
                        <option value="Un" {{ $product->storageUnity == "Un" ? "selected='selected'" : "" }}>Un - Unidades</option>                    
                    </select>
                    <label for="storageUnity" class="required">Unidade de medida</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="quantity" class="form-control" id="quantity" step=".01" value="{{ $product->quantity }}" placeholder="Insira a quantidade" required onkeyup="check();">
                    <label for="quantity" class="required">Quantidade</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="deliveryDate" class="form-control" id="deliveryDate" value="{{ $product->deliveryDate }}" min="2022-01-01" placeholder="Insira a data de entrega" required onkeyup="check();">
                    <label for="deliveryDate" class="required">Data de entrega</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="expirationDate" class="form-control" id="expirationDate" value="{{ $product->expirationDate }}" min="2022-01-01" placeholder="Insira a data de validade" required onkeyup="check();">
                    <label for="expirationDate" class="required">Data de Validade</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea type="text" name="observation" class="form-control" id="observation" placeholder="Insira uma obsevação (se tiver)" onkeyup="check();">{{ $product->observation }}</textarea>
                    <label for="obsevation">Observação</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="categorie_id" class="form-select" id="categorie_id" required onkeyup="check();">
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $categorie->id == $product->categorie_id ? "selected='selected'" : "" }}>
                                {{ $categorie->name_categorie }}
                            </option>
                        @endforeach            
                    </select>
                    <label for="categorie_id" class="required">Categoria</label>
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
        const productValue = "{{$product->name}}";
        const storageUnityValue = "{{$product->storageUnity}}";
        const quantityValue = "{{$product->quantity}}";
        const deliveryDateValue = "{{$product->deliveryDate}}";
        const expirationDateValue = "{{$product->expirationDate}}";
        const obsevationValue = "{{$product->observation}}";
        const categorieValue = "{{$product->categorie_id}}";
        const btnSubmit = document.querySelector("#btn-update");

        function check(){
            var newProduct = document.querySelector("#name").value;
            var newStorageUnity = document.querySelector("#storageUnity").value;
            var newQuantity = document.querySelector("#quantity").value;
            var newDeliveryDate = document.querySelector("#deliveryDate").value;
            var newExpirationDate = document.querySelector("#expirationDate").value;
            var newObservation = document.querySelector("#observation").value;
            var newCategorie = document.querySelector("#categorie_id").value;

            if(productValue != newProduct || storageUnityValue != newStorageUnity || quantityValue != newQuantity || deliveryDateValue != newDeliveryDate || expirationDateValue != newExpirationDate || obsevationValue != newObservation || categorieValue != newCategorie){
               btnSubmit.removeAttribute("disabled");
            } else{
                btnSubmit.setAttribute("disabled", "disabled");
            }
        }
    </script>
@endsection