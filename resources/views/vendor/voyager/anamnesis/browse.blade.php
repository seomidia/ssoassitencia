@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Serciços comprados'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-basket"></i>
        {{ __('Serciços comprados')}}
    </h1>
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
                                    <th>id</th>
                                    <th>Pagamento</th>
                                    <th>Tipo de produto</th>
                                    <th>Produto</th>
                                    <th>QTD</th>
                                    <th>Status</th>
                                    <th style="text-align: right">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Boleto</td>
                                    <td>Consulta</td>
                                    <td>Exame de fezes</td>
                                    <td>10</td>
                                    <td class="btn btn-sm btn-danger pull-center delete">Pendente</td>
                                    <td>
                                        <form name="create_anaminesis" action="{{Route('voyager.create.anaminese')}}" type="post">
                                            <input type="hidden" name="products_id" value="1">
                                            <button type="submit" class="btn btn-sm btn-success pull-right delete" data-id="2" id="delete-2">
                                                <i class="voyager-plus"></i> <span class="hidden-xs hidden-sm">Anaminese</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" aria-controls="dataTable" tabindex="0" id="dataTable_previous">
                                            <a href="#">Anterior</a>
                                        </li>
                                        <li class="paginate_button active" aria-controls="dataTable" tabindex="0">
                                            <a href="#">1</a></li>
                                        <li class="paginate_button " aria-controls="dataTable" tabindex="0">
                                            <a href="#">2</a>
                                        </li>
                                        <li class="paginate_button next" aria-controls="dataTable" tabindex="0" id="dataTable_next">
                                            <a href="#">Proximo</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                    toastr.success('teste');
                    setTimeout(function (){
                        window.location.href = '/admin/anamnesis/create';
                    },2000);
                });
            })
        });
    </script>
@stop
