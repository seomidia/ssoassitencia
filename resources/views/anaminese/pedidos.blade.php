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
                                @if(count($orders) != 0)
                                    @include('anaminese.funcionario.question-orders')
                                @else
                                    <tr>
                                        <td colspan="8" style="text-align: center">Não existe pedidos disponivel no momento !</td>
                                    </tr>

                                @endif

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
