@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Listagem Anaminese'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Anaminese')}}
    </h1>
    <form name="create_anaminesis" action="{{Route('voyager.create.anaminese')}}" type="post" style="position: absolute;top: 96px;left: 260px;">
        <button class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
        </button>
    </form>


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
                                    <th>#Codigo</th>
                                    <th>Empresa</th>
                                    <th>Funcionario</th>
                                    <th>Cargo</th>
                                    <th>Ambiente</th>
                                    <th>Cliente/RH</th>
                                    <th>Status</th>
                                    <th style="text-align: right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($anamnese as $key => $item)
                                <tr>
                                    <td>#{{$item->id}}</td>
                                    <td>{{$item->empresa}}</td>
                                    <td>{{$item->funcionario}}</td>
                                    <td>{{$item->cargo}}</td>
                                    <td>{{$item->ambiente_trabalho}}</td>
                                    <td></td>
                                    <td><div  class="alert-danger" style="width: 100px;padding: 10px;font-weight: bold;font-size: 13px;">Pendente p/ funcionario</div></td>
                                    <td>
                                        <button  class="btn btn-sm btn-success pull-center">Atestado</button>
                                        <button  class="btn btn-sm btn-primary pull-center">Editar</button>
                                        <button  class="btn btn-sm btn-danger pull-center">Excluir</button>
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
                $.post('{{ route('voyager.create.anaminese') }}', $(this).serializeArray(), function (response) {
                    toastr.success('Iniciando Anaminese...');
                    setTimeout(function (){
                        window.location.href = 'anaminese/cadastro/' + response;
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })
        });
    </script>
@stop