@extends('layouts.main')

@section('css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css')
@section('integrityCss', 'sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO')
@section('crossoriginCss', 'anonymous')

@section('css2', '/css/home.css')

@section('content')

@extends('layouts.headerEmployee')

Página de funcionario

<br>

<a href="{{ route('logout') }}">Sair</a>

{{-- Bootstrap 5.1 --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

{{-- Navbar --}}
<script src="../../../Controller/Pages/_js/navbar.js"></script>

<script src="https://kit.fontawesome.com/09a5251690.js" crossorigin="anonymous"></script>

@endsection