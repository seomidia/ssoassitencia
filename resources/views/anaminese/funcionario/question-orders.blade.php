
<thead>
<tr>
    <th style="text-align: center">Codigo</th>
    <th style="text-align: center">Produto</th>
    <th style="text-align: center">Valor</th>
    <th style="text-align: center">Ação</th>
</tr>
</thead>
<tbody>
  @foreach($order as $key => $item)
        <tr class="bg-info">
            <td style="vertical-align: middle;text-align: center">#{{$item->produto_id}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->name}}</td>
            <td style="vertical-align: middle;text-align: center">R$ {{\App\Http\Controllers\Controller::formatCash($item->price)}}</td>
            <td style="vertical-align: middle;text-align: center">
                @if($order[0]->status == 'Paga' || $order[0]->status == 'Disponivel')
                    @if(!$item->sprod)
                        <a href="/admin/create-service/{{$item->produto_id}}/{{$order[0]->order}}" class="btn btn-success createService">Criar</a>
                    @else
                        <button class="btn bg-danger disabled">Já encaminhado</button>
                    @endif
                @endif

            </td>
        </tr>
    @endforeach
</tbody>

