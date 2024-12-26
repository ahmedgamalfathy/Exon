<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TestshowResource;
use App\Models\Test;
use App\Models\User;
use App\Models\Testresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestController extends Controller
{
    public function index()
    {
       $tests=Test::select('id','title','test_Type','price','photo','des','created_at')->paginate();
       return response()->json([
            "status"=>200,
            "data"=> TestshowResource::collection($tests),
            'meta' => [
                'current_page' => $tests->currentPage(),
                'last_page' => $tests->lastPage(),
                'per_page' => $tests->perPage(),
                'total' => $tests->total(),
            ],
       ]);
    }
    public function show($id)
    {
        try {
            $test =Test::select('id','title','test_Type','price','photo','des','created_at')->findOrFail($id);
            return response()->json([
                "status"=>200,
                "data"=>new TestshowResource($test)
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                "status"=>404,
                "data"=>$th
            ]);
        }

    }
    public function getQuestions($id)
    {
        $test=Test::with('questions.answers')->findOrFail($id);
        return response()->json([
            "status"=>200,
            "data"=>$test
        ]);
    }
    public function store(Request $request)
    {
        Gate::authorize('create',Test::class);
    //title , des, teacher_id, user_id, stage_id, grade_id, material_id
    //photo, pdf ,start_time , end_time , test_type, price
   $validated= $request->validate([
        'title' => 'required|string',
        'des' => 'nullable|string',
        'stage_id' => 'required|exists:stages,id',
        'grade_id' => 'required|exists:grades,id',
        'material_id' => 'required|exists:materials,id',
        'photo' => 'required|image|mimes:jpg,png,webp',
        'pdf' => 'nullable|mimes:jpg,png,webp,pdf,docx',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'test_Type' => 'required|in:اون لاين,ملف pdf',
        'price' => 'required|numeric',
    ]);
    $validated['teacher_id']=auth()->user()->id;
    $validated['photo']=$request->file('photo')->store('tests','image');
    if($request->hasFile('pdf')){
         $validated['pdf']=$request->file('pdf')->store('tests','image');
     }
    $test=Test::create($validated);
    return response()->json([
        "status"=>200,
        "data"=> new TestResource($test),
    ]);
    }
    public function update(Request $request ,$id)
    {
    $test =Test::findOrFail($id);
    $response= Gate::inspect('update',$test);
    if($response->allowed()){
            $validated= $request->validate([
            'title' => 'required|string',
            'des' => 'nullable|string',
            'stage_id' => 'required|exists:stages,id',
            'grade_id' => 'required|exists:grades,id',
            'material_id' => 'required|exists:materials,id',
            'photo' => 'required|image|mimes:jpg,png,webp',
            'pdf' => 'nullable|mimes:jpg,png,webp,pdf,docx',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'test_Type' => 'required|in:اون لاين,ملف pdf',
            'price' => 'required|numeric',
            ]);
            $validated['teacher_id']=Auth::user()->id;
            if(!$test){
            return response()->json([
                "status"=>404,
                "data"=>"model not found"
            ],404);
            }
            if( $request->hasFile('photo')){
            if($test->photo){
            Storage::disk('image')->delete($test->photo);
            $validated['photo']=$request->file('photo')->store('tests','image');
            }
            }
            if( $request->hasFile('pdf')){
            if($test->pdf){
            Storage::disk('image')->delete($test->pdf);
            $validated['pdf']=$request->file('pdf')->store('tests','image');
            }
            }
            $test->update($validated);
            return response()->json([
            "status"=>200,
            "data"=> new TestResource($test),
            ]);
    }else{
        return response()->json([
            "status"=>403,
            'msg' => 'ليس لديك صلاحية',
        ], 403);
    }//close if
    }
    public function submitAnswers(Request $request, $id)
    {
       $response= Gate::inspect('answertest');
        if($response->allowed())
        {
        $request->validate([
            'answers' => 'required|array',
        ]);
        $test = Test::findOrFail($id);
       $user = Auth::user()->id;
       $user = User::findOrFail($user);
       if(!$user){
        return response()->json([
            "status"=>404,
            "msg"=>"هذا السجل غير موجود"
        ]);
       }
       $score = 0;
        foreach ($request->answers as $questionId => $answerId) {

            $question = DB::table('questions')->where('id', $questionId)->first();
            $isCorrect = DB::table('answers')
                        ->where('id', $answerId)
                        ->where('question_id', $questionId)
                        ->where('is_correct', 1)
                        ->exists();
            if ($isCorrect) {
                $score += $question->score;
            }

        }
        // حفظ النتيجة في جدول testresults
        Testresult::create([
            'test_id'=>$id,
            'user_id' =>$user->id,
            'teacher_id' => $test->teacher_id,
            'score' => $score,
        ]);

        return response()->json([
            'message' => 'Answers submitted successfully.',
            'score' => $score,
        ], 201);
    }else{
        return response()->json([
            'msg' => 'ليس لديك صلاحية',
            'status' => 403,
        ], 403);
    }
    }

    public function destroy($id)
    {
        try {
        $test =Test::findOrFail($id);
        $response = Gate::inspect('delete',$test);
            if ($response->allowed()) {
                    $test->delete();
                    return response()->json([
                        "status"=>200,
                         "msg"=>"تم الحذف بنجاح"
                    ]);
            } else {
                    return response()->json([
                        "status"=>403,
                    "msg"=>"ليس لديك صلاحية"
                    ],403);
            }

        } catch (ModelNotFoundException $th) {
            return response()->json([
                "status"=>404,
               "msg"=>"هذا السجل غير موجود"
            ],404);
        }

    }
}
