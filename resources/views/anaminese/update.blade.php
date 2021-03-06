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
                                    <option value="uniao_estavel">Uni??o est??vel</option>
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
                                <label for="message-text" class="col-form-label">Endere??o:</label>
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
                                    <div class="row">
                                        <div style="clear: both">&nbsp;</div>

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
                                            <label for="pessoa_nome">Endere??o</label>
                                            <input type="text" class="form-control" id="empresa_endereco" name="empresa_endereco" placeholder="Endere??o" value="{{ $item->endereco ?? '' }}">
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
                                         <h3 class="border-left mb-5">Funcion??rio</h3>
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
                                    <h3 class="border-left mb-5">Exames</h3>
                                    <div class="form-group  col-md-12">
                                        <label for="pessoa_cpf">Procedimentos diagn??stico</label><br><br>
                                        @foreach($procedures as $key => $procedure)
                                            @if(
                                                $procedure->status == 0 && is_null($procedure->anamnesis_id) ||
                                                $procedure->status == 1 && $procedure->anamnesis_id == $anamnese_id
                                            )
                                                <input @if($procedure->status == 1 && $procedure->anamnesis_id == $anamnese_id) checked @endif  type="checkbox" id="{{$procedure->slug}}" class="form-control-checkbox procedure" name="medico[procedure][]"
                                                value="{{$procedure->id}}" > &nbsp;
                                                <label
                                                @if($procedure->status == 1 && $procedure->anamnesis_id == $anamnese_id)
                                                    style="font-weight: bold;color: darkred"
                                                    @endif
                                                    for="{{$procedure->slug}}">{{$procedure->name}}
                                                </label>&nbsp;&nbsp;&nbsp;
                                            @endif
                                        @endforeach
                                        <small id="aviso" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group  col-md-6">
                                        <h3 class="border-left mb-5">Profissional</h3>
                                        <label for="pessoa_cpf">Cargo</label>
                                        <select class="form-control select2" name="cargo" onchange="getRiscos(this)">
                                            <option value="">Selecione</option>
                                            @if(isset($item->office_id))
                                                <option selected value="{{$item->office_id}}">{{$item->cargo}}</option>
                                            @endif
                                        </select>
                                        <small id="aviso" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <h3 class="border-left mb-5">Local de Consulta</h3>
                                        <label for="pessoa_cpf">Clinica</label>
                                        <select class="form-control select2" name="location_id">
                                            @if(count($locais) > 0)
                                                @foreach($locais as $key => $value)
                                                   <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small id="aviso" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <h3 class="border-left mb-5">Riscos</h3>
                                    <div class="form-group  col-md-12">
                                        <label for="pessoa_cpf">Selecione os riscos</label>
                                        <select id="riscos" class="form-control select2" name="riscos[]" multiple="">
                                            @foreach($riscos as $key => $risco)
                                                <option  value="{{$risco->id}}" selected>{{$risco->name}}</option>
                                            @endforeach
                                        </select>
                                        <a href="#" onclick="getAllriscos();return false;">Todos os riscos</a>
                                        <small id="aviso" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="border-left mb-5">Agendamento de consulta</h3>
                                        <label for="pessoa_cpf">Dia do m??s</label>
                                        <select class="form-control select2" name="diames" onchange="selectDia()" id="dias">
                                            @if(isset($item->day))
                                                    <option value="{{$item->day}}">{{date("d-m-Y", strtotime($item->day))}}</option>
                                            @endif

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="border-left mb-5">&nbsp;</h3>
                                        <label for="pessoa_cpf">Dia da semana</label>
                                        <input class="form-control" type="text" id="diasemana" value="" disabled>
                                        <input type="hidden" name="diasemana" value="">
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="border-left mb-5">&nbsp;</h3>

                                        <label for="pessoa_cpf">Hor??rio</label>
                                        <select class="form-control select2" name="hora">
                                            <option value="">Selecione</option>
                                            @for($i = 8; $i <= 19; $i++)
                                                @php
                                                    $i = ($i <= 9) ? 0 . $i : $i;
                                                @endphp
                                                <option @if($item->time == $i . ':00:00') selected @endif value="{{$i}}:00">{{$i}}h:00m</option>
                                                @if($i != 19)
                                                  <option  @if($item->time == $i . ':15:00') selected @endif value="{{$i}}:15">{{$i}}h:15m</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="anamnese_id" value="{{$anamnese_id}}">
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

            //Remove tudo o que n??o ?? d??gito
            v=v.replace(/\D/g,"")

            if (v.length <= 14) { //CPF

                //Coloca um ponto entre o terceiro e o quarto d??gitos
                v=v.replace(/(\d{3})(\d)/,"$1.$2")

                //Coloca um ponto entre o terceiro e o quarto d??gitos
                //de novo (para o segundo bloco de n??meros)
                v=v.replace(/(\d{3})(\d)/,"$1.$2")

                //Coloca um h??fen entre o terceiro e o quarto d??gitos
                v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

            } else { //CNPJ

                //Coloca ponto entre o segundo e o terceiro d??gitos
                v=v.replace(/^(\d{2})(\d)/,"$1.$2")

                //Coloca ponto entre o quinto e o sexto d??gitos
                v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

                //Coloca uma barra entre o oitavo e o nono d??gitos
                v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

                //Coloca um h??fen depois do bloco de quatro d??gitos
                v=v.replace(/(\d{4})(\d)/,"$1-$2")

            }

            return v

        }

        $(document).ready(function(){
            /// remove procedure ------------------------------

            $('.ul.select2-selection__rendered li.select2-selection__choice').click(function(){
                var id = $(this).attr('id');
                console.log(id);
            });

            $('.select2-selection--multiple').css('height','100px');
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
                    toastr.error('O CNPJ ?? obrigat??rio.');
                }
            });
            $('#pessoa_cpf').on('blur', function() {
                var cpf = $(this).val();

                if(cpf == '...' || cpf == ''){
                    toastr.error('CPF ?? inv??lido ou n??o foi informado!');
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
                                getlocal(response);

                            }else{
                                toastr.error('Pessoa n??o foi encontrada, realize o cadastro!');
                            }
                        }
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error(jqXHR.responseJSON.message);
                    })
                }
            });

            // select ambiente de trabalho ---------------------------------
            $('input[type="checkbox"].procedure').on('change',function(){
                 var value = $(this).attr('value');
                 var id = window.location.pathname.split('/')[window.location.pathname.split('/').length - 1]
                    $.ajax({
                        url: "/admin/checking-procedure",
                        type: 'post',
                        dataType: 'json',
                        data:{
                          exid:value,
                          anamnese_id: id
                        },
                        success: function(response){
                            toastr.success('Exame disponivel para anamnesi '+ id);
                        }
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error(  'Erro ao vincular o exame: <br>' + jqXHR.responseJSON.message);
                    })

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

                $('#voyager-loader').show('slow');
                toastr.warning('Notificando funcion??rio!');
                $.post('/admin/encaminhamento/' + anamnese_id, $(this).serializeArray(), function (response) {
                    toastr.success('Encaminhamento atualizado com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    $('#voyager-loader').hide();
                    $('button#create_pessoa').text('Atualizar pessoa');
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

            $('form[name="delete_anaminesis"]').submit(function(event){
                event.preventDefault();

                var anamnese_id = $('input[name="anamnese_id"]').val();

                $('#voyager-loader').show('slow');
                $.post('/admin/encaminhamento/' + anamnese_id + '/delete', function (response) {
                    toastr.error('Encaminhamento removido com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })


            // select dias ---------------------------------

            $.ajax({
                url: "/json/diasdomes/",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    for(var i = 0; i < response.data.length; i++){
                        $('select[name="diames"]').append('<option value="'+ response.data[i].data+'">'+response.data[i].data+'</option>');
                    }

                    selectDia()
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(textStatus);
            })




        });

        function getlocal(response){

            $.ajax({
                url: "/json/getlocal",
                type: 'post',
                data:{
                    'cidade': response.data.cidade,
                    'uf': response.data.uf
                },
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.length > 0){
                        for(var i = 0; i < response.length; i++){
                            $('select[name="location_id"]').append('<option value="'+ response[i].id+'">'+response[i].name+'</option>');
                        }
                    }else{
                        $('select[name="location_id"]').append('<option value="">N??o existe locais para este CEP</option>');
                    }
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(textStatus);
            })

        }

        function getRiscos(response){

            $.ajax({
                url: "/json/getrisco",
                type: 'post',
                data:{
                    'cargo': response.value,
                },
                dataType: 'json',
                success: function(response){
                    $('select#riscos').html('')

                    for(var i = 0; i < response.data.length; i++){
                            $('select#riscos').append('<option value="'+ response.data[i].id+'" selected>'+response.data[i].name+'</option>');
                        }

                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(textStatus);
            })

        }
        function getAllriscos(response){

            $.ajax({
                url: "/json/getallrisco",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    for(var i = 0; i < response.data.length; i++){
                            $('select#riscos').append('<option value="'+ response.data[i].id+'">'+response.data[i].name+'</option>');
                        }
                    $('.select2-selection').trigger('click');
                }
            }).fail(function (jqXHR, textStatus) {
                toastr.error(textStatus);
            })

        }


        function limpa_formul??rio_cep() {
            // Limpa valores do formul??rio de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        function selectDia(){
            // input dia semana ------------------------------------
            var dia = $('#dias').val();

            $.get('/json/diasemana/' + dia, function (response) {
                $('input[name="diasemana"],#diasemana').val(response);
            }).fail(function (jqXHR, textStatus) {
                toastr.error(textStatus);
            })

        }

        //Quando o campo cep perde o foco.
        $('input[name="cep"]').blur(function() {

            //Nova vari??vel "cep" somente com d??gitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Express??o regular para validar o CEP.
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
                            //CEP pesquisado n??o foi encontrado.
                            limpa_formul??rio_cep();
                            alert("CEP n??o encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep ?? inv??lido.
                    limpa_formul??rio_cep();
                    alert("Formato de CEP inv??lido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formul??rio.
                limpa_formul??rio_cep();
            }
        });

    </script>
@stop


