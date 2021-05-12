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
                    <h2>Veja como é fácil consultar</h2>
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
                            <input type="tel" class="form-control" name="telefone" data-mask="(00) 0000-0000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="message-text" class="col-form-label">CPF:</label>
                            <input id="cpf" type="text" class="form-control" name="cpf" maxlength="14" onchange="TestaCPF(this)" onkeypress='mascaraMutuario(this,cpfCnpj)'>
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
            <div id="load" style="border: 1px solid #ddd;position: absolute;z-index: 9998;width: 100%;height: 100%;background: #fff;opacity: 0.7;text-align: center;padding: 400px 0px;color: #000;font-size: 20px;display: none"><img src="{{asset('images/load.gif')}}"> Enviando...</div>
        </div>
    </div>
</div>



  <div class="site-section bg-secondary" style="margin: 0px;padding: 0px;background-color:#fff!important">
      <iframe width="100%" height="400" id="gmap_canvas" src="{{setting('site.mapa')}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  </div>


@endsection

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
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
                    $('#consultas select').append('<option value="" selected>Selecione</option>');
                    $.each( response, function( key, value ) {
                        $('#consultas select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                })
            }
        }
        function next(prod){
            $(".active").trigger("click")
            $('button.sw-btn-next').trigger("click");
            addCart(prod.value)
            // $('#risco').show();
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
            $('input[name="telefone"]')
                .mask("(99) 9999-9999?9")
                .focusout(function (event) {
                    var target, phone, element;
                    target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                    phone = target.value.replace(/\D/g, '');
                    element = $(target);
                    element.unmask();
                    if(phone.length > 10) {
                        element.mask("(99) 99999-999?9");
                    } else {
                        element.mask("(99) 9999-9999?9");
                    }
                });
            setCookie('session_id',Math.floor((Math.random() * 1000000000000000000) + 1),1);
            addCartList();
            $('form[name="consulta"]').on('submit',function (event) {
                event.preventDefault();
                        $.ajax({
                            url: window.location.origin + '/finalizar',
                            data: {
                                '_token':$('meta[name="csrf-token"]').attr('content'),
                                'prod':$('input[name="prod[]"]').serializeArray(),
                                'riscos':$('select[name="riscos[]"]').serializeArray(),
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function (response) {
                                window.open (
                                    response,
                                    "_blank" );
                                setTimeout(function (){
                                    window.location.href = '/obrigado';
                                },10000);
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

            $('form[name="cadastro_pessoa"]').submit(function(event){
                event.preventDefault();
                $('#load').show('slow');

                var cpf = $('input[name="cpf"]').val();
                    $.post('{{ route('voyager.create.People') }}', $(this).serializeArray(), function (response) {
                        $('#exampleModal').modal('hide');
                        $('#load').hide();

                        Swal.fire({
                            title: 'Sucesso',
                            text: response.message,
                            icon: 'success',
                        })
                    }).fail(function (jqXHR, textStatus) {
                        $('#load').hide();

                        Swal.fire({
                            title: 'Atenção',
                            text: jqXHR.responseJSON.message,
                            icon: 'warning',
                        })

                    })
            })
        });
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }
        //Quando o campo cep perde o foco.
        $('input[name="cep"]').blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#company_endereco").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        console.log(dados);

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#company_endereco").val(dados.logradouro +' - '+ dados.bairro);
                            $("#company_bairro").val(dados.bairro);
                            $("#company_cidade").val(dados.localidade);
                            $("#company_estado").val(dados.uf);

                            getlocal(dados.localidade,dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

        function mascaraMutuario(o,f){
            v_obj=o
            v_fun=f
            setTimeout('execmascara()',1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }

        function cpfCnpj(v){

            //Remove tudo o que não é dígito
            v=v.replace(/\D/g,"")

            if (v.length <= 14) { //CPF

                //Coloca um ponto entre o terceiro e o quarto dígitos
                v=v.replace(/(\d{3})(\d)/,"$1.$2")

                //Coloca um ponto entre o terceiro e o quarto dígitos
                //de novo (para o segundo bloco de números)
                v=v.replace(/(\d{3})(\d)/,"$1.$2")

                //Coloca um hífen entre o terceiro e o quarto dígitos
                v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

            } else { //CNPJ

                //Coloca ponto entre o segundo e o terceiro dígitos
                v=v.replace(/^(\d{2})(\d)/,"$1.$2")

                //Coloca ponto entre o quinto e o sexto dígitos
                v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

                //Coloca uma barra entre o oitavo e o nono dígitos
                v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

                //Coloca um hífen depois do bloco de quatro dígitos
                v=v.replace(/(\d{4})(\d)/,"$1-$2")

            }

            return v

        }

        function TestaCPF(strCPF) {

            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000"){
                Swal.fire({
                    title: 'Atenção',
                    text: 'CPF é invalido',
                    icon: 'warning',
                })
                return false;
            }
            if (strCPF == "11111111111") return false;
            if (strCPF == "22222222222") return false;
            if (strCPF == "33333333333") return false;
            if (strCPF == "44444444444") return false;
            if (strCPF == "55555555555") return false;
            if (strCPF == "66666666666") return false;
            if (strCPF == "77777777777") return false;
            if (strCPF == "88888888888") return false;
            if (strCPF == "99999999999") return false;

            for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
            return true;
        }
    </script>
    @stop
