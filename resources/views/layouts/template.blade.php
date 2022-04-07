<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/09a5251690.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/home.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand">
            <div class="brand-title">
                <abbr title="Página Inicial">
                    <a href="{{ route('home.user') }}">
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
                    @if($userLevel['level'] >= 2)
                        <li class="dropdown">
                            <abbr title="Menu Funcionários">
                                <a class="dropdown-toggle li-color" href="#" data-bs-toggle="dropdown">
                                        <strong>
                                            Funcionários <i class="fas fa-users"></i>
                                        </strong>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home.employee') }}">
                                            Exibir Funcionários
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('viewRegister.employee') }}">
                                            Cadastrar Funcionário(a)
                                        </a>
                                    </li>
                                </ul>
                            </abbr>
                        </li>
                    @endif
                    <li class="dropdown">
                        <abbr title="Menu Categorias">
                            <a class="dropdown-toggle li-color" href="#" data-bs-toggle="dropdown">
                                <strong>
                                    Categorias <i class="fas fa-list"></i>
                                </strong>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('home.categorie') }}" class="li-color">
                                        Exibir Categorias
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('viewRegister.categorie') }}">
                                        Cadastrar Categoria
                                    </a>
                                </li>
                            </ul>
                        </abbr>
                    </li>
                    <li>
                        <abbr title="Cadastrar Produto">
                            <a href="{{ route('viewRegister.product') }}" class="li-color">
                                <strong>
                                    Cadastrar Produto <i class="fas fa-plus"></i>
                                </strong>
                            </a>
                        </abbr>
                    </li>
                    <li>
                        <abbr title="Pesquisar Produto">
                            <a href="{{ route('viewSearch.product') }}" class="li-color">
                                <strong>
                                    Pesquisar Produto <i class="fas fa-magnifying-glass"></i>
                                </strong>
                            </a>
                        </abbr>
                    </li>
                    <li>
                        <abbr title="Fazer Requisição">
                            <a href="{{ route('requestView') }}" class="li-color">
                                <strong>
                                    Requisição <i class="fas fa-utensils"></i>
                                </strong>
                            </a>
                        </abbr>
                    </li>

                    <li>
                        <abbr title="Sair (logout)">
                            <a href="{{ route('logout') }}">
                                <strong>
                                     Sair <i class="fas fa-arrow-right-from-bracket"></i>
                                </strong>
                            </a>
                        </abbr>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container body-content mt-5">
        @if(session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif
        @if(session('msgWarning'))
            <p class="msgWarning">{{ session('msgWarning') }}</p>
        @endif
        @if(session('msgError'))
            <p class="msgError">{{ session('msgError') }}</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="/js/navbar.js"></script>
</body>

</html>