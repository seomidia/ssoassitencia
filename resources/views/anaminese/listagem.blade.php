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
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" name="deletecheck"></th>
                                    <th style="text-align: center">#Codigo</th>
                                    <th style="text-align: center">Empresa</th>
                                    <th style="text-align: center">Funcionario</th>
                                    <th style="text-align: center">Cargo</th>
                                    <th style="text-align: center">Ambiente</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Condição</th>
                                    <th style="text-align: center">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($anamnese as $key => $item)
                                <tr>
                                    <td><input type="checkbox" name="deletecheck" value="id[]"></td>
                                    <td style="text-align: center">#{{$item->id}}</td>
                                    <td style="text-align: center">{{$item->empresa}}</td>
                                    <td style="text-align: center">{{$item->funcionario}}</td>
                                    <td style="text-align: center">{{$item->cargo}}</td>
                                    <td style="text-align: center">{{$item->ambiente_trabalho}}</td>
                                    <td style="text-align: center">
                                        <div  class="
                                            @if($item->step == 'step_rh')
                                                alert-danger
                                            @endif
                                            @if($item->step == 'step_fuci')
                                                alert-success
                                            @endif
                                            @if($item->step == 'step_med')
                                                alert-primary
                                            @endif
                                                " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
                                            @if($item->step == 'step_rh')
                                                Não iniciado
                                            @endif
                                            @if($item->step == 'step_fuci')
                                                Funcionario
                                            @endif
                                            @if($item->step == 'step_med')
                                                Medico
                                            @endif
                                        </div>
                                    </td>
                                    <td  style="text-align: center">
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
                                            " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
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
                                    </td  style="text-align: center">
                                    <td>
                                        @if($item->step == 'step_med')
                                            @if(!is_null($item->apt))
                                                <button  class="btn btn-sm @if($item->apt == 1) btn-success @endif @if($item->apt == 0) btn-danger @endif pull-center" style="padding: 2px 7px;">Atestado</button>
                                            @endif
                                        @endif

                                        <a href="/admin/anaminese/cadastro/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                        <a href="/admin/encaminhamento/{{$item->id}}/delete" id="delete"  class="btn btn-sm btn-danger pull-center" style="padding: 2px 7px;"><i class="voyager-trash"></i></a>
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
                        window.location.href = 'anaminese/cadastro/' + response;
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
            })

        });
    </script>
@stop
