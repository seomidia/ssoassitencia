@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('SSO SYSTEM - Anamnese'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Anamnese')}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive" style="display: none">
                            <table class="table table-hover">
                                <thead>
                                <tr>
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
                                    <td style="text-align: center">#{{$item->id}}</td>
                                    <td style="text-align: center" class="empresa">{{$item->empresa}}</td>
                                    <td style="text-align: center">{{$item->funcionario}}</td>
                                    <td style="text-align: center">{{$item->cargo}}</td>
                                    <td style="text-align: center">{{$item->ambiente_trabalho}}</td>
                                    <td style="text-align: center">
                                        <div  class="
                                            @if($item->step == 'step_funci')
                                                alert-success
                                            @endif
                                            @if($item->step == 'step_med')
                                                alert-primary
                                            @endif
                                                " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
                                            @if($item->step == 'step_funci')
                                                Disponivel
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
                                    </td>
                                    </td  style="text-align: center">
                                    <td>
                                        @if($item->step == 'step_med' && !is_null($item->apt))
                                                <button  class="btn btn-sm @if($item->apt == 1) btn-success @endif @if($item->apt == 0) btn-danger @endif pull-center" style="padding: 2px 7px;">Atestado</button>
                                        @else
                                            <a href="/admin/anaminese/questionario/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                            <a href="{{$item->id}}" class="btn btn-sm btn-primary pull-center devolver" style="padding: 2px 7px;"><i class="voyager-move"></i> Devolver</a>
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                                <tr style="display: none" class="justificar-{{$item->id}}">
                                    <td colspan="8" class="text-danger" style="text-align: right">
                                        <form name="devolver" action="/admin/anaminese/devolver" type="post">
                                            <textarea name="motivo" class="form-control" placeholder="Informe a causa da devolução"></textarea>
                                            <input name="anamnese_id" value="{{$item->id}}" type="hidden">
                                            <button type="submit"  class="btn btn-sm  btn-primary pull-center" style="padding: 2px 7px;">Enviar</button>
                                            <a href="#" class="btn btn-sm  btn-danger pull-center cancelar" style="padding: 2px 7px;">Cancelar</a>
                                        </form>
                                    </td>
                                </tr>

                                    @endforeach


                                    @if(count($anamnese) == 0)
                                        <tr>
                                            <td colspan="8" style="text-align: center">Não existe Anamnese disponivel no momento!</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        @foreach($anamnese as $key => $item)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#Codigo</th>
                                        <td>{{$item->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Empresa</th>
                                        <td>{{$item->empresa}}</td>
                                    </tr>
                                    <tr>
                                        <th>Funcionario</th>
                                        <td>{{$item->funcionario}}</td>
                                    </tr>
                                    <tr>
                                        <th>Cargo</th>
                                        <td>{{$item->cargo}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ambiente</th>
                                        <td>{{$item->ambiente_trabalho}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <div  class="
                                            @if($item->step == 'step_funci')
                                                alert-success
                                            @endif
                                            @if($item->step == 'step_med')
                                                alert-primary
                                            @endif
                                                " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
                                                @if($item->step == 'step_funci')
                                                    Disponivel
                                                @endif
                                                @if($item->step == 'step_med')
                                                    Medico
                                                @endif
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Condição</th>
                                        <td>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ação</th>
                                        <td>
                                            @if($item->step == 'step_med' && !is_null($item->apt))
                                                <button  class="btn btn-sm @if($item->apt == 1) btn-success @endif @if($item->apt == 0) btn-danger @endif pull-center" style="padding: 2px 7px;">Atestado</button>
                                            @else
                                                <a href="/admin/anaminese/questionario/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                                <a href="{{$item->id}}" class="btn btn-sm btn-primary pull-center devolver" style="padding: 2px 7px;"><i class="voyager-move"></i> Devolver</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="display: none" class="justificar-{{$item->id}}">
                                        <td colspan="2">
                                            <form name="devolver" action="/admin/anaminese/devolver" type="post">
                                                <textarea name="motivo" class="form-control" placeholder="Informe a causa da devolução"></textarea>
                                                <input name="anamnese_id" value="{{$item->id}}" type="hidden">
                                                <button type="submit"  class="btn btn-sm  btn-primary pull-center" style="padding: 2px 7px;">Enviar</button>
                                                <a href="#" class="btn btn-sm  btn-danger pull-center cancelar" style="padding: 2px 7px;">Cancelar</a>
                                            </form>

                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        @endforeach
                        @if(count($anamnese) == 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td colspan="2" style="text-align: center">Não existe Anamnese disponivel no momento!</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        @endif
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

            $('form[name="devolver"]').submit(function(event){
                event.preventDefault();
                var url= $(this).attr('action');
                var data = $(this).serializeArray();

                $.post(url, $(this).serializeArray(), function (response) {
                    toastr.success('Anaminese foi devolvida ao RH...');
                    setTimeout(function (){
                        window.location.href = 'anaminese';
                    },2000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

            $('a.devolver').click(function (event) {
                event.preventDefault();

                var id = $(this).attr('href');
                $('.justificar-' + id).toggle()
            });
            $('a.cancelar').click(function (event) {
                event.preventDefault();
                var id = $('a.devolver').attr('href');

                $('.justificar-' + id).hide();
            });

        });
    </script>
@stop
