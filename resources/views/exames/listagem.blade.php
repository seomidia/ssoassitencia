@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .voyager input[type="file"] {
            padding: 20px;
            background: #f2f2f2;
            border-radius: 4px;
            border: 3px solid #ddd;
            outline: none;
            cursor: pointer;
            line-height: 16px;
            color: #aaa;
            font-weight: 500;
            font-size: 12px;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            width: 100%;
    </style>
@stop

@section('page_title', __('Exames'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Exames')}}
    </h1>

@stop

@section('content')


<td colspan="5">



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

<div class="modal modal-exame fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border: 1px solid #fff;height: 900px;">
            <iframe class="responsive-iframe" width="100%" height="100%" src=""></iframe>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar</button>
            </div>
        </div>
    </div>
</div>


    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Codigo</th>
                                    <th style="text-align: center">Exame</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Data</th>
                                    <th style="text-align: center">Exportar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($exames) > 0)
                                    @foreach($exames as $key => $item)
                                    <tr>
                                        <td style="vertical-align: middle">#{{$item->id}}</td>
                                        <td style="vertical-align: middle">{{$item->name}}</td>
                                        <td style="vertical-align: middle">
                                            <div id="aviso-{{$item->id}}"  class="
                                                @if($item->status == 0)
                                                    alert-danger
                                                @endif
                                                @if($item->status == 1)
                                                    alert-success
                                                @endif
                                                aviso">
                                                @if($item->status == 0)
                                                    Aguardando
                                                @endif
                                                @if($item->status == 1)
                                                    Pronto
                                                @endif
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle">{{$item->created_at}}</td>
                                        <td style="vertical-align: middle">
                                            @if($item->status == 1)
                                            <a  href="@if($item->path_file) {{asset($item->path_file)}} @else {{'#'}} @endif" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="ver-exame btn btn-sm btn-danger pull-center">Ver</a>
                                            @endif
                                            @if(in_array($permissao,[1,7]))
                                                <a href="{{$item->id}}" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="upload btn btn-sm btn-danger pull-center">Upload</a>
                                            @endif

                                            @if(is_null($item->anamnesi) && $item->status != 1)
                                                <a href="{{$item->id}}" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="troca btn btn-sm btn-danger text-center">Transferir</a>
                                            @endif    
                                        </td>
                                    </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" style="text-align: center">Não existe Exames disponivel no momento !</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    <script>
        $(document).ready(function(){

            $('a.upload').click(function (event) {
                event.preventDefault();
                var href = $(this).attr('href');              
               // $('#upload-'+href).toggle();
                    Swal.fire({
                        title: 'Anexar arquivo',
                        input: 'file',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Anexar',
                        cancelButtonText: 'Cancelar',
                        inputAttributes: {
                            'accept': 'pdf/*',
                            'aria-label': 'Upload your profile picture',
                            'name':'arquivo-' + href
                        },
                    }).then((preConfirm) => {
                        if(preConfirm.isConfirmed){
                            var id = $('input[type="file"]').attr('name').split('-')[1];
                            var file = preConfirm.value;
                            

                            var formData = new FormData();
                            formData.append('exame_id',id);
                            formData.append('arquivo',file);


                            var url = window.location.origin + '/admin/upload-exame';
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                type:'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response){
                                    console.log(response);
                                    toastr.success(response.message);
                                    $('#upload-'+id).toggle();
                                    $('#aviso-'+id).removeClass('alert-danger');
                                    $('#aviso-'+id).addClass('alert-success');
                                    $('#aviso-'+id).html('Pronto');


                                }
                            }).fail(function (jqXHR, textStatus) {
                                if(file != null){
                                    toastr.error(jqXHR.responseJSON.message);
                                }else{
                                    toastr.error('É necessario informar um arquivo!');
                                }
                            })
                        }

                    });
            });
            /* $('form').on('change',function(){
                var id = $(this).attr('name').split('-')[1];
                var form = $('form[name="form-'+ id +'"]')[0];
                // var file = form[0][0].files[0];
                var file = $('input[name="arquivo-'+ id +'"]')[0].files[0];

                var formData = new FormData(form);
                formData.append('exame_id',id);
                formData.append('arquivo',file);


                var url = window.location.origin + '/admin/upload-exame';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type:'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(response);
                        toastr.success(response.message);
                        $('#upload-'+id).toggle();
                        $('#aviso-'+id).removeClass('alert-danger');
                        $('#aviso-'+id).addClass('alert-success');
                        $('#aviso-'+id).html('Pronto');


                    }
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })


            }) */


            $('a.troca').on('click',function(event){
                event.preventDefault();
                Swal.fire({
                    title: 'Encaminhar exame',
                    html:
                        'CPF <input id="cpf" onkeyup="getPessoa(this,)" maxlength="14" onkeypress="mascaraMutuario(this,cpfCnpj)"  autocomplete="off"   type="text"  class="form-control my-1" placeholder="CPF do destinatário">' +
                        '<input id="exid" type="hidden" >' +
                        '<input id="user_id" type="hidden" >' +
                        'NOME<input id="nome" style="font-size: 20px;font-weight: bold;"  type="text"  disabled class="form-control my-1" placeholder="Nome do destinatario">' ,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Encaminhar',
                    cancelButtonText: 'Cancelar',
                    preConfirm: () => {
                        return [
                            document.getElementById('user_id').value,
                            document.getElementById('exid').value
                        ]
                    }
                }).then((preConfirm) => {
                    if(preConfirm.isConfirmed){

                    Swal.fire({
                        title: 'Atenção',
                        text: "Você tem certeza que deseja encaminhar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, encaminhar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "trans-exame",
                                type: 'post',
                                data:{
                                   user_id:preConfirm.value[0],
                                   exid:preConfirm.value[1]
                                },
                                dataType: 'json',
                                success: function(response){
                                    Swal.fire(
                                        'Sucesso!',
                                        'Exame encaminhado!',
                                        'success'
                                    );
                                    setTimeout(function (){
                                        window.location.href = 'exames';
                                    },3000);
                                }
                            }).fail(function (jqXHR, textStatus) {
                                Swal.fire(
                                    'Atenção!',
                                    'Não foi possivel realizar o encaminhamento, tente novamente mais tarde!',
                                    'warning'
                                );
                            })
                        }
                    })
                }

                });
                var exid = $(this).attr('href');
                $('#exid').val(exid);
            })
            $('a.ver-exame').click(function(event){
                event.preventDefault();
                $('iframe').attr('src','');
                var href = $(this).attr('href');
                $('iframe').attr('src',href);
                $('.modal-exame').modal('show');
            });

            $('form[name="cadastro_pessoa"]').submit(function(event){
                event.preventDefault();
                $.post('{{ route('voyager.create.People') }}', $(this).serializeArray(), function (response) {
                    $('input[name="user_id"]').val(response.data.id);
                    $('#cpf').val(response.data.cpf);

                    $('#create_pessoa').modal('hide');

                    toastr.success(response.message);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })


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

        function getPessoa(val,exid){
            var cpf = val.value;
                $.ajax({
                    url: "/json/getpessoa/" + cpf,
                    type: 'post',
                    dataType: 'json',
                    success: function(response){
                        $('#nome').val(response.data.nome)
                        $('#user_id').val(response.data.id)
                    }
                }).fail(function (jqXHR, textStatus) {
                    var total = cpf.length;
                    if(total >= 14){
                        Swal.fire({
                        title: 'Atenção',
                        text: "Esta pessoal não esta cadastrada, deseja cadastrar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim!',
                        customClass: {
                            confirmButton: 'createpeople'
                        }
                    }).then((result) => {
                        if(result.isConfirmed){
                            $('#create_pessoa').modal('show');
                        }
                    });
                    }
                })
        };

    </script>
@stop
