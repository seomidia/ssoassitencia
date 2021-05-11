
<thead>
<tr>
    <th style="text-align: center">Codigo</th>
    <th style="text-align: center">Produto</th>
    <th style="text-align: center">Valor</th>
</tr>
</thead>
<tbody>
  @foreach($order as $key => $item)
        <tr class="bg-info">
            <td style="vertical-align: middle;text-align: center">#{{$item->produto_id}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->name}}</td>
            <td style="vertical-align: middle;text-align: center">R$ {{\App\Http\Controllers\Controller::formatCash($item->price)}}</td>
        </tr>
    @endforeach
</tbody>

