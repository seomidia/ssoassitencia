@extends('voyager::master')

@section('content')
    <div class="page-content">
        <div class="analytics-container">
            <form method="get" action="{{Route('voyager.busca')}}" style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="nome" name="filter" value="nome" checked>
                            <label class="form-check-label" for="nome">Nome</label>
                            <input type="radio" class="form-check-input" id="cpf" name="filter" value="cpf">
                            <label class="form-check-label" for="cpf">CPF</label>
                            <input type="radio" class="form-check-input" id="cnpj" name="filter" value="cnpj">
                            <label class="form-check-label" for="cnpj">CNPJ</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control mb-5" id="buscar" name="buscar" type="text" class="ui-autocomplete-input" autocomplete="off" placeholder="Buscar Nome do paciente, CPF ou CNPJ" >
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-top: 0px;">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        @if(isset($paciente))
        <div class="page-content">
            <div class="analytics-container" style="padding: 0px 25px 25px;">
                <div class="col-md-12" style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999">
                    <p>{{count($paciente)}} resultados foram encontrados.</p>
                    <table class="table">
                        @if(count($paciente) > 0)
                        @foreach($paciente as $key => $item)
                        <tr>
                            <td><div class="voyager-person" style="font-size: 50px;"></div></td>
                            <td style="font-size: 20px;font-weight: 600;vertical-align: middle;">{{$item->name}} </td>
                            <td style="font-size: 20px;font-weight: 600;vertical-align: middle;">{{$item->cpf}}</td>
                            <td style="background: #22a7f0"><a href="{{$item->id}}" style="text-decoration: none;"><div id="anamnese-{{$item->id}}" style="font-size: 51px;color: #fff;text-align: center;" class="voyager-angle-right"></div></a> </td>
                        </tr>
                        <tr class="anamnese anamnese-{{$item->id}}" style="display: none">
                            <td colspan="6" style="background: #f2f2f2;">
                                <table class="table" style="border: 1px solid #dddddd">
                                    <tr style="background: #22a7f0;color: #ffffff;font-weight: 600">
                                        <td>Empresa</td>
                                        <td>CNPJ</td>
                                        <td>Status</td>
                                        <td>Condição</td>
                                        <td>Data</td>
                                        <td>Ação</td>
                                    </tr>

                                    @foreach(App\Http\Controllers\AnamineseController::get_anamnese($filtro,$item->id) as $key2 => $amnesis)

                                    <tr>
                                        <td>{{$amnesis->nome}}</td>
                                        <td>{{$amnesis->cnpj}}</td>
                                        <td>
                                            <div  class="
                                            @if($amnesis->step == 'step_rh')
                                                alert-danger
                                            @endif
                                            @if($amnesis->step == 'step_funci')
                                                alert-success
                                            @endif
                                            @if($amnesis->step == 'step_med')
                                                alert-primary
                                            @endif
                                                " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
                                                @if($amnesis->step == 'step_rh')
                                                    Não iniciado
                                                @endif
                                                @if($amnesis->step == 'step_funci')
                                                    Funcionario
                                                @endif
                                                @if($amnesis->step == 'step_med')
                                                    Medico
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div  class="
                                        @if(!is_null($amnesis->apt))
                                            @if($amnesis->apt == 0)
                                                alert-danger
                                            @endif
                                            @if($amnesis->apt == 1)
                                                alert-success
                                            @endif
                                            @else
                                                alert-primary
                                            @endif
                                                " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;text-align: center">
                                                @if(!is_null($amnesis->apt))
                                                    @if($amnesis->apt == 1)
                                                        Apto
                                                    @endif
                                                    @if($amnesis->apt == 0)
                                                        Não Apto
                                                    @endif
                                                @else
                                                    Não avaliado
                                                @endif
                                            </div>

                                        </td>
                                        <td>23/11/1987</td>
                                        <td><a id="detalhe" href="{{$amnesis->id}}" style="text-decoration: none;"><div class="voyager-search"></div> </a> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="modal fade" id="ficha-{{$amnesis->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="width: 800px;">
                                                    <div class="modal-content" style="padding: 0px 10px;">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel" style="text-align: center;">Resultado Anamnese</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <table class="table">
                                                            <tr style="background: #ddd;color: #333;">
                                                                <th scope="col" colspan="2" style="text-align: center"><h4>Paciente</h4></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Nome: </th>
                                                                <td>{{$item->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>CPF: </th>
                                                                <td>{{App\Http\Controllers\AnamineseController::formatar_cpf_cnpj($item->cpf)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nasc: </th>
                                                                <td>{{App\Http\Controllers\AnamineseController::data($item->nasc)}}</td>
                                                            </tr>
                                                        </table>

                                                        <table class="table">
                                                            <tr style="background: #ddd;color: #333;">
                                                                <th scope="col" colspan="4" style="text-align: center"><h4>Questionario</h4></th>
                                                            </tr>
                                                            @foreach(App\Http\Controllers\AnamineseController::questions($item->id,$amnesis->id) as $key3 => $section)
                                                            <tr style="background: #22a7f0;color: #fff;">
                                                                <th colspan="4" style="text-align: center">{{ucfirst(str_replace('_',' ',$key3))}}</th>
                                                            </tr>
                                                            @foreach($section as $key4 => $perguntas)
                                                                    <tr>
                                                                        <td>{{ucfirst(str_replace('-',' ',$perguntas->question))}}</td>
                                                                        <td>{{$perguntas->response}}</td>
                                                                        <td>{{$perguntas->response2}}</td>
                                                                        <td>{{$perguntas->response3}}</td>
                                                                    </tr>

                                                                @endforeach
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center">Não existe resultados para esta busca.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        @endif
@stop
@section('javascript')
            <script>
                $(document).ready(function($){
                    $('a#detalhe').on('click',function(event){
                        event.preventDefault();
                        var href = $(this).attr('href');
                        $('#ficha-' + href).modal('show')
                    });

                    $('a').on('click',function(event){
                        event.preventDefault();
                        var href = $(this).attr('href');

                        switch (this.lastChild.className) {
                            case('voyager-angle-right'):
                                $('#anamnese-' + href).removeClass('voyager-angle-right');
                                $('#anamnese-' + href).addClass('voyager-angle-down');
                                break
                            case('voyager-angle-down'):
                                $('#anamnese-' + href).removeClass('voyager-angle-down');
                                $('#anamnese-' + href).addClass('voyager-angle-right');
                                break
                        }

                        $('.anamnese-' + href).toggle();
                    })
                })
            </script>
@stop
