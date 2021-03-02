<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AnamineseQuestion;
use DB;
class AnamineseQuestionController extends Controller
{

    public function store(Request $request)
    {
        $data = [
                'anaminese_sessions_id' => $request->input('sessao'),
                'description' => $request->input('description'),
                'parent' => $request->input('parent'),
                'type_Response' => $request->input('type_response'),
                'created_at' => date('Y-m-d H:i')
            ];

        AnamineseQuestion::create($data);
        return redirect('admin/anaminese-questions');
    }
    public function update(Request $request)
    {
        $question_id = $request->input('anaminese_questions_id');

        $data = [
            'anaminese_sessions_id' => $request->input('sessao'),
            'description' => $request->input('description'),
            'parent' => $request->input('parent'),
            'type_Response' => $request->input('type_response'),
            'created_at' => date('Y-m-d H:i')
        ];

        AnamineseQuestion::QuestionUpdate($question_id,$data);
        return redirect('admin/anaminese-questions');


    }
}
