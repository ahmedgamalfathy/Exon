<?php
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\PolicyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\StageController;
use App\Http\Controllers\API\QustionController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\Auth\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('mobile')->group(function(){
    Route::controller(AuthController::class)->group(function(){
       Route::post('/FirstRegister','FirstRegister')->middleware('return422');
       Route::post('/SecondRegister/{phone}','SecondRegister');
       Route::post('/ThirdRegister/{phone}','ThirdRegister');
       Route::post('/resendCode/{phone}','resendCode');
       Route::post('/login','login');
       Route::post('/homepage','homepage')->middleware('auth:sanctum');
       Route::post('/logout','logout')->middleware('auth:sanctum');
       Route::post('/resetPassword/{phone}','resetPassword')->middleware('auth:sanctum');
    });
    Route::controller(GradeController::class)->group(function(){
        Route::get('grades','index');
    });
    Route::controller(StageController::class)->group(function(){
        Route::get('stages','index');
    });
    Route::controller(MaterialController::class)->group(function(){
        Route::get('materials','index');
    });
    Route::controller(TestController::class)->group(function(){
        Route::get('/tests','index');
        Route::get('/tests/{id}','show');
        Route::post('/tests/{id}/update','update')->middleware('auth:sanctum');//create_test
        Route::post('/tests','store')->middleware('auth:sanctum');//create_test
        Route::get('/tests/{id}/getQuestionsTest','getQuestions');
        Route::post('/tests/{id}/submit','submitAnswers')->middleware('auth:sanctum');
        Route::delete('/tests/{id}/delete','destroy')->middleware('auth:sanctum');

    });
    Route::controller(QustionController::class)->group(function(){
        Route::get('questions','index');
        Route::post('question_store','store');
        Route::get('question_show/{id}','show');
        Route::post('question_update/{id}','update');
        Route::delete('question_delete/{id}','destory');
    });
    Route::controller(AnswerController::class)->group(function(){
        Route::get('questions/{question}/answers','question_answers');
        Route::post('questions/{question}','store');
        Route::delete('questions/{question}/delete','delete');
    });
    Route::controller(ContactController::class)->group(function(){
        Route::get('contacts','index');
        Route::post('contacts','store')->middleware('auth:sanctum');
        Route::delete('delete_contact/{id}','delete')->middleware('auth:sanctum');
    });
    Route::controller(PolicyController::class)->group(function(){
        Route::get('policys','index');
        Route::post('policys','store');
        Route::delete('delete_policy/{id}','delete');
    });
});


