<div class="col-md-12">
    <div class="row">
        <div class="form-group col-md-4">
            <label> O que deseja?</label>
            <select class="form-control form-control-sm" aria-label=".form-select-sm example" name="prod[]" onchange="getServicos(this)">
                <option value="" selected>Selecione</option>
                @foreach($categoria as $key => $item)
                    <option value="{{$item->id}}">{{$item->categoria}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4" id="consultas" style="display: none">
            <label> Serviço</label>
            <select class="form-control form-control-sm" aria-label=".form-select-sm example" onchange="next(this)"></select>
        </div>
    </div>
</div>
