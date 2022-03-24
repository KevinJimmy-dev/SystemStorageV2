<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="@yield('css')" integrity="@yield('integrityCss')" crossorigin="@yield('crossoriginCss')">
    <link rel="stylesheet" href="@yield('css2')">

    <title>@yield('title')</title>
</head>

<body>
    @yield('content')

    @yield('js')
    @yield('js2')
    @yield('js3')
</body>

</html>