@extends('layouts.template')

@section('title', 'Cadastrar Produto - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-5">Cadastrar Produto</h1>

    <main>
        <div class="container w-50 p-3 form">
            <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome do Produto" required minlength="2" maxlength="20">
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
                    <input type="number" name="quantity" class="form-control" id="quantity" step=".01" placeholder="Insira a quantidade" required minlength="1" maxlength="9">
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
                    <textarea type="text" name="observation" class="form-control" id="observation" placeholder="Insira uma obsevação (se tiver)" maxlength="250"></textarea>
                    <label for="obsevation">Observação</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select select" id="category_id" required oninvalid="this.setCustomValidity('Selecione uma categoria!')" onchange="try{setCustomValidity('')}catch(e){}">
                        <option value="">Selecione uma categoria</option> 
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">
                                {{ $categorie->name_categorie }}
                            </option>
                        @endforeach            
                    </select>
                    <label for="category_id" class="required">Categoria</label>
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

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Campos para cadastrar um novo produto;</li>
                    <li>- Um botão para executar a ação;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder cadastrar um novo produto.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Cadastrar Produto:</strong> Para cadastrar basta preencher todos os campos corretamente e clicar no botão "Cadastrar", e depois disso o produto já será cadastrado no sistema!</li>   
                </ul>
            </div>
        @endsection

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