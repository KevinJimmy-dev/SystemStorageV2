<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Storage System</title>

    {{-- Css  --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="/img/icon.PNG" type="image/x-icon">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="antialiased">
    <div class="container">

        <div class="row marcador align-items-center">
            <div class="col mx-auto text-center">
                <a href="/login">
                    <img class="img-responsive" src="/img/logo-storage.png" id="logo-storage" alt="Logo 'Storage System', duas palavras em inglês: Storage = Armazenameto e System = Sistema. Storage está acima do system, fazendo uma espécie de degrau, do lado do storage possui um chapéu de cozinheiro.">
                </a>
            </div>
        </div>
        
        <div>
            <div class="row marcador">
                <div class="col mx-auto">
                    <img class="img-responsive" src="/img/logo-marista.png" id="logo-marista" alt="Logo Marista. A letra 'M', com várias estrelinhas azuis acima dela. Nas pontas da letra M, possui uma espécie de 'asa', não pontudas, mas também não redondas.">
                </div>
            </div>
        </div>

    </div>

    {{-- Js Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>