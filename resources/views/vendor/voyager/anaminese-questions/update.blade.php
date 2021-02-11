@php

    $question = DB::table('anaminese_questions')
                  ->select('*')
                  ->where('id',$dataTypeContent->id)
                  ->get()[0];



@endphp

<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Sessão </label>
    <select class="form-control select2" name="sessao">
        @php
          $session = DB::table('anaminese_sessions')
                        ->select('id','name')
                        ->get();

            foreach ($session as $key => $item) {
                $selected = ($question->anaminese_sessions_id == $item->id) ? 'selected' : '';
               echo '<option value="'. $item->id .'" '.$selected.'>'. $item->name .'</option>';
            }
        @endphp
    </select>
</div>
<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Pergunta</label>
    <input required="" type="text" class="form-control" name="description" placeholder="Pergunta" value="{{$dataTypeContent->description}}">
</div>
<div class="form-group  col-md-12 ">
    <label class="control-label" for="name">Pergunta mãe</label>
    <select class="form-control select2" name="parent">
        @php
            $session = DB::table('anaminese_questions')
                          ->select('id','description')
                          ->get();

              foreach ($session as $key => $item) {
                $selected = ($item->id == $question->parent) ? 'selected' : '';
                echo '<option value="'. $item->id .'" '.$selected.'>'. $item->description .'</option>';

              }
        @endphp
    </select>
</div>
<input type="hidden" name="anaminese_questions_id" value="{{$dataTypeContent->id}}">

