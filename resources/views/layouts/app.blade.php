<!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>Pharma &mdash; Colorlib Template</title>
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



{{--        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>--}}
{{--        <script src="{{asset('js/jquery-ui.js')}}"></script>--}}





    </head>

      <body>

        <div class="site-wrap">

          <!--HEADER-->
          <div class="site-navbar color-header py-2">

            <!--CAMPO DE BUSCA DE EXAMES-->
            <div class="search-wrap">
              <div class="container">
                <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                <form action="#" method="post">
                  <input type="text" class="form-control" placeholder="Buscar exame...">
                </form>
              </div>
            </div>

            <div class="container">
              <div class="d-flex align-items-center justify-content-between">
                <div class="logo">
                  <div class="site-logo">
                  <a href="{{url('/')}}" class="js-logo-clone">
                      <img src="images/header/logo_final_bx.jpg"  alt="Logo SSO - Assessoria em segurança & saude ocupacional" title="SSO - Assessoria em segurança & saude ocupacional">
                    </a>
                  </div>
                </div>
                <div class="main-nav d-none d-lg-block">
                  <nav class="site-navigation text-right text-md-center" role="navigation">
                    {!! menu('menu open','header.menu.menu') !!}
                </nav>
                </div>
                <div class="icons">
                  <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                  <a href="/carrinho" class="icons-btn d-inline-block bag">
                    <span class="icon-shopping-bag"></span>
                    <span class="number">2</span>
                  </a>
                  <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                      class="icon-menu"></span></a>
                </div>
              </div>
            </div>
          </div>
            <!--END HEADER-->
            @yield('content')


    <footer class="site-footer">
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
                <h3 class="footer-heading mb-4">About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio voluptates
                sed dolorum excepturi iure eaque, aut unde.</p>
            </div>

            </div>
            <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Quick Links</h3>
            <ul class="list-unstyled">
                <li><a href="#">Supplements</a></li>
                <li><a href="#">Vitamins</a></li>
                <li><a href="#">Diet &amp; Nutrition</a></li>
                <li><a href="#">Tea &amp; Coffee</a></li>
            </ul>
            </div>

            <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
                <h3 class="footer-heading mb-4">Contact Info</h3>
                <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
                </ul>
            </div>


            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
            <p>
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="#">Seo Midia</a>
            </p>
            </div>

        </div>
        </div>
    </footer>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/aos.js')}}"></script>

    <script src="{{asset('js/main.js')}}"></script>

    <script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 900){
            $('.site-navbar').addClass("header-fixo");
        }
        else{
            $('.site-navbar').removeClass("header-fixo");
        }
        });
    </script>
    </body>

    </html>
