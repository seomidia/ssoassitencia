<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{setting('site.title')}}</title>
    <meta name="description" content="{{setting('site.description')}}">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom-style.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>
<div class="site-wrap">
    <!--HEADER-->
    @if(Auth::check())

    <div class="topbar">
        <div class="site-navbar color-header py-2">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="main-nav d-none d-lg-block"></div>
                    <div class="icons">

                        <i class="fas fa-user"></i> Ola, {{\Auth::user()->name}}
                        <a href="http://dev.sso.com/admin" style="color: #000000;margin-left: 16px;"><i class="fas fa-tachometer-alt"></i> Painel </a>
                        <a href="http://dev.sso.com/logout" id="logout" style="color: #8b0000;margin-left: 16px;"><i class="fas fa-power-off"></i> Sair</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif


    <div class="site-navbar color-header py-2">
        <!--CAMPO DE BUSCA DE EXAMES-->
        <div class="search-wrap">
            <div class="container">
                <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                <form action="{{url('/buscar')}}" method="post">
                    @csrf
                    <input type="text" class="form-control" name="s" placeholder="Buscar exame...">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo">
                    <div class="site-logo">
                        <a href="{{url('/')}}" class="js-logo-clone">
                            <img src="{{url('/')}}/storage/{{setting('site.logo')}}"  alt="Logo {{setting('site.title')}}" title="{{setting('site.title')}}">
                        </a>
                    </div>
                </div>
                <div class="main-nav d-none d-lg-block">
                    <nav class="site-navigation text-right text-md-center" role="navigation">
                        {!! menu('menu open','partials.menu.menu') !!}
                    </nav>
                </div>
                <div class="icons">
                    <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                    <a href="/carrinho" class="icons-btn d-inline-block bag" style="margin-right: 20px">
                        <span class="icon-shopping-bag"></span>
                        <span class="number">{{\App\Cart::ChecCartFront()}}</span>
                    </a>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                            class="icon-menu"></span></a>
                </div>
            </div>
        </div>
    </div>
    <!--END HEADER-->
