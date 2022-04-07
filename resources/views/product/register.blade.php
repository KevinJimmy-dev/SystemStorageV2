@extends('layouts.template')

@section('title', 'Cadastrar Produto - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Produto</h1>

    <main>
        <div class="container w-50 p-3 form">
            <form method="POST" action="{{ route('create.product') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome do Produto" required>
                    <label for="name" class="required">Produto</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="storageUnity" class="form-select select" id="storageUnity" required>
                        <option value="">Selecione uma unidade de medida</option>
                        <option value="Kg">Kg - Quilograma</option>
                        <option value="g">g - Grama</option>        
                        <option value="L">L - Litro</option>
                        <option value="Un">Un - Unidades</option>                    
                    </select>
                    <label for="storageUnity" class="required">Unidade de medida</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="quantity" class="form-control" id="quantity" step=".01" placeholder="Insira a quantidade" required>
                    <label for="quantity" class="required">Quantidade</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="deliveryDate" class="form-control" id="deliveryDate" min="2022-01-01" placeholder="Insira a data de entrega" required onblur="validate();">
                    <label for="deliveryDate" class="required">Data de entrega</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="expirationDate" class="form-control" id="expirationDate" min="2022-01-01" placeholder="Insira a data de validade" required onblur="validate();">
                    <label for="expirationDate" class="required">Data de Validade</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea type="text" name="observation" class="form-control" id="observation" placeholder="Insira uma obsevação (se tiver)"></textarea>
                    <label for="obsevation">Observação</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="categorie_id" class="form-select select" id="categorie_id" required oninvalid="this.setCustomValidity('Selecione uma categoria!')" onchange="try{setCustomValidity('')}catch(e){}">
                        <option value="">Selecione uma categoria</option> 
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">
                                {{ $categorie->name_categorie }}
                            </option>
                        @endforeach            
                    </select>
                    <label for="categorie_id" class="required">Categoria</label>
                </div>

                <div class="row">
                <abbr title="" id="warning">
                    <div class="col text-center">
                        
                            <input type='submit' class="btn btn-info text-center" id="btn-register" value='Cadastrar'>
                    </div>
                    </abbr>
                </div>  

            </form>
        </div>
    </main>

    <script>
        function validate(){
            var deliveryDate = document.querySelector('#deliveryDate');
            var validate = document.querySelector('#expirationDate');
            const btnRegister = document.querySelector('#btn-register');
            var abbr = document.querySelector('#warning');

            if(deliveryDate.value >= validate.value){
                deliveryDate.style.border = "1px solid #ff000044";
                validate.style.border = "1px solid #ff000044";
                btnRegister.setAttribute('disabled', 'disabled');
                abbr.title = 'Atenção! A data de entrega deve ser maior do que a de validade!';

            } else{
                deliveryDate.style.border = "1px solid #5fcbd7";
                validate.style.border = "1px solid #5fcbd7";
                btnRegister.removeAttribute('disabled');
                abbr.removeAttribute('title');
            }
        }
    </script>
@endsection