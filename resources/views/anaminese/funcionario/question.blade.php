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
    <td style="vertical-align: middle">
        @if($item->step == 'step_med' && !is_null($item->apt))
            <a href="/admin/anamnese/atestado/{{$item->id}}/" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center">Atestado</a>
            <a  href="/admin/anamnese/atestado/{{$item->id}}/send" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="send btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center"><i class="fa fa-send" aria-hidden="true"></i></a>
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
