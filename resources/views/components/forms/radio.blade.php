<ul class="payment-methods">
    <li class="payment-method checked">
        <input name="{{$name}}" type="radio" id="checked-{{$slug}}" value="{{$valor[0]}}" style="display: none">
        <label for="checked-{{$slug}}">{{$valor[0]}}</label>
    </li>

    <li class="payment-method checked-off">
        <input name="{{$name}}" type="radio" id="checked-off-{{$slug}}" value="{{$valor[1]}}" style="display: none">
        <label for="checked-off-{{$slug}}">{{$valor[1]}}</label>
    </li>

</ul>
