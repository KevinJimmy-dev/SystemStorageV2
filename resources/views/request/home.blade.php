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

                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..." aria-label="search" aria-describedby="basic-addon1" id="search">
                        <span class="input-group-text searchSpan" id="basic-addon1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                    </div>
                </form>
                <div id="list-result">
                    <ul id="results">

                    </ul>
                </div>
            </div>
        </div>

        <div class="container mt-3 mb-3 my-3">
            <div class="table-responsive" id="tbl">
                <table class="tabela table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Produto</td>
                            <th>Quantidade Disponível</td>
                            <th>Quantidade Requerida</td>
                            <th>Remover</td>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        $(function() {

            $("#search").keyup(function() {

                var search = $(this).val();

                if (search != "") {
                    var dados = {
                        word: search
                    }

                    $.get("{{ route('requestSearch') }}", dados, function(retorna) {
                        $('#results').html(retorna);
                    });

                } else {
                    $('#results').html('');
                }
            });
        });

        function add(id, name, quantity){
            var tbody = document.querySelector('#tbody');
            var tbl = document.querySelector('#tbl');

            var tr  = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var hidden = document.createElement('td');

            td1.innerHTML = name;
            td2.innerHTML = "<input type='number' value='" + quantity + "' readonly>";
            td3.innerHTML = "<input type='text'>";
            hidden.innerHTML = "<input type='hidden' value='" + id + "'>";

            tbody.appendChild(tr);
            tbl.appendChild(hidden);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
        }
    </script>
@endsection