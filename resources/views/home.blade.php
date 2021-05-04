@extends('layouts.app')
@section('content')
<div class="site-blocks-cover" style="background-image: url('images/home/slide-1.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
          <div class="site-block-cover-content text-center">
           <p>
              <a href="/#agendamento" class="btn btn-primary-2 px-5 py-3">Agende sua consulta ou exame</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


<section class="site-section">
    <div class="container">
        <div class="row align-items-stretch section-overlap">
            <div class="col-md-3 col-lg-3 mb-3 mb-lg-0">
                <div class="banner-wrap h-100">
                    <a href="#" class="h-100">
                        <i class="fas fa-shopping-cart"></i>
                        <p>
                            Compre no site
                            <strong>Compre sua consulta ou exame é agende seu atendimento online.</strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-3 mb-lg-0">
                <div class="banner-wrap h-100" style="background: rgba(77,177,226,0.9)">
                    <a href="#" class="h-100">
                        <i class="fas fa-laptop-medical"></i>
                        <p>
                            Pré-Consulta Online
                            <strong>Facíl e pratico, escolha sua consulta é já inicie seu questionario.</strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-3 mb-lg-0">
                <div class="banner-wrap h-100">
                    <a href="#" class="h-100">
                        <i class="fas fa-users"></i>
                        <p>
                            Atendimento online
                            <strong>Evite filas, agilize seu atendimento, acesse o site</strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 mb-3 mb-lg-0">
                <div class="banner-wrap h-100" style="background: rgba(77,177,226,0.9)">
                    <a href="#" class="h-100">
                        <i class="fas fa-mobile"></i>
                        <p>
                            Dispositivos Moveis
                            <strong>Acesse por qualquer dispositivo movel, compres e realize sua pre-consulta.</strong>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="agendamento">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="linha"></div>
            <div class="col-md-12 col-lg-12 text-center py-3 mb-3 mb-lg-0">
                    <h2>Veja como é fácil consultar no Exame Agora</h2>
            </div>
            <div class="col-md-12 col-lg-12 py-3 mb-3 mb-lg-0">
                <div id="smartwizard">
                    <ul class="nav">
                        <li>
                            <a class="nav-link" href="#step-1">
                                <strong>Identificação</strong>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="#step-2">
                                Serviços
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="#step-3">
                                Exames
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="#step-5">
                                Pagamento
                            </a>
                        </li>
                    </ul>
                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel" style="height: 335px;">
                                <p class="alert alert-warning"><small><a href="#" id="create_pessoa" style="color: #333333"  data-toggle="modal" data-target="#exampleModal">Se não for assinante, cadastre como avulso <strong>clique aqui</strong>.</a></small></p>
                                @include('step.quem')
                            </div>
                            <form name="consulta" action="" method="post">
                                @csrf
                            <div id="step-2" class="tab-pane" role="tabpanel" style="height: 335px;">
                                    <p class="alert alert-warning"><small><a href="#" id="create_pessoa" style="color: #333333"  data-toggle="modal" data-target="#exampleModal">Nesta etapa você vai criar o serviço que deseja.</a></small></p>
                                    @include('step.servicos')

                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel">
                                <p class="alert alert-warning"><small><a href="#" id="create_pessoa" style="color: #333333"  data-toggle="modal" data-target="#exampleModal">Busque os exames que deseja.</a></small></p>
                                @include('step.exame')

                            </div>
                            <div  id="step-5" class="tab-pane" role="tabpanel">
                                <p class="alert alert-warning"><small><a href="#" id="create_pessoa" style="color: #333333"  data-toggle="modal" data-target="#exampleModal">Confira seu pedido é efetue o pagamento para liberação em seu painel.</a></small></p>
                                @include('step.pagamento')
                            </div>
                            </form>

                        </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="float: left;">Cadastro de pessoa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="cadastro_pessoa" action="#" type="post">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" data-mask="(00) 0000-0000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">CPF:</label>
                            <input id="cpf" type="text" class="form-control" name="cpf" maxlength="14" onkeypress='mascaraMutuario(this,cpfCnpj)'>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">RG:</label>
                            <input id="cpf" type="text" class="form-control" name="rg" maxlength="12">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Nascimento:</label>
                            <input type="date" class="form-control" name="nascimento">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="message-text" class="col-form-label">Estado civil:</label>
                            <select class="form-control" name="estado_civil">
                                <option value="">Selecione</option>
                                <option value="solteiro">Solteiro</option>
                                <option value="casado">Casado</option>
                                <option value="uniao_estavel">União estável</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="message-text" class="col-form-label">Sexo:</label>
                            <select class="form-control" name="sexo">
                                <option value="">Selecione</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="message-text" class="col-form-label">Idade:</label>
                            <input type="text" class="form-control" name="idade">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">CEP:</label>
                            <input type="text" class="form-control cep"  name="cep">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Endereço:</label>
                            <input type="text" class="form-control" id="company_endereco" name="endereco">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Numero:</label>
                            <input type="text" class="form-control" name="numero">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Complemento:</label>
                            <input type="text" class="form-control"  name="complemento" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">Bairro:</label>
                            <input type="text" class="form-control" id="company_bairro" name="bairro">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" id="company_cidade" name="cidade">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Estado:</label>
                            <input type="text" class="form-control" id="company_estado" name="uf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>

        </div>
    </div>
