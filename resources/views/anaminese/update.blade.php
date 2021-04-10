@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Anaminese'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Anaminese')}}
    </h1>
    <form name="delete_anaminesis" action="#" type="post" style="position: absolute;top: 97px;left: 362px;">
        <button class="btn btn-danger btn-add-new">
            <i class="voyager-trash"></i> <span>{{ __('Cancelar') }}</span>
        </button>
    </form>

    <a href="{{Route('voyager.encaminhamento')}}" class="btn btn-warning btn-add-new">
        <i class="voyager-plus"></i> <span>{{ __('Voltar') }}</span>
    </a>


    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="modal fade" id="create_pessoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form name="anaminese" action="" type="post">
                            @foreach($dados as $key => $item)
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-5">Salvar</button>
                                    <div style="clear: both">&nbsp;</div>
                                    <div class="row">
                                        <h3 class="border-left mb-5">Empresa</h3>
                                        <div class="form-group  col-md-4 pessoa_cpf">
                                            <label for="pessoa_cpf">CNPJ</label>
                                            <input type="text"  class="form-control"  name="empresa" id="empresa_cnpj" placeholder="CNPJ" value="{{ $item->cnpj ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="pessoa_nome">Nome da empresa</label>
                                            <input type="text" disabled class="form-control" id="empresa_nome" name="empresa_nome" placeholder="Empresa" value="{{ $item->nome ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pessoa_nome">Endereço</label>
                                            <input type="text" class="form-control" id="empresa_endereco" name="empresa_endereco" placeholder="Endereço" value="{{ $item->endereco ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="pessoa_nome">Bairro</label>
                                            <input type="text" class="form-control" id="empresa_bairro" name="empresa_bairro" placeholder="Bairro" value="{{ $item->bairro ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="pessoa_nome">Numero</label>
                                            <input type="text" class="form-control" id="empresa_numero" name="empresa_numero" placeholder="numero" value="{{ $item->numero ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pessoa_nome">Cidade</label>
                                            <input type="text" class="form-control" id="empresa_cidade" name="empresa_cidade" placeholder="cidade" value="{{ $item->cidade ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="pessoa_nome">UF</label>
                                            <input type="text" class="form-control" id="empresa_uf" name="empresa_uf" placeholder="UF" value="{{ $item->uf ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <h3 class="border-left mb-5">Funcionário</h3>
                                        <div class="form-group  col-md-4 pessoa_cpf">
                                            <label for="pessoa_cpf">CPF</label>
                                            <input type="text" maxlength="14" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' class="form-control" name="pessoa_cpf" id="pessoa_cpf" placeholder="CPF" value="{{ $item->cpf ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="col-md-2" style="margin: 0px;margin-top: 21px;">
                                            <label for="">&nbsp;</label>
                                            <button id="create_pessoa" class="btn btn-success">Cadastrar pessoa</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pessoa_nome">Nome</label>
                                            <input type="text" class="form-control" id="pessoa_nome" name="pessoa" placeholder="Nome" value="{{ $item->funcionario ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-4">
                                            <label for="pessoa_cpf">RG</label>
                                            <input type="text" class="form-control" name="pessoa_rg" id="pessoa_rg" placeholder="RG" value="{{ $item->rg ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Nascimento</label>
                                            <input type="date" class="form-control" name="pessoa_nascimento" id="pessoa_nascimento" placeholder="Nascimento" value="{{ $item->nasc ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-2">
                                            <label for="pessoa_cpf">Idade</label>
                                            <input type="text" class="form-control" name="pessoa_idade" id="pessoa_idade" placeholder="Idade" value="{{ $item->idade ?? '' }}">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Sexo</label>
                                            <select class="form-control" name="pessoa_sexo">
                                                <option value="">Selecione</option>
                                                <option value="masculino" @if($item->sexo == 'masculino') selected @endif>Masculino</option>
                                                <option value="feminino" @if($item->sexo == 'feminino') selected @endif>Feminino</option>
                                            </select>
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h3 class="border-left mb-5">Profissional</h3>
                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Cargo</label>
                                            <select class="form-control select2" name="cargo">
                                                <option value="">Selecione</option>
                                                @if(isset($item->office_id))
                                                    <option selected value="{{$item->office_id}}">{{$item->cargo}}</option>
                                                @endif
                                            </select>
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                <input type="hidden" name="anamnese_id" value="{{$anamnese_id}}">
                                <input type="hidden" name="user_logged" value="{{$user_logged}}">
                                <input type="hidden" name="step" value="{{$item->step}}">
                                <input type="hidden" name="user_funcionario" value="{{$item->user_id_employee}}">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
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
        $(document).ready(function(){
            document.getElementById('empresa_cnpj').addEventListener('input', function (e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
                e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
            });
            $('button#create_pessoa').on('click',function(event){
                event.preventDefault();
                $('#create_pessoa').modal('show');
            });
            $('#empresa_cnpj').on('blur', function(){
                var cnpj = $(this).val();

                if(cnpj != ''){
                    cnpj = cnpj.replace('.','');
                    cnpj = cnpj.replace('/','');

                    $('input[name="empresa_nome"]').val('...');
                    $('input[name="empresa_endereco"]').val('...');
                    $('input[name="empresa_bairro"]').val('...');
                    $('input[name="empresa_numero"]').val('...');
                    $('input[name="empresa_cidade"]').val('...');
                    $('input[name="empresa_uf"]').val('...');


                    $.ajax({
                        url: "/json/getcompany/" + cnpj,
                        type: 'get',
                        dataType: 'json',
                        success: function(response){
                            if(response.success){
                                $('input[name="empresa_nome"]').val(response.data.nome);
                                $('input[name="empresa_endereco"]').val(response.data.logradouro);
                                $('input[name="empresa_bairro"]').val(response.data.bairro );
                                $('input[name="empresa_numero"]').val(response.data.numero);
                                $('input[name="empresa_cidade"]').val(response.data.municipio);
                                $('input[name="empresa_uf"]').val(response.data.uf);

                            }else{
                                toastr.error(response.message);
                            }

                        }
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error('Houve um problema ao consulta o CNPJ, favor contactar o desenvolvedor.');
                    })
                }else{
                    toastr.error('O CNPJ é obrigatório.');
                }
            });
            $('#pessoa_cpf').on('blur', function() {
                var cpf = $(this).val();

                if(cpf == '...' || cpf == ''){
                    toastr.error('CPF é inválido ou não foi informado!');
                }else{

                    $('input[name="pessoa"]').val('...');
                    $('input[name="pessoa_rg"]').val('...');
                    $('input[name="pessoa_nascimento"]').val('...');
                    $('input[name="pessoa_idade"]').val('...');
                    $('input[name="pessoa_sexo"]').val('...');

                    $.ajax({
                        url: "/json/getpessoa/" + cpf,
                        type: 'post',
                        dataType: 'json',
                        success: function(response){
                            console.log(response);
                            if(response.success){
                                $('input[name="user_funcionario"]').val(response.data.id);
                                $('input[name="pessoa"]').val(response.data.nome);
                                $('input[name="pessoa_rg"]').val(response.data.rg);
                                $('input[name="pessoa_nascimento"]').val(response.data.nascimento);
                                $('input[name="pessoa_idade"]').val(response.data.idade);
                                $('select[name="pessoa_sexo"] option[value='+ response.data.sexo +']').attr('selected','selected');
                            }else{
                                toastr.error('Pessoa não foi encontrada, realize o cadastro!');
                            }
                        }
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error(jqXHR.responseJSON.message);
                    })
                }
            });

            // select ambiente de trabalho ---------------------------------

            $.ajax({
                url: "/json/getworkplace/",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    for(var i = 0; i < response.data.length; i++){
                        $('select[name="ambiente_Trabalho"]').append('<option value="'+ response.data[i].name+'">'+response.data[i].name +'</option>');
                    }
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(  'Erro ao obter os ambientes de trabalho: <br>' + jqXHR.responseJSON.message);
            })

            // select cargo ---------------------------------

            $.ajax({
                url: "/json/getCargo/",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    for(var i = 0; i < response.data.length; i++){
                        $('select[name="cargo"]').append('<option value="'+ response.data[i].id+'">'+response.data[i].name +'</option>');
                    }
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(  'Erro ao obter os cargos: <br>' + jqXHR.responseJSON.message);
            })

            // select cargo ---------------------------------

            $.ajax({
                url: "/json/getMedicos/",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('select[name="medico"]').append('<option value="">Selecione</option>');
                    for(var i = 0; i < response.data.length; i++){
                        $('select[name="medico"]').append('<option value="'+ response.data[i].id+'">'+response.data[i].name +'</option>');
                    }
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(  'Erro ao obter os medicos: <br>' + jqXHR.responseJSON.message);
            })

            $('form[name="cadastro_pessoa"]').submit(function(event){
                event.preventDefault();
                $.post('{{ route('voyager.create.People') }}', $(this).serializeArray(), function (response) {
                    $('input[name="user_funcionario"]').val(response.data.id);
                    $('input[name="pessoa_cpf"]').val(response.data.cpf);
                    $('input[name="pessoa"]').val(response.data.nome);
                    $('input[name="pessoa_rg"]').val(response.data.rg);
                    $('input[name="pessoa_nascimento"]').val(response.data.nascimento);
                    $('input[name="pessoa_idade"]').val(response.data.idade);
                    $('select[name="pessoa_sexo"] option[value='+ response.data.sexo +']').attr('selected','selected');

                    $('#create_pessoa').modal('hide');

                    toastr.success(response.message);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })
            $('form[name="anaminese"]').submit(function(event){
                event.preventDefault();
                var anamnese_id = $('input[name="anamnese_id"]').val();

                $.post('/admin/encaminhamento/' + anamnese_id, $(this).serializeArray(), function (response) {
                    toastr.success('Encaminhamento criado com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

            $('form[name="delete_anaminesis"]').submit(function(event){
                event.preventDefault();

                var anamnese_id = $('input[name="anamnese_id"]').val();

                $.post('/admin/encaminhamento/' + anamnese_id + '/delete', function (response) {
                    toastr.success('Encaminhamento removido com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
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

    </script>
@stop


