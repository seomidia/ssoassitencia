@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Encaminhamentos'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Encaminhamentos')}}
    </h1>

    @if(in_array(Auth::user()->role_id,[3]))
            <div class="page-content browse container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form name="create_anaminesis" action="{{Route('voyager.create.encaminhamento')}}" type="post">
                        <button class="btn btn-success btn-add-new">
                            <i class="voyager-plus"></i> <span>Criar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@stop

@section('content')


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Codigo</th>
                                    <th style="text-align: center">Empresa</th>
                                    <th style="text-align: center">Funcionario</th>
                                    <th style="text-align: center">Cargo</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Condição</th>
                                    <th style="text-align: center">Exportar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($anamnese) > 0)
                                    @foreach($anamnese as $key => $item)
                                <tr>
                                    <td style="vertical-align: middle">#{{$item->id}}</td>
                                    <td style="vertical-align: middle">{{$item->empresa}}</td>
                                    <td style="vertical-align: middle">{{$item->funcionario}}</td>
                                    <td style="vertical-align: middle">{{$item->cargo}}</td>
                                    <td style="vertical-align: middle">
                                        <div  class="
                                            @if($item->step == 'step_rh')
                                                alert-danger
                                            @endif
                                            @if($item->step == 'step_site')
                                                alert-info
                                            @endif
                                            @if($item->step == 'step_funci')
                                                alert-success
                                            @endif
                                            @if($item->step == 'step_med')
                                                alert-primary
                                            @endif
                                            aviso">
                                            @if($item->step == 'step_rh')
                                                Não iniciado
                                            @endif
                                            @if($item->step == 'step_site')
                                                Ecommerce
                                            @endif
                                            @if($item->step == 'step_funci')
                                                Funcionario
                                            @endif
                                            @if($item->step == 'step_med')
                                                Medico
                                            @endif
                                        </div>
                                    </td>
                                    <td  style="vertical-align: middle">
                                        <div  class="
                                        @if(!is_null($item->apt))
                                             @if($item->apt == 0)
                                                alert-danger
                                            @endif
                                            @if($item->apt == 1)
                                                alert-success
                                            @endif
                                            @else
                                            alert-primary
                                        @endif
                                            aviso">
                                        @if(!is_null($item->apt))
                                            @if($item->apt == 1)
                                                Apto
                                            @endif
                                            @if($item->apt == 0)
                                                Não Apto
                                            @endif
                                            @else
                                            Não avaliado
                                        @endif
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle">
                                            @if($item->step == 'step_med' && !is_null($item->apt))
                                            <a href="/admin/anamnese/atestado/{{$item->id}}/" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center">Atestado</a>
                                            <a  href="/admin/anamnese/atestado/{{$item->id}}/send" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="send btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center"><i class="fa fa-send" aria-hidden="true"></i></a>
                                            @else
                                                    @if(in_array($item->step,['step_site','step_funci','step_rh']))
                                                        <a href="/admin/anaminese/cadastro/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                                        <a href="/admin/encaminhamento/{{$item->id}}/delete" id="delete"  class="btn btn-sm btn-danger pull-center" style="padding: 2px 7px;"><i class="voyager-trash"></i></a>
                                                   @endif
                                            @endif
                                    </td>
                                    </td>
                                </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" style="text-align: center">Não existe Anamnese disponivel no momento !</td>
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
            $('form[name="create_anaminesis"]').submit(function(event){
                event.preventDefault();

                $('#voyager-loader').show('slow');
                $.post('{{ route('voyager.create.encaminhamento') }}', $(this).serializeArray(), function (response) {
                    toastr.success('Iniciando Anaminese...');
                    setTimeout(function (){
                        window.location.href = 'encaminhamento/cadastro/' + response;
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

            $('a#delete').click(function(event){
                event.preventDefault();

                var url= $(this).attr('href');
                $('#voyager-loader').show('slow');
                $.post(url, function (response) {
                    toastr.success('Encaminhamento removido com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            });

            $('.atestado').click(function(event){
                event.preventDefault();

                var href = window.location.origin + $(this).attr('href');

                $('#voyager-loader').show('slow');
                toastr.warning('Preparando PDF...');
                $.get(href, function (response) {
                    if(response.existe) toastr.remove();
                    $('iframe').attr('src',response.fileUri);
                    $('.modal').modal('show');
                    toastr.success(response.message);
                    $('#voyager-loader').hide('slow');
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            });
            $('.send').click(function(event){
                event.preventDefault();

                var href = window.location.origin + $(this).attr('href');

                $('#voyager-loader').show('slow');
                toastr.warning('Enviando atestado...');
                $.post(href, function (response) {
                    toastr.success(response.message);
                    $('#voyager-loader').hide('slow');
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })

            });

        });
    </script>
@stop
