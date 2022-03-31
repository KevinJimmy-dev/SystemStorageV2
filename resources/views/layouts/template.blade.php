<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/home.css">

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="brand-title">
                <abbr title="Página Inicial">
                    <a href="{{ route('home.employee') }}">
                        <img class="img-logo" src="/img/logo-storage1.png" alt="Logo 'Storage System', duas palavras em inglês: Storage = Armazenameto e System = Sistema. Storage está acima do system, fazendo uma espécie de degrau, do lado do storage possui um chapéu de cozinheiro." width="120px">
                    </a>
                </abbr>
            </div>

            <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>

            <div class="navbar-links">
                <ul>
                    @if($userLevel['level'] == 3)
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <strong>Cordenadores <i class="fa-solid fa-address-book"></i> </strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">
                                    Exibir Cordenadores
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Cadastrar Cordenador(a)
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if($userLevel['level'] >= 2)
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <strong>Funcionários <i class="fa-solid fa-address-book"></i> </strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">
                                    Exibir Funcionários
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Cadastrar Funcionário(a)
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    {{-- Dropdown Categorias --}}
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <strong>Categorias <i class="fa-solid fa-list"></i> </strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('home.categorie') }}">
                                    Exibir Categorias
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('viewRegister.categorie') }}">
                                    Cadastrar Categoria
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="li-color">
                            <strong>
                                Cadastrar Produto <i class="fa-solid fa-plus"></i>
                            </strong>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="li-color">
                            <strong>
                                Pesquisar Produto <i class="fa-solid fa-magnifying-glass"></i>
                            </strong>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="li-color">
                            <strong>
                                Requisição <i class="fa-solid fa-utensils"></i>
                            </strong>
                        </a>
                    </li>

                    <li>
                        <a class="sair-li" href="{{ route('logout') }}">
                            <strong class="black-color">
                                Sair <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </strong>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container body-content mt-5">
            @if(session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            @yield('content')
    </div>

    <footer class="text-md-start text-muted rodape">
        <section class="">
            <div class="container text-md-start mt-5 div-footer">
                <div class="row mt-3 div-footer">
                    <div class="col-md-3 col-md-4 col-md-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 titles mt-4">
                            Sobre Storage. System
                        </h6>
                        <p class="sobre white-color">
                            Esse site foi desenvolvido pelo Squad Fine Crew, com 4 integrantes, sendo eles: Allyfer, Kevin, Maria Eduarda e Paulo.<br>
                            O objetivo dele é ajudar e facilitar o trabalho do setor da cozinha do Marista Ir. Acácio.
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 sides">
                        <h6 class="text-uppercase fw-bold mb-4 mt-4">
                            Precisa de ajuda?
                        </h6>
                        <p>
                            <a href="#!" class="text-reset white-color">
                                <i class="fa-solid fa-circle-question white-color"></i>
                                Clique aqui
                            </a>
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4 mt-4">
                            Contatos
                        </h6>
                        <div class="">
                            <p>
                                <a href="https://www.instagram.com/allyfer16/" target="_blank" class="white-color">
                                    <i class="fa-brands fa-instagram"></i>
                                    Allyfer - Front-End
                                </a>
                            </p>
                            <p>
                                <a href="https://www.instagram.com/kevin_jim.my/" target="_blank" class="white-color">
                                    <i class="fa-brands fa-instagram"></i>
                                    Kevin - Back-End e Front-End
                                </a>
                            </p>
                            <p>
                                <a href="#" class="white-color">
                                    <i class="fa-brands fa-instagram"></i>
                                    Maria Eduarda - Design
                                </a>
                            </p>
                            <p>
                                <a href="https://www.instagram.com/paulo.henriq512/" target="_blank" class="white-color">
                                    <i class="fa-brands fa-instagram"></i>
                                    Paulo Henrique - Front-End
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    {{-- Bootstrap 5.1 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    {{-- Navbar --}}
    <script src="/js/navbar.js"></script>

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/09a5251690.js" crossorigin="anonymous"></script>

</body>

</html>