<div class="page-content">
    <div class="analytics-container">
        <form method="get" action="{{Route('voyager.busca')}}" style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <ul class="payment-methods">
                            <li class="payment-method checked-nome">
                                <input name="filter" type="radio" id="checked-nome" value="nome" style="display: none" checked>
                                <label for="checked-nome">Nome</label>
                            </li>

                            <li class="payment-method checked-cpf">
                                <input name="filter" type="radio" id="checked-cpf" value="cpf" style="display: none">
                                <label for="checked-cpf">CPF</label>
                            </li>

                        </ul>

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
                                    <td><img style="border-radius: 50%;" src="{{asset('storage/' . Auth::user()->avatar)}}" width="100"></td>
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
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
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

                                                                        <tr style="background: #ddd;color: #333;">
                                                                            <th scope="col" colspan="4" style="text-align: center"><h4>Avaliação médica</h4></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <form name="form-medico" action="{{Route('feedback.medico')}}" method="post">
                                                                            <tr>
                                                                                <td>Aparelho Auditivo e Visual</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[aparelho-auditivo-e-visual]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[aparelho-auditivo-e-visual]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Cabeça e Pescoço</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[cabeca-e-pescoco]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[cabeca-e-pescoco]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Aparelho Cardiorrespiratório e Vascular</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[aparelho-cardiorrespiratorio-e-vascular]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[aparelho-cardiorrespiratorio-e-vascular]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Aparelho Locomotor</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[aparelho-locomotor]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[aparelho-locomotor]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tórax/Abdômen</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[torax-abdomen]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[torax-abdomen]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Coluna Vertebral</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[coluna-vertebral]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[coluna-vertebral]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Membros Superiores</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[membros-superiores]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[membros-superiores]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Membros Inferiores</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[membros-inferiores]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[membros-inferiores]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Pele e Anexos</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[pele-e-anexos]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[pele-e-anexos]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Avaliação Psiquiátrica</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[avaliacao-psiquiatrica]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                                                    <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                                                    <input name="medico[avaliacao-psiquiatrica]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                                                    <label for="checked-a-declarar">A declarar</label>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><input name="medico[termo]" type="checkbox"  value="sim"></td>
                                                                                <td colspan="3">
                                                                                    DECLARO QUE AS INFORMAÇÕES PRESTADAS SÃO VERDADEIRA E ESTOU
                                                                                    CIENTE DO PROGRAMA DE CONTROLE MÉDICO DE SAÚDE OCUPACIONAL,
                                                                                    PCMSO DA MINHA EMPRESA EM CASO DE ALTERAÇÕES/ERROS, CONCORDO
                                                                                    QUE SERÁ COBRADO UM NOVO EXAME.
                                                                                    ESTOU CIENTE QUE TODAS AS INFORMAÇÕES DO MEU ATENDIMENTO ESTÃO
                                                                                    CORRETAS.
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>ASSINATURA DO FUNCINÁRIO</td>
                                                                                <td colspan="3"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Observações gerais</td>
                                                                                <td colspan="3">
                                                                                    <textarea name="medico[obs]" class="form-control"></textarea>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Data do Exame</td>
                                                                                <td colspan="3">
                                                                                    <input type="date" name="medico[dataExame]">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Status</td>
                                                                                <td colspan="3">
                                                                                    <input name="medico[status]" id="checked-apto" type="radio"  value="1">
                                                                                    <label for="checked-nada-digno-de-nota">Apto</label>
                                                                                    <input name="medico[status]" type="radio" id="checked-inapto" value="0">
                                                                                    <label for="checked-a-declarar">Inapto</label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td colspan="3" style="text-align: right">
                                                                                    <input type="hidden" name="employee" value="{{$item->id}}">
                                                                                    <input type="hidden" name="anamnese" value="{{$amnesis->id}}">
                                                                                    <button name="salvar" type="submit" class="btn btn-success">Salvar</button>
                                                                                </td>
                                                                            </tr>
                                                                        </form>
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
                });
                $('form[name="form-medico"]').submit(function(event){
                    event.preventDefault();

                    var url = $(this).attr('action');

                    $.post(url,$(this).serializeArray(), function (response) {
                        toastr.success('Anamnese atualizada com susesso!');
                        // setTimeout(function (){
                        //     window.location.href = '/admin/encaminhamento';
                        // },2000);
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error(jqXHR.responseJSON.message);
                    })

                });
            })
        </script>
@stop
