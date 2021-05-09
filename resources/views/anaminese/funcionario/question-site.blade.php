<tr>
    <td style="vertical-align: middle">{{$item->empresa}}</td>
    <td style="vertical-align: middle">{{$item->funcionario}}</td>
    <td style="vertical-align: middle">{{$item->cargo}}</td>
    <td style="vertical-align: middle">
        <div  class="
            @if($item->step == 'step_site')
                alert-danger
            @endif
            @if($item->step == 'step_funci')
                alert-success
            @endif
            @if($item->step == 'step_med')
                alert-primary
            @endif
            aviso">
            @if($item->step == 'step_site')
                Não iniciado
            @endif
            @if($item->step == 'step_funci')
                Funcionario
            @endif
            @if($item->step == 'step_med')
                Medico
            @endif
        </div>
    </td>
    <td  style="vertical-align: middle">
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
            aviso">
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
    <td style="vertical-align: middle">
        @if($item->step == 'step_med' && !is_null($item->apt))
            <a href="/admin/anamnese/atestado/{{$item->id}}/" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="atestado btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center">Atestado</a>
            <a  href="/admin/anamnese/atestado/{{$item->id}}/send" style="padding: 5px 12px 10px 10px;font-weight: bold;font-size: 13px;margin-top: 6px;"  class="send btn btn-sm @if(in_array($item->apt,[1,2,3])) btn-success @endif @if(in_array($item->apt,[0,'-1','-2','-3'])) btn-danger @endif pull-center"><i class="fa fa-send" aria-hidden="true"></i></a>
        @else
            <a href="/admin/anaminese/cadastro/{{$item->id}}"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
            <a href="/admin/encaminhamento/{{$item->id}}/delete" id="delete"  class="btn btn-sm btn-danger pull-center" style="padding: 2px 7px;"><i class="voyager-trash"></i></a>
        @endif
    </td>
    </td>
</tr>
