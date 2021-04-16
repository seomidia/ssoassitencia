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


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: 1px solid #fff;height: 1135px;">
                <div id="popup-atestado"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="print"><i class="fa fa-print" aria-hidden="true"></i>
                    </button>
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                        Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive desktop">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center">#Codigo</th>
                                    <th style="text-align: center">Empresa</th>
                                    <th class="field" style="text-align: center">Funcionario</th>
                                    <th style="text-align: center">Cargo</th>
                                    <th class="field" style="text-align: center">Ambiente</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Condição</th>
                                    <th style="text-align: center">Exportar</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($anamnese) > 0)
                                        @foreach($anamnese as $key => $item)
                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">#{{$item->id}}</td>
                                                <td style="text-align: center;vertical-align: middle;" class="empresa">{{$item->empresa}}</td>
                                                <td class="field" style="text-align: center">{{$item->funcionario}}</td>
                                                <td style="text-align: center;vertical-align: middle;">{{$item->cargo}}</td>
                                                <td class="field" style="text-align: center">{{$item->ambiente_trabalho}}</td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <div  class="
                                            @if($item->step == 'step_funci')
                                                        alert-success
@endif
                                                    @if($item->step == 'step_med')
                                                        alert-primary
@endif
                                                        aviso">
                                                        @if($item->step == 'step_funci')
                                                            Disponivel
                                                        @endif
                                                        @if($item->step == 'step_med')
                                                            Medico
                                                        @endif
                                                    </div>
                                                </td>
                                                <td  style="text-align: center;vertical-align: middle;">
                                                    <div  class="
                                        @if(!is_null($item->apt))
                                                    @if(in_array($item->apt,[0,'-1','-2','-3']))
                                                        alert-danger
@endif
                                                    @if(in_array($item->apt,[1,2,3]))
                                                        alert-success
@endif
                                                    @else
                                                        alert-primary
@endif
                                                        aviso">
                                                        @if(!is_null($item->apt))
                                                            @if(in_array($item->apt,[1,2,3]))
                                                                Apto
                                                            @endif
                                                                @if(in_array($item->apt,[0,'-1','-2','-3']))
                                                                Não Apto
                                                            @endif
                                                        @else
                                                            Não avaliado
                                                        @endif
                                                    </div>
                                                </td>
                                                </td  style="text-align: center;vertical-align: middle;">
                                                <td>
                                                    @if($item->step == 'step_med' && !is_null($item->apt))
                                                        <a data-toggle="modal" data-target=".bd-example-modal-lg" href="/admin/anamnese/atestado/{{$item->id}}" style="padding: 10px 22px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center btn2">Atestado</a>
                                                    @else
                                                        <a href="/admin/anaminese/questionario/{{$item->id}}" @if($item->step == 'step_med') disabled @endif  class="btn btn-sm btn-primary pull-center btn2  @if($item->step == 'step_med') disabled @endif" ><i class="voyager-edit"></i>Questões</a>
                                                        <a href="{{$item->id}}" @if($item->step == 'step_med') disabled @endif class="btn btn-sm btn-primary pull-center btn2  @if($item->step != 'step_med') devolver @else disabled @endif"><i class="voyager-move"></i>Devolver</a>
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

                                    @else
                                        <tr>
                                            <td colspan="8" style="text-align: center">Não existe Anamnese disponivel no momento !</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                        {{--  Mobile  --}}
                        @foreach($anamnese as $key => $item)
                            <div class="table-responsive mobile">
                            <table class="table table-hover mb-display-{{$item->id}}">

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
                                            <a href="/admin/anaminese/questionario/{{$item->id}}" @if($item->step == 'step_med') disabled @endif  class="btn btn-sm btn-primary pull-center btn2  @if($item->step == 'step_med') disabled @endif" ><i class="voyager-edit"></i>Questões</a>
                                            <a href="{{$item->id}}" @if($item->step == 'step_med') disabled @endif class="btn btn-sm btn-primary pull-center btn2  @if($item->step != 'step_med') devolver @else disabled @endif"><i class="voyager-move"></i>Devolver</a>
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
                            </table>
                            </div>
                        @endforeach

                    @if(count($anamnese) == 0)
                            <div class="table-responsive mobile">
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
            $('.atestado').click(function(){
                var href = window.location.origin + $(this).attr('href');
                console.log(href);
                $('#popup-atestado').html('ola')
                // $('#popup-atestado').load(href)
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
