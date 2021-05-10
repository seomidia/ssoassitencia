@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Exames'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Exames')}}
    </h1>

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
                                        <div  class="
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
                                        <a href="#" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm btn-danger pull-center">Ver</a>
                                        <a href="#" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm btn-danger pull-center">Upload</a>
                                    </td>
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
