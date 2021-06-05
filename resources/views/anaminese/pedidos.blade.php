@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Pedidos'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-basket"></i>
        {{ __('Pedidos')}}
    </h1>
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
                                    <th style="text-align: center">Codigo</th>
                                    <th style="text-align: center">Tipo pagamento</th>
                                    <th style="text-align: center">Referencia</th>
                                    <th style="text-align: center">Valor total</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    <tr id="{{$key}}" class="
                                            @if(
                                                $order[0]->status == 'Paga'
                                                || $order[0]->status == 'Disponível'
                                                ) bg-success @endif
                                            @if(
                                                $order[0]->status == 'Cancelada'
                                                || $order[0]->status == 'Devolvida'
                                                ) bg-danger @endif
                                            @if(
                                                $order[0]->status == 'Aguardando pagamento'
                                                || $order[0]->status == 'pedding'
                                                || $order[0]->status == 'Em disputa'
                                                || $order[0]->status == 'Em análise'
                                                ) bg-warning @endif
                                        ">
                                        <td style="text-align: center">#{{$key}}</td>
                                        <td style="text-align: center">{{$order[0]->payment_type}}</td>
                                        <td style="text-align: center">{{$order[0]->code}}</td>
                                        <td style="vertical-align: middle;text-align: center">R$ {{\App\Http\Controllers\Controller::formatCash($order[0]->total)}}</td>
                                        <td style="text-align: center">@if($order[0]->status == 'pedding') Pendente @else {{$order[0]->status}} @endif</td>
                                        <td style="vertical-align: middle;text-align: center">{{\App\Http\Controllers\Controller::data($order[0]->created_at,'time')}}</td>
                                    </tr>
                                    <tr id="content-{{$key}}" style="display: none">
                                        <td colspan="6">
                                            <table class="table table-hover">
                                                @if(count($orders) != 0)
                                                    @include('anaminese.funcionario.question-orders')
                                                @else
                                                    <tr>
                                                        <td colspan="8" style="text-align: center">Não existe pedidos disponivel no momento !</td>
                                                    </tr>

                                                @endif
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
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
            $('.createService').click(function(event){
                event.preventDefault();

                $('#voyager-loader').show('slow');
                var url = $(this).attr('href');
                $.get(url, function (response) {
                    toastr.success('Criando serviço...');
                    setTimeout(function (){
                        window.location.href = 'pedidos';
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
            $('table#dataTable tr').click(function (event){
                event.preventDefault();

                var id =  $(this).attr('id');
                $('#dataTable #content-'+id).toggle()
            })
        });
    </script>
@stop
