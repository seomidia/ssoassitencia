
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-3">

                <div class="block-7">
                    <img src="{{url('/')}}/images/logo_SSO_FOOTER.png" style="max-width: 50%">
                    <p>A SSO oferece uma ampla variedade de serviços e produtos que satisfazem as necessidades específicas de empresas de diferentes segmentos da economia. Garantimos um alto padrão de qualidade nos serviços prestados.</p>
                </div>

            </div>
            <div class="col-lg-2 mx-auto mb-5 mb-lg-0">
                <h3 class="footer-heading mb-4">Links Principais</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Exames</a></li>
                    <li><a href="#">Loja</a></li>
                    <li><a href="#">Sistema</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Contact Info</h3>
                    <ul class="list-unstyled">
                        <li class="address">R. 7 de Abril, 59 - República, São Paulo - SP, 01043-000</li>
                        <li class="phone"><a href="#">
                                11 3771-3484 | 11 3772-3194 -Capitais e regiões metropolitanas
                                </a></li>
                        <li class="phone"><a href="tel://40202420">
                                4020-2420 - Demais localidades DDD
                                </a></li>
                        <li class="email">comercial@sso.com.br</li>
                    </ul>
                </div>


            </div>
        </div>

        </div>
    </div>
</footer>
<div class="copy">
    <div class="container">
        <div class="row pt-3 text-center">
            <div class="col-md-12">
                <p>
                    Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script> Todos direitos reservados | <a href="#">Seo Midia Soluções Para Internet</a>
                </p>
            </div>

        </div>
</div>

</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>

<script src="https://raw.githack.com/sabieber/token-autocomplete/master/built/token-autocomplete.js"></script>
<link href="https://raw.githack.com/sabieber/token-autocomplete/master/lib/token-autocomplete.css" rel="stylesheet" type="text/css" media="all">

<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>
    $(document).ready(function($) {
        @if(Auth::check())
        $('button[type="button"]').prop('disabled', false);
        @else
        $('button[type="button"]').prop('disabled', true);
        @endif
        // $('span#sample-input').attr('data-placeholder','Escriva os riscos aqui!')
        // let tokenAutocomplete = new TokenAutocomplete({
        //     name: 'riscos[]',
        //     selector: '#sample',
        //     noMatchesText: 'Nada encontrado...',
        // initialTokens: [
        //     {value: '', text: 'Risco1'},
        //     {value: '', text: 'Risco2'},
        // ],
        {{--        initialSuggestions: [--}}
        {{--            @foreach($riscos as $key => $value)--}}
        {{--            {value: '{{$value->id}}', text: '{{$value->name}}', description: '{{$value->description}}'},--}}
        {{--            @endforeach--}}
        {{--        ]--}}
        {{--    });--}}
        {{--    tokenAutocomplete.debug(true);--}}
        {{--})--}}
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400){
            $('.site-navbar').addClass("header-fixo");
            $('.site-navbar .logo img').css('width','150px');
            $('.site-navbar').removeClass("py-2");

        }
        else{
            $('.site-navbar').removeClass("header-fixo");
            $('.site-navbar .logo img').removeAttr('style')
            $('.site-navbar').addClass("py-2");
        }
    });
</script>
@yield('js')

</body>

</html>
