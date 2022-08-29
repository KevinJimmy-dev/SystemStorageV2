<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    {{-- CSS login --}}
    <link rel="stylesheet" href="/css/loginstyle.css">

    {{-- CSS password --}}
    <link rel="stylesheet" href="/css/password.css">

    <title>Login - Storage System</title>
</head>

<body id="body">
    <section class="h-100 gradient-form" style="background-color: #f1efef;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    {{-- Logo --}}
                                    <div class="text-center">
                                        <img src="/img/logo-storage1.png" style="width: 300px;" alt="Logo Storage. System" class="">
                                    </div>

                                    {{-- Form --}}
                                    <form method="POST" action="{{ route('auth') }}">
                                        @csrf

                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" required name="email" maxlength="100" placeholder="Email">
                                            <label for="email">Email 
                                                <ion-icon name="person-outline"></ion-icon> 
                                            </label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password" required name="password" maxlength="75" placeholder="Digite a senha">
                                            <label for="password"> Senha 
                                                <ion-icon name="key-outline"></ion-icon> 
                                            </label>

                                            <div id="olho">
                                                <abbr title="Mostrar senha" id="abrev">
                                                    <ion-icon name="eye-outline" id="btn-eye" onclick="mostrar()"></ion-icon>
                                                </abbr>
                                            </div>
                                        </div>

                                        {{-- Button --}}
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <input type="submit" value="ACESSAR" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 mt-4">
                                        </div>
                                    </form>
                                    <div class="container body-content mt-5">
                                        @if(session('msgError'))
                                            <p class="msgError">{{ session('msgError') }}</p>
                                        @endif
                                        @if(session('msgWarning'))
                                            <p class="msgWarning">{{ session('msgWarning') }}</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div id="azul" class="col-lg-6 d-flex align-items-center gradient-custom-2  ">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Olá, como vai? &#128512; </h4>
                                    <p>Faça login para poder utilizar nosso sistema de gerenciamento e facilitar seu trabalho. &#128736;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/js/password.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>