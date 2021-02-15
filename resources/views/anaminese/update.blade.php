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
    <form name="create_anaminesis" action="#" type="delete" style="position: absolute;top: 97px;left: 362px;">
        <button class="btn btn-danger btn-add-new">
            <i class="voyager-trash"></i> <span>{{ __('Cancelar') }}</span>
        </button>
    </form>

    <a href="#" class="btn btn-warning btn-add-new">
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
                                <input id="cpf" type="text" class="form-control" name="cpf" maxlength="12">
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
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-5">Salvar</button>
                                    <div style="clear: both">&nbsp;</div>
                                    <div class="row">
                                        <h3 class="border-left mb-5">Empresa</h3>
                                        <div class="form-group  col-md-4 pessoa_cpf">
                                            <label for="pessoa_cpf">CNPJ</label>
                                            <input type="text" class="form-control" name="empresa" id="empresa_cnpj" placeholder="CNPJ">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="pessoa_nome">Nome da empresa</label>
                                            <input type="text" class="form-control" id="empresa_nome" name="empresa_nome" placeholder="Empresa">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="pessoa_nome">Endereço</label>
                                            <input type="text" class="form-control" id="empresa_endereco" name="empresa_endereco" placeholder="Endereço">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="pessoa_nome">Numero</label>
                                            <input type="text" class="form-control" id="empresa_numero" name="empresa_numero" placeholder="numero">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="pessoa_nome">Cidade</label>
                                            <input type="text" class="form-control" id="empresa_cidade" name="empresa_cidade" placeholder="cidade">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="pessoa_nome">UF</label>
                                            <input type="text" class="form-control" id="empresa_uf" name="empresa_uf" placeholder="UF">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <h3 class="border-left mb-5">Funcionário</h3>
                                        <div class="form-group  col-md-4 pessoa_cpf">
                                            <label for="pessoa_cpf">CPF</label>
                                            <input type="text" class="form-control" name="pessoa_cpf" id="pessoa_cpf" placeholder="CPF">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="col-md-2" style="margin: 0px;margin-top: 21px;">
                                            <label for="">&nbsp;</label>
                                            <button id="create_pessoa" class="btn btn-success">Cadastrar pessoa</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pessoa_nome">Nome</label>
                                            <input type="text" class="form-control" id="pessoa_nome" name="pessoa" placeholder="Nome">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-4">
                                            <label for="pessoa_cpf">RG</label>
                                            <input type="text" class="form-control" name="pessoa_rg" id="pessoa_rg" placeholder="RG">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>

                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Nascimento</label>
                                            <input type="date" class="form-control" name="pessoa_nascimento" id="pessoa_nascimento" placeholder="Nascimento">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-2">
                                            <label for="pessoa_cpf">Idade</label>
                                            <input type="text" class="form-control" name="pessoa_idade" id="pessoa_idade" placeholder="Idade">
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Sexo</label>
                                            <select class="form-control select2" name="pessoa_sexo">
                                                <option value="">Selecione</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="feminino">Feminino</option>
                                            </select>
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h3 class="border-left mb-5">Profissional</h3>
                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Ambiente de trabalho</label>
                                            <select class="form-control select2" name="ambiente_Trabalho"></select>
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label for="pessoa_cpf">Cargo</label>
                                            <select class="form-control select2" name="cargo"></select>
                                            <small id="aviso" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                <input type="hidden" name="anamnese_id" value="{{$anamnese_id}}">
                                <input type="hidden" name="user_logged" value="{{$user_logged}}">
                                <input type="hidden" name="user_funcionario">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){

            $('button#create_pessoa').on('click',function(event){
                event.preventDefault();
                $('#create_pessoa').modal('show');
            });
            $('#empresa_cnpj').on('blur', function(){
                var cnpj = $(this).val();

                $('input[name="empresa_nome"]').val('...');
                $('input[name="empresa_endereco"]').val('...');
                $('input[name="empresa_numero"]').val('...');
                $('input[name="empresa_cidade"]').val('...');
                $('input[name="empresa_uf"]').val('...');


                $.ajax({
                    url: "/json/getcompany/" + cnpj,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        if(response.status == 'ERROR'){
                            toastr.error(response.message);
                        }else{
                            console.log(response.data);

                            $('input[name="empresa_nome"]').val(response.data.fantasia);
                            $('input[name="empresa_endereco"]').val(response.data.logradouro + ' - ' + response.data.bairro );
                            $('input[name="empresa_numero"]').val(response.data.numero);
                            $('input[name="empresa_cidade"]').val(response.data.municipio);
                            $('input[name="empresa_uf"]').val(response.data.uf);

                        }

                    }
                }).fail(function (jqXHR, textStatus) {
                    toastr.error('Houve um problema ao consulta o CNPJ, favor contactar o desenvolvedor.');
                })

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
                    $('select[name="ambiente_Trabalho"]').append('<option value="">Selecione</option>');
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
                    $('select[name="cargo"]').append('<option value="">Selecione</option>');
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

                $.post('/admin/anamnese/' + anamnese_id, $(this).serializeArray(), function (response) {
                    toastr.success('Anamnese criada com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/anaminese';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

        });
    </script>
@stop


