@extends('layouts.template')

@section('title', 'Requisição - Storage System')

@section('content')
    <h1 class="text-center mt-4 mb-4">Fazer Requisição</h1>

    <main>
        <div class="container mt-3 mb-3 my-3 w-50 p-3">
            <div class="text-center search-group">
                <form method="get" id="form-search" action="" autocomplete="off">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..." aria-label="search" aria-describedby="basic-addon1" id="search" onfocus="onFocus();">

                        <span class="input-group-text searchSpan" id="basic-addon1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                </form>

                <div id="list-result">
                    <ul id="results"></ul>
                </div>
            </div>
        </div>

        <form action="{{ route('request.request') }}" method="get">
            <div class="container mt-3 mb-3 my-3">
                <div class="table-responsive" id="tbl">
                    <table class="tabela table table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>Produto</td>
                                <th>Quantidade Disponível</td>
                                <th>Quantidade Requerida</td>
                                <th>Remover</td>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
                <div class="row mt-4">
                    <div class="col text-center">
                        <input type='submit' class="btn btn-info text-center" id="btn-update" value='Requisitar'>
                    </div>
                </div>
            </div>
        </form>

        @section('modalContent')
            <div>
                <h4># O que essa página contém?</h4>
                <ul>
                    <li>- Menu de navegação;</li>
                    <li>- Barra de pesquisa de produto;</li>
                    <li>- Uma tabela que recebe o produto desejado;</li>
                    <li>- Um botão na tabela que remove o produto dela;</li>
                    <li>- Um botão que faz a ação de requisitar;</li>
                    <li>- E um rodapé;</li>
                </ul>
            </div>

            <div>
                <h4># Qual o Objetivo da página?</h4>
                <p>
                    - O principal objetivo é você poder requisitar um ou mais produtos desejados.
                </p>
            </div>

            <br>
        
            <div>
                <h4># Como usar a página?</h4>
                <ul>
                    <li>- <strong>Barra de Navegação:</strong> Para usa-la é simples, você pode navegar pelo site somente clicando nas opções, que irá te encaminhar para outra página;</li>
                    <li>- <strong>Barra de Pesquisa:</strong> Para pesquisar basta ir digitando o nome do produto, que atualizara ao decorrer da digitação. Para adicioná-lo a tabela, clique no botão <i class="fa-solid fa-plus"></i>, (podendo adicionar um ou mais produtos);</li>
                    <li>- <strong>Fazer Requisição:</strong> Para fazer a requisição você precisa ter adicionado um ou mais produtos na tabela, após isso você deve preencher o campo da coluna "Quantidade Requerida", depois disso clique no botão "Requisitar" e se o valor for válido de todas as requisições, irá requisitar!;</li>
                    <li>- <strong>Remover Produto:</strong> Cada linha possui um botão para remover o produto da tabela, basta clicar nele;</li>
                </ul>
            </div>
        @endsection

    </main>

    <script>
        $(function() {

            $("#search").keyup(function() {

                var search = $(this).val();

                if (search != "") {
                    var dados = {
                        word: search
                    }

                    $.get("{{ route('request.requestSearch') }}", dados, function(retorna) {
                        $('#results').html(retorna);
                    });

                } else {
                    $('#results').html('');
                }
            });
        });

        function add(id, name, quantity, unityStorage){
            var tbody = document.querySelector('#tbody');
            var tbl = document.querySelector('#tbl');

            var tr  = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');

            td1.innerHTML = name;
            td2.innerHTML = "<input type='number' required value='" + quantity + "' readonly class='input-req no-background' name='quantity[]'> " + unityStorage + "";
            td3.innerHTML = "<input type='number' required class='input-req' name='request_value[]' step='0.1'>";
            td4.innerHTML = "<abbr title='Remover'><i class='fa-solid fa-circle-minus black-color' onclick='remove(event.target);'></i></abbr> <input type='hidden' value='" + id + "' name='id_product[]'> <input type='hidden' value='" + name + "' name='name_product[]'>";

            td2.classList.add('format');

            tbody.appendChild(tr);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
        }

        function remove(elementoClicado){
            elementoClicado.closest('tr').remove();
        }

        var listResult = document.querySelector('#results'); 
        var search = document.querySelector('#search'); 

        function noFocus(){
            listResult.style.display = "none";
        }

        function onFocus(){
            listResult.style.display = "block";
        }
    </script>
@endsection