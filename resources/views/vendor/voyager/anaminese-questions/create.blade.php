<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Sessão </label>
    <select class="form-control select2" name="sessao">
        @php
            $session = DB::table('anaminese_sessions')
                          ->select('id','name')
                          ->get();

              foreach ($session as $key => $item) {
                 echo '<option value="'. $item->id .'">'. $item->name .'</option>';
              }
        @endphp
    </select>
</div>
<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Pergunta</label>
    <input required="" type="text" class="form-control" name="description" placeholder="Pergunta" value="">
</div>
<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Pergunta mãe</label>
    <select class="form-control select2" name="parent">
        <option value="">Selecione (opcional)</option>
        @php
            $session = DB::table('anaminese_questions')
                          ->select('id','description')
                          ->get();

              foreach ($session as $key => $item) {
                 echo '<option value="'. $item->id .'">'. $item->description .'</option>';
              }
        @endphp
    </select>
</div>
<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Tipo resposta </label>
    <select class="form-control select2" name="type_response">
        <option value="1">Sim & Não</option>
        <option value="2">Tenho & Não tenho</option>
        <option value="3">Numeral</option>
        <option value="4">Checkbox</option>
        <option value="5">Texto</option>
    </select>
</div>
