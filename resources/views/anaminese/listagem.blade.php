@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

@stop

@section('page_title', __('Encaminhamentos'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Encaminhamentos')}}
    </h1>
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


    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: 1px solid #fff;height: 1135px;">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="print"><i class="fa fa-print" aria-hidden="true"></i>
                    </button>
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar</button>
                    <div id="popup-atestado"></div>

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
                                    <th style="text-align: center">Empresa</th>
                                    <th style="text-align: center">Funcionario</th>
                                    <th style="text-align: center">Cargo</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Condição</th>
                                    <th style="text-align: center">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($anamnese as $key => $item)
                                <tr>
                                    <td style="vertical-align: middle">{{$item->empresa}}</td>
                                    <td style="vertical-align: middle">{{$item->funcionario}}</td>
                                    <td style="vertical-align: middle">{{$item->cargo}}</td>
                                    <td style="vertical-align: middle">
                                        <div  class="
                                            @if($item->step == 'step_rh')
                                                alert-danger
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
                                                <a target="_blank" href="/admin/anamnese/atestado/{{$item->id}}" style="padding: 10px 22px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center btn2">Atestado</a>
                                            @else
                                                <a href="/admin/anaminese/cadastro/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                                <a href="/admin/encaminhamento/{{$item->id}}/delete" id="delete"  class="btn btn-sm btn-danger pull-center" style="padding: 2px 7px;"><i class="voyager-trash"></i></a>
                                            @endif
                                    </td>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">--}}
{{--                                    <ul class="pagination">--}}
{{--                                        <li class="paginate_button previous disabled" aria-controls="dataTable" tabindex="0" id="dataTable_previous">--}}
{{--                                            <a href="#">Anterior</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="paginate_button active" aria-controls="dataTable" tabindex="0">--}}
{{--                                            <a href="#">1</a></li>--}}
{{--                                        <li class="paginate_button " aria-controls="dataTable" tabindex="0">--}}
{{--                                            <a href="#">2</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="paginate_button next" aria-controls="dataTable" tabindex="0" id="dataTable_next">--}}
{{--                                            <a href="#">Proximo</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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

                $.post(url, function (response) {
                    toastr.success('Encaminhamento removido com susesso!');
                    setTimeout(function (){
                        window.location.href = '/admin/encaminhamento';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            });

            $('.atestado').click(function(){
                var href = window.location.origin + $(this).attr('href');
                var html = $('#popup-atestado').load(href);
            });

            document.getElementById('print').onclick = function() {
                    var conteudo = document.getElementById('popup-atestado').innerHTML,
                    tela_impressao = window.open('about:blank');

                    tela_impressao.document.write(conteudo);
                    tela_impressao.window.print();
                    tela_impressao.window.close();
            };
        });
    </script>
@stop
