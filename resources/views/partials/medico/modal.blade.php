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
                    @if($key3 != 'medico')
                        <tr style="background: #22a7f0;color: #fff;">
                            <th colspan="4" style="text-align: center">{{ucfirst(str_replace('_',' ',$key3))}}</th>
                        </tr>
                        @foreach($section as $key4 => $perguntas)
                            <tr>
                                <td>{{ucfirst(str_replace('-',' ',$perguntas->question))}}</td>
                                <td>{{ucfirst(str_replace('-',' ',$perguntas->response))}}</td>
                                <td>{{$perguntas->response2}}</td>
                                <td>{{$perguntas->response3}}</td>
                            </tr>

                        @endforeach
                    @endif
                @endforeach

                <tr style="background: #ddd;color: #333;">
                    <th scope="col" colspan="4" style="text-align: center"><h4>Avaliação médica</h4></th>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <form name="form-medico" action="{{Route('feedback.medico')}}" method="post">
                    <tr>
                        <td>Aparelho Auditivo e Visual </td>
                        @php
                            $aav = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-auditivo-e-visual');
                        @endphp
                        <td colspan="3">
                            <input @if($aav == 'nada-digno-de-nota') checked @endif name="medico[aparelho-auditivo-e-visual]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input  @if($aav == 'a-declarar') checked @endif  name="medico[aparelho-auditivo-e-visual]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Cabeça e Pescoço</td>
                        @php
                            $cp = \App\Anamnesi::get_meta_question($amnesis->id,'cabeca-e-pescoco');
                        @endphp

                        <td colspan="3">
                            <input @if($cp == 'nada-digno-de-nota') checked @endif name="medico[cabeca-e-pescoco]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($cp == 'a-declarar') checked @endif name="medico[cabeca-e-pescoco]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Aparelho Cardiorrespiratório e Vascular</td>
                        @php
                            $acv = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-cardiorrespiratorio-e-vascular');
                        @endphp

                        <td colspan="3">
                            <input @if($acv == 'nada-digno-de-nota') checked @endif name="medico[aparelho-cardiorrespiratorio-e-vascular]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($acv == 'a-declarar') checked @endif name="medico[aparelho-cardiorrespiratorio-e-vascular]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Aparelho Locomotor</td>
                        @php
                            $al = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-locomotor');
                        @endphp
                        <td colspan="3">
                            <input @if($al == 'nada-digno-de-nota') checked @endif name="medico[aparelho-locomotor]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($al == 'a-declarar') checked @endif name="medico[aparelho-locomotor]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Tórax/Abdômen</td>
                        @php
                            $ta = \App\Anamnesi::get_meta_question($amnesis->id,'torax-abdomen');
                        @endphp

                        <td colspan="3">
                            <input @if($ta == 'nada-digno-de-nota') checked @endif  name="medico[torax-abdomen]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($ta == 'a-declarar') checked @endif name="medico[torax-abdomen]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Coluna Vertebral</td>
                        @php
                            $cv = \App\Anamnesi::get_meta_question($amnesis->id,'coluna-vertebral');
                        @endphp
                        <td colspan="3">
                            <input @if($cv == 'nada-digno-de-nota') checked @endif name="medico[coluna-vertebral]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($cv == 'a-declarar') checked @endif name="medico[coluna-vertebral]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Membros Superiores</td>
                        @php
                            $ms = \App\Anamnesi::get_meta_question($amnesis->id,'membros-superiores');
                        @endphp
                        <td colspan="3">
                            <input @if($ms == 'nada-digno-de-nota') checked @endif name="medico[membros-superiores]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input  @if($ms == 'a-declarar') checked @endif name="medico[membros-superiores]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Membros Inferiores</td>
                        @php
                            $mi = \App\Anamnesi::get_meta_question($amnesis->id,'membros-inferiores');
                        @endphp
                        <td colspan="3">
                            <input @if($mi == 'nada-digno-de-nota') checked @endif name="medico[membros-inferiores]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($mi == 'a-declarar') checked @endif name="medico[membros-inferiores]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Pele e Anexos</td>
                        @php
                            $pa = \App\Anamnesi::get_meta_question($amnesis->id,'pele-e-anexos');
                        @endphp
                        <td colspan="3">
                            <input @if($pa == 'nada-digno-de-nota') checked @endif name="medico[pele-e-anexos]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($pa == 'a-declarar') checked @endif name="medico[pele-e-anexos]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        <td>Avaliação Psiquiátrica</td>
                        @php
                            $ap = \App\Anamnesi::get_meta_question($amnesis->id,'avaliacao-psiquiatrica');
                        @endphp
                        <td colspan="3">
                            <input @if($ap == 'nada-digno-de-nota') checked @endif name="medico[avaliacao-psiquiatrica]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                            <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                            <input @if($ap == 'a-declarar') checked @endif name="medico[avaliacao-psiquiatrica]" type="radio" id="checked-a-declarar" value="a-declarar">
                            <label for="checked-a-declarar">A declarar</label>

                        </td>
                    </tr>
                    <tr>
                        @php
                            $termo = \App\Anamnesi::get_meta_question($amnesis->id,'termo');
                        @endphp

                        <td><input @if($termo == 'sim') checked @endif name="medico[termo]" type="checkbox"  value="sim"></td>
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
                        <td>Parecer Médico</td>
                        @php
                            $parecer = \App\Anamnesi::get_meta_question($amnesis->id,'parecer_medico');
                        @endphp

                        <td colspan="3">
                            {{$parecer}}
                        </td>
                    </tr>
                    <tr>
                        <td>Observações gerais</td>
                        @php
                            $obs = \App\Anamnesi::get_meta_question($amnesis->id,'obs');
                        @endphp

                        <td colspan="3">
                            <textarea  name="medico[obs]" class="form-control">{{$obs}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Data do Exame</td>
                        @php
                            $data = \App\Anamnesi::get_meta_question($amnesis->id,'dataExame');
                        @endphp

                        <td colspan="3">
                            <input  type="date" name="medico[dataExame]" value="{{str_replace('/','-',$data)}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Procedimentos diagnóstico</td>
                        <td colspan="3">
                            <ul>
                            @foreach(\App\Anamnesi::get_procedures($amnesis->id) as $key => $procedure)
                                <li class="alert-primary" style="list-style:none;font-size: 18px;font-weight: bold;padding: 5px;border-bottom: 1px solid;margin-bottom: 5px;">{{$procedure->name}}</li>
                            @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td colspan="3">
                            @php
                                $status = \App\Anamnesi::get_meta_question($amnesis->id,'status');
                            @endphp

                            <select class="form-control select2" name="medico[status]">
                                <option @if(is_null($amnesis->apt)) selected @endif value="">Selecione o status</option>
                                <option @if($amnesis->apt == 1) selected @endif value="1">Apto sem restrições</option>
                                <option @if($amnesis->apt == 2) selected @endif value="2">Apto p/ trabalho em altura</option>
                                <option @if($amnesis->apt == 3) selected @endif value="3">Apto p/ trabalho espaço confinado</option>
                                <option @if($amnesis->apt == 4) selected @endif value="1">Apto sem restrições</option>
                                <option @if($amnesis->apt == 0) selected @endif value="0">Inapto</option>
                                <option @if($amnesis->apt == -1) selected @endif value="-1">Inapto temporariamente</option>
                                <option @if($amnesis->apt == -2) selected @endif value="-2">Inapto p/ trabalho em altura</option>
                                <option @if($amnesis->apt == -3) selected @endif value="-3">Inapto p/ espaço confinado</option>
                            </select>
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
