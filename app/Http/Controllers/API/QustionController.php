<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class QustionController extends Controller
{
    public function index()
    {
        $questions =Question::with('answers')->paginate();
        return response()->json([
            "status"=>200,
            "data"=>$questions,
        ]);
    }
    public function show($id)
    {
        try {
           $question= Question::findOrFail($id);
           return response()->json([
               "status"=>200,
              "data"=>$question
           ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status"=>200,
               "msg"=>'هذا السجل غير موجود'
            ]);
        }

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            "test_id"=>"required|exists:tests,id",
            "question_type"=>"required|string",
            "question_text"=>"required|string",
            "score"=>"required|numeric",
        ]);
        $question=Question::create($data);
        return response()->json([
            "status"=>200,
            "data"=>$question
        ]);
    }
    public function update(Request $request ,$id)
    {
        try {
            $data = $request->validate([
                "test_id"=>"required|exists:tests,id",
                "question_type"=>"required|string",
                "question_text"=>"required|string",
                "score"=>"required|numeric",
            ]);

            $question=Question::findOrFail($id);
            $question->update($data);
            return response()->json([
                "status"=>200,
                "data"=>$question
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                "status"=>404,
                "data"=>"هذا السجل غير موجود"
            ]);
         }

    }
    // public function update(Request $request ,$id)
    // {
    //     try {
    //         $validated = $request->validate([
    //             "test_id"=>"required|exists:tests,id",
    //             "question_type"=>"required|string",
    //             "question_text"=>"required|string",
    //             "score"=>"required|numeric",
    //         ]);
    //        $question= Question::findOrFail($id);
    //        $question->update($validated);
    //        return response()->json([
    //         "status"=>200,
    //         "data"=> $question
    //     ]);
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             "status"=>422,
    //             "errors"=> $e
    //         ]);
    //     } catch (ModelNotFoundException $e){
    //        return response()->json([
    //            "status"=>404,
    //            "msg"=>"هذا السجل غير موجود"
    //        ]);
    //     }


    // }
    public function destory($id)
    {
        try {
           $question= Question::findOrFail($id);
            $question->delete();
            return response()->json([
                "status"=>200,
                "msg"=>"تم الحذف بنجاح"
            ]);
        } catch (ModelNotFoundException $e) {
           return response()->json([
            "status"=>404,
            "msg"=>"هذا السجل غيرموجود"
           ]);
        }

    }

}
