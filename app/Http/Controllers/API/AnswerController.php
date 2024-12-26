<?php

namespace App\Http\Controllers\API;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function question_answers($question)
    {
       $question=Question::findOrFail($question);
       $question->answers->pluck('answer_text ','is_correct ');
        return response()->json([
            "status"=>200,
            "data"=>$question
        ]);
    }
    public function store(Request $request, $question)
    {
     $validated= $request->validate([
         "answer_text"=>"required|string",
         "is_correct"=>"required|boolean"
     ]);
     $validated["question_id"]=$question;
     $question=Question::findOrFail($validated["question_id"]);
     if(!$question){
         return response()->json([
            "status"=>404,
            "msg"=>"هذا السؤال غير موجود"
         ]);
     }
      $answer=Answer::create($validated);
      return response()->json([
        "status"=>200,
        "data"=>$answer
      ]);

    }
    public function delete($id)
    {
    try {
        $answer =Answer::findOrFail($id);
        $answer->delete();
        return response()->json([
            "msg"=>"تم الحذف بنجاح"
        ]);
    } catch (ModelNotFoundException $th) {
        return response()->json([
            "msg"=>"هذا السجل غيرموجود"
        ]);
    }

    }
}
