    <input type="search" class="form-control" id="search" placeholder="Buscar exames">
        <div class="searchable-container">
            <div class="row">
            @foreach($exames as $key => $itens)
                <div class="items col-md-4" style="margin: 0 auto;">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default addcart">
                                <div class="bizcontent">
                                    <input type="checkbox" name="prod[]" autocomplete="off" onchange="addCart()" value="{{$itens->id}}">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5 style="font-size: 0.9rem">{{$itens->name}}</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
