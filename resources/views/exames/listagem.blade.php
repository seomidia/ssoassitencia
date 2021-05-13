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
                                        </td>
                                        </td>
                                    </tr>
                                        <tr id="upload-{{$item->id}}" style="display: none">
                                            <td colspan="5">
                                                <form  name="form-{{$item->id}}" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input  type="file" name="arquivo-{{$item->id}}">
                                                        </div>
                                                    </div>
                                                </form>
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
                $('#upload-'+href).toggle();
            });
            $('form').on('change',function(){
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


            })
            $('a.ver-exame').click(function(event){
                event.preventDefault();
                $('iframe').attr('src','');
                var href = $(this).attr('href');
                $('iframe').attr('src',href);
                $('.modal').modal('show');
            });
        });
    </script>
@stop