</div>



  <div class="site-section bg-secondary" style="margin: 0px;padding: 0px;background-color:#fff!important">
      <iframe width="100%" height="400" id="gmap_canvas" src="{{setting('site.mapa')}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  </div>


@endsection

@section('js')
    <script>
        function setCookie(cname,cvalue,exdays) {
            if(getCookie('session_id') == "" && cname == 'session_id'){
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            if(cname != 'session_id'){
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

        }
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        function currencyFormatted(value, str_cifrao) {
            return str_cifrao + ' ' + value.formatMoney(2, ',', '.');
        }
        Number.prototype.formatMoney = function (c, d, t) {
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };
        function getServicos(cat){
            $(".active").trigger("click")

            var ulr = window.location.origin + '/json/getservico/' + cat.value

            var tipo = $.inArray(cat.value,['3','6']);
            if(tipo == '-1'){
                $('button.sw-btn-next').trigger("click");
                setCookie('prod_consulta','',1);
                addCart()
            }else{
                $('#consultas').show();
                $('#consultas select').html('');
                $.get(ulr,function(response){
                    $.each( response, function( key, value ) {
                        $('#consultas select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                })
            }
        }
        function risco(prod){
            $(".active").trigger("click")
            addCart(prod.value)
            $('#risco').show();
        }
        function riscofield(value){
            if(value.value == 'sim'){
                $('#riscofield').show();
            }else{
                $('#riscofield').hide();
            }
        }
        function addCart(id = null){
            var prod = [];
            var table;
            var total = 0;

            if(id != null){
                setCookie('prod_consulta',id,1);
                prod.push(id);
            }else{
                $('input[type="checkbox"]:checked').each(function(){
                    checked = $(this).val();
                    prod.push(checked);
                });
            }

            $.ajax({
                url: window.location.origin +'/json/getproduto',
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'id': prod
                },
                type:'post',
                dataType:'json',
                success: function (response) {
                    console.log(response);

                    $('#cart').html('');
                    var total = 0;
                    var tprod = 0;
                    var table = '';
                    $.each( response, function( key, value ) {
                        tprod++;
                        total = total + value.price;
                        table +=  '<li class="list-group-item d-flex justify-content-between lh-condensed">' +
                            '<div>' +
                            '<h6 class="my-0">'+ value.product_name +'</h6>' +
                            '<small class="text-muted">*'+ value.categoria +'</small>' +
                            '</div>' +
                            '<span class="text-muted">'+currencyFormatted(value.price, 'R$')+'</span>' +
                            '</li>';
                    });


                    var tablet =    '<li class="list-group-item d-flex justify-content-between">' +
                        '<span>Total (R$)</span>' +
                        '<strong>'+currencyFormatted(total, 'R$')+'</strong>' +
                        '</li>';


                    table +=    '<li class="list-group-item d-flex justify-content-between">' +
                        '<span>Total (R$)</span>' +
                        '<strong>'+currencyFormatted(total, 'R$')+'</strong>' +
                        '</li>';


                    $('#cart').append(table);
                    $('#cart').prepend(tablet);
                    $('.total').html(tprod);



                }
            });

        }
        function addCartList(){
            $.ajax({
                url: window.location.origin +'/json/getcart',
                type:'get',
                dataType:'json',
                success: function (response) {
                    $('#cart').html('');
                    var total = 0;
                    var tprod = 0;
                    var table = '';
                    $.each( response, function( key, value ) {
                        tprod++;
                        total = total + value.price;
                        table +=  '<li class="list-group-item d-flex justify-content-between lh-condensed">' +
                            '<div>' +
                            '<h6 class="my-0">'+ value.product_name +'</h6>' +
                            '<small class="text-muted">*'+ value.categoria +'</small>' +
                            '</div>' +
                            '<span class="text-muted">'+currencyFormatted(value.price, 'R$')+'</span>' +
                            '</li>';
                    });


                    var tablet =    '<li class="list-group-item d-flex justify-content-between">' +
                        '<span>Total (R$)</span>' +
                        '<strong>'+currencyFormatted(total, 'R$')+'</strong>' +
                        '</li>';


                    table +=    '<li class="list-group-item d-flex justify-content-between">' +
                        '<span>Total (R$)</span>' +
                        '<strong>'+currencyFormatted(total, 'R$')+'</strong>' +
                        '</li>';


                    $('#cart').append(table);
                    $('#cart').prepend(tablet);
                    $('.total').html(tprod);



                }
            });

        }
        $(document).ready(function(){
            setCookie('session_id',Math.floor((Math.random() * 1000000000000000000) + 1),1);
            addCartList();
            $('form[name="consulta"]').on('submit',function (event) {
                event.preventDefault();
                        $.ajax({
                            url: window.location.origin + '/finalizar',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'prod':$(this).serializeArray(),
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function (response) {
                                window.open (
                                    response,
                                    "_blank" );
                                // setTimeout(function (){
                                //     window.location.href = '/';
                                // },2000);
                            }

                        }).fail(function (jqXHR, textStatus) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: jqXHR.responseJSON.message,
                                // footer: '<a href>Why do I have this issue?</a>'
                            })
                        })
            });
        })
    </script>
    @stop
