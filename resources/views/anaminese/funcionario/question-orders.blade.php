
<thead>
<tr>
    <th style="text-align: center">Consulta</th>
    <th style="text-align: center">Tipo pagamento</th>
    <th style="text-align: center">Referencia</th>
    <th style="text-align: center">Valor</th>
    <th style="text-align: center">Status</th>
    <th style="text-align: center">Data</th>
</tr>
</thead>
<tbody>
@foreach($orders as $key => $item)

        <tr class="
        @if($item->status == 'Aguardando pagamento')
            bg-warning
        @elseif($item->status == 'Paga')
            bg-success
        @elseif($item->status == 'Devolvida' || $item->status == 'Cancelado')
            bg-danger
        @else
            bg-info
        @endif
        ">
            <td style="vertical-align: middle">{{$item->name}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->payment_type}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->code}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->price}}</td>
            <td style="vertical-align: middle;text-align: center"><div  class="aviso">{{$item->status}}</td>
            <td style="vertical-align: middle;text-align: center">{{$item->created_at}}</td>
        </tr>
@endforeach
</tbody>

