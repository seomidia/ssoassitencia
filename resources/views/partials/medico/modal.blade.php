<div class="modal fade" id="ficha-{{$amnesis->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 1200px;">
        <div class="modal-content" style="padding: 0px 10px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <table class="table">
                <tr>
                    <th style="background: #22a7f0;text-align:center;color:#ffffff;;border:1px solid #22a7f0;text-align: center"><h4>Paciente</h4></th>
                    <th style="vertical-align: middle;border:1px solid #dddddd;font-weight: bold;color: #000000;text-align: center"><b>Nome</b> </th>
                    <td style="vertical-align: middle;border:1px solid #dddddd;text-align: center">{{$item->name}}</td>
                    <th style="vertical-align: middle;border:1px solid #dddddd;font-weight: bold;color: #000000;text-align: center"><b>CPF</b> </th>
                    <td style="vertical-align: middle;border:1px solid #dddddd;text-align: center">{{App\Http\Controllers\AnamineseController::formatar_cpf_cnpj($item->cpf)}}</td>
                    <th style="vertical-align: middle;border:1px solid #dddddd;font-weight: bold;color: #000000;text-align: center"><b>Nasc</b> </th>
                    <td style="vertical-align: middle;border:1px solid #dddddd;text-align: center">{{App\Http\Controllers\AnamineseController::data($item->nasc)}}</td>
                </tr>
                <tr>
                    <td colspan="7">

                        <ul class="tabs">
                            <li class="tab-button"><a href="#" class="tab-link ativo" data-tab="tab1-{{$amnesis->id}}">Questionário</a></li>
                            <li class="tab-button"><a href="#" class="tab-link" data-tab="tab2-{{$amnesis->id}}"> Avaliação</a></li>
                          </ul>
                          <div class="tab-pane">
                            <div class="tab-panel ativo" id="tab1-{{$amnesis->id}}">

                                <table class="table">
                                    <tr>
                                        <th colspan="7" style="text-align: center"><h4>Questionario</h4></th>
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
                                
                                </table>
                                

                            </div>
                            <div class="tab-panel" id="tab2-{{$amnesis->id}}">
                                <table class="table">
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
                                                $aavo = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-auditivo-e-visual','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($aav == 'nada-digno-de-nota') checked @endif name="medico[aparelho-auditivo-e-visual][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input  @if($aav == 'a-declarar') checked @endif  name="medico[aparelho-auditivo-e-visual][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[aparelho-auditivo-e-visual][]" type="text" placeholder="Descreva" value="{{$aavo}}">
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cabeça e Pescoço</td>
                                            @php
                                                $cp = \App\Anamnesi::get_meta_question($amnesis->id,'cabeca-e-pescoco');
                                                $cpo = \App\Anamnesi::get_meta_question($amnesis->id,'cabeca-e-pescoco','outros');
                                            @endphp
                                
                                            <td colspan="3">
                                                <input @if($cp == 'nada-digno-de-nota') checked @endif name="medico[cabeca-e-pescoco][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($cp == 'a-declarar') checked @endif name="medico[cabeca-e-pescoco][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[cabeca-e-pescoco][]" type="text" placeholder="Descreva" value="{{$cpo}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aparelho Cardiorrespiratório e Vascular</td>
                                            @php
                                                $acv = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-cardiorrespiratorio-e-vascular');
                                                $acvo = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-cardiorrespiratorio-e-vascular','outros');
                                            @endphp
                                
                                            <td colspan="3">
                                                <input @if($acv == 'nada-digno-de-nota') checked @endif name="medico[aparelho-cardiorrespiratorio-e-vascular][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($acv == 'a-declarar') checked @endif name="medico[aparelho-cardiorrespiratorio-e-vascular][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[aparelho-cardiorrespiratorio-e-vascular][]" type="text" placeholder="Descreva" value="{{$acvo}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aparelho Locomotor</td>
                                            @php
                                                $al = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-locomotor');
                                                $alo = \App\Anamnesi::get_meta_question($amnesis->id,'aparelho-locomotor','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($al == 'nada-digno-de-nota') checked @endif name="medico[aparelho-locomotor][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($al == 'a-declarar') checked @endif name="medico[aparelho-locomotor][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[aparelho-locomotor][]" type="text" placeholder="Descreva" value="{{$alo}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tórax/Abdômen</td>
                                            @php
                                                $ta = \App\Anamnesi::get_meta_question($amnesis->id,'torax-abdomen');
                                                $tao = \App\Anamnesi::get_meta_question($amnesis->id,'torax-abdomen','outros');
                                            @endphp
                                
                                            <td colspan="3">
                                                <input @if($ta == 'nada-digno-de-nota') checked @endif  name="medico[torax-abdomen][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($ta == 'a-declarar') checked @endif name="medico[torax-abdomen][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[torax-abdomen][]" type="text" placeholder="Descreva" value="{{$tao}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Coluna Vertebral</td>
                                            @php
                                                $cv = \App\Anamnesi::get_meta_question($amnesis->id,'coluna-vertebral');
                                                $cvo = \App\Anamnesi::get_meta_question($amnesis->id,'coluna-vertebral','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($cv == 'nada-digno-de-nota') checked @endif name="medico[coluna-vertebral][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($cv == 'a-declarar') checked @endif name="medico[coluna-vertebral][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[coluna-vertebral][]" type="text" placeholder="Descreva" value="{{$cvo}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Membros Superiores</td>
                                            @php
                                                $ms = \App\Anamnesi::get_meta_question($amnesis->id,'membros-superiores');
                                                $mso = \App\Anamnesi::get_meta_question($amnesis->id,'membros-superiores','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($ms == 'nada-digno-de-nota') checked @endif name="medico[membros-superiores][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input  @if($ms == 'a-declarar') checked @endif name="medico[membros-superiores][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[membros-superiores][]" type="text" placeholder="Descreva" value="{{$mso}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Membros Inferiores</td>
                                            @php
                                                $mi = \App\Anamnesi::get_meta_question($amnesis->id,'membros-inferiores');
                                                $mio = \App\Anamnesi::get_meta_question($amnesis->id,'membros-inferiores','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($mi == 'nada-digno-de-nota') checked @endif name="medico[membros-inferiores][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($mi == 'a-declarar') checked @endif name="medico[membros-inferiores][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[membros-inferiores][]" type="text" placeholder="Descreva" value="{{$mio}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pele e Anexos</td>
                                            @php
                                                $pa = \App\Anamnesi::get_meta_question($amnesis->id,'pele-e-anexos');
                                                $pao = \App\Anamnesi::get_meta_question($amnesis->id,'pele-e-anexos','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($pa == 'nada-digno-de-nota') checked @endif name="medico[pele-e-anexos][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($pa == 'a-declarar') checked @endif name="medico[pele-e-anexos][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[pele-e-anexos][]" type="text" placeholder="Descreva" value="{{$pao}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Avaliação Psiquiátrica</td>
                                            @php
                                                $ap = \App\Anamnesi::get_meta_question($amnesis->id,'avaliacao-psiquiatrica');
                                                $apo = \App\Anamnesi::get_meta_question($amnesis->id,'avaliacao-psiquiatrica','outros');
                                            @endphp
                                            <td colspan="3">
                                                <input @if($ap == 'nada-digno-de-nota') checked @endif name="medico[avaliacao-psiquiatrica][]" id="checked-nada-digno-de-nota" type="radio"  value="nada-digno-de-nota">
                                                <label for="checked-nada-digno-de-nota">Nada digno de nota</label>
                                                <input @if($ap == 'a-declarar') checked @endif name="medico[avaliacao-psiquiatrica][]" type="radio" id="checked-a-declarar" value="a-declarar">
                                                <label for="checked-a-declarar">A declarar</label>
                                                <input class="form-control" name="medico[avaliacao-psiquiatrica][]" type="text" placeholder="Descreva" value="{{$apo}}">
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
                                            <td>FOTO DO FUNCINÁRIO</td>
                                            <td colspan="3">
                                                <div class="fotografar-{{$amnesis->id}}" style="display: none">
                                                    <div  class="camera camera-{{$amnesis->id}}"></div>
                                                    <div id="results-{{$amnesis->id}}" class="results" >
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </div>
                                                @php
                                                    $photo = \App\Anamnesi::get_meta_question($amnesis->id,'photo_employee');
                                                @endphp
                                
                                                @if($photo != '')
                                                    <img class="fechar-{{$amnesis->id}}" src="{{$photo}}" style="width: 272px;margin-left: 10px;"/>
                                                @endif
                                
                                
                                                <div><a href="{{$amnesis->id}}" class="start fechar-{{$amnesis->id}}" style="margin: 10px;display: block;width: 100px;background: #22a7f0;padding: 10px;text-align: center;color: #fff;text-decoration: none;font-weight: bold;"><span style="color: #fff;font-weight: bold;margin-right: 5px;" class="voyager-photo"></span>Imagem</a></div>
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Parecer Médico</td>
                                            @php
                                                $parecer = \DB::table('anamnesis')
                                                        ->select('parecer')
                                                        ->where('id',$amnesis->id)
                                                        ->get();
                                            @endphp
                                
                                            <td colspan="3">
                                                <textarea  name="medico[parecer]" class="form-control">{{$parecer[0]->parecer}} </textarea>
                                            </td>
                                        </tr>
                                        @php
                                            $obs = \DB::table('anamnesis')
                                                    ->select('message')
                                                    ->where('id',$amnesis->id)
                                                    ->get();
                                        @endphp
                                        @if(isset($obs[0]->message))
                                        <tr>
                                            <td>Observações gerais</td>
                                
                                            <td colspan="3">
                                                {{$obs[0]->message}}
                                            </td>
                                        </tr>
                                        @endif
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
                                                <ul class="nav">
                                                @foreach(\App\Anamnesi::get_procedures($amnesis->id) as $key => $procedure)
                                                    <li class="nav-link @if($procedure->path_file){{'alert-primary'}} @else {{'alert-danger'}} @endif" style="list-style:none;font-size: 15px;font-weight: bold;padding: 5px;border-bottom: 1px solid;margin-bottom: 5px;">
                                                        @if($procedure->path_file)
                                                           <a target="_black" href="{{asset($procedure->path_file)}}">{{$procedure->name}}</a>
                                                           @else 
                                                           {{$procedure->name}}
                                                           @endif
                                                    </li>
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
                                                <input type="hidden" id="photo_employee-{{$amnesis->id}}" name="photo_employee" value="{{$photo}}">
                                                <input type=button value="Gravar" style="margin-top: 16px;border: 0;padding: 10px;background: #333;color: #fff;font-weight: bold;float: ;" onClick="take_snapshot({{$amnesis->id}})">

                                                <button name="salvar" type="submit" class="btn btn-success">Salvar</button>
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                                
                            </div>
                          </div>
                    </td>

                </tr>
            </table>
            
        </div>
    </div>
</div>
