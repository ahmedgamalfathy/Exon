<?php
use App\Http\Controllers\Dashboard\PolicyController;
use App\Http\Controllers\Dashboard\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\StageController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Dashboard\MaterialController;
use App\Http\Controllers\Dashboard\RegisterController;
use App\Http\Controllers\Dashboard\UpdateProfileController;

Route::middleware('auth:admin')->group(function(){
    Route::get('/', function () { return view('welcome'); })->name('home');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::get('admins',[AdminController::class,'index'])->name('admins.index');
    Route::get('admins_create',[AdminController::class,'create'])->name('admins.create');
    Route::post('admins_store',[AdminController::class,'store'])->name('admins.store');
    Route::get('admins_edit/{admin}',[AdminController::class,'edit'])->name('admins.edit');
    Route::put('admins_update/{admin}',[AdminController::class,'update'])->name('admins.update');
    Route::post('admin/{id}/update',[UpdateProfileController::class,'update']);

    Route::post('/register',[AdminController::class,'store']);
    Route::get('/register_view',[RegisterController::class,'create']);
    //student
    Route::get('students',[StudentController::class,'index'])->name('students');
    //teacher
    Route::get('isApprove',[TeacherController::class,'is_approve'])->name('teacher.isApprove');
    Route::get('showIsApprove/{id}',[TeacherController::class,'showIsApprove'])->name('teacher.showIsApprove');
    Route::get('approved',[TeacherController::class,'approved'])->name('teacher.approved');
    Route::get('changeStatus/{id}',[TeacherController::class,'changeStatus'])->name('teacher.changeStatus');
    //stages
    Route::get('stages',[StageController::class,'index'])->name('stage.index');
    Route::get('stages/create',[StageController::class,'create'])->name('stage.create');
    Route::post('stages/store',[StageController::class,'store'])->name('stage.store');
    Route::get('stages/edit/{id}',[StageController::class,'edit'])->name('stage.edit');
    Route::put('stages/update/{id}',[StageController::class,'update'])->name('stage.update');
    Route::delete('stages/delete/{id}',[StageController::class,'destroy'])->name('stage.delete');
    //grades
    Route::get('grades',[GradeController::class,'index'])->name('grade.index');
    Route::get('grades/create',[GradeController::class,'create'])->name('grade.create');
    Route::post('grades/store',[GradeController::class,'store'])->name('grade.store');
    Route::get('grades/edit/{id}',[GradeController::class,'edit'])->name('grade.edit');
    Route::put('grades/update/{id}',[GradeController::class,'update'])->name('grade.update');
    Route::delete('grades/delete/{id}',[GradeController::class,'destroy'])->name('grade.delete');
    //material
    Route::get('material',[MaterialController::class,'index'])->name('material.index');
    Route::get('material/create',[MaterialController::class,'create'])->name('material.create');
    Route::post('material/store',[MaterialController::class,'store'])->name('material.store');
    Route::get('material/edit/{id}',[MaterialController::class,'edit'])->name('material.edit');
    Route::put('material/update/{id}',[MaterialController::class,'update'])->name('material.update');
    Route::delete('material/delete/{id}',[MaterialController::class,'destroy'])->name('material.delete');
    //payments
    Route::get('payment/changecompleted/{id}',[PaymentController::class,'changecompleted'])->name('payment.changecompleted');
    Route::get('payment/changefaild/{id}',[PaymentController::class,'changefaild'])->name('payment.changefaild');
    Route::get('payment/pending',[PaymentController::class,'pending'])->name('payment.pending');
    Route::get('payment/completed',[PaymentController::class,'completed'])->name('payment.completed');
    Route::get('payment/faild',[PaymentController::class,'faild'])->name('payment.faild');
    //contacts
    Route::get('contact',[ContactController::class,'index'])->name('contacts');
    //policys
    Route::get('policys',[PolicyController::class,'index'])->name('policys');
    Route::get('policys/create',[PolicyController::class,'create'])->name('policys.create');
    Route::post('policys/store',[PolicyController::class,'store'])->name('policys.store');
    Route::get('policys/edit/{id}',[PolicyController::class,'edit'])->name('policys.edit');
    Route::put('policys/update/{id}',[PolicyController::class,'update'])->name('policys.update');
    Route::delete('policys/delete/{id}',[PolicyController::class,'delete'])->name('policys.delete');

});
// Route::get('/', function () { return view('Dashboard.auth.Login'); })->name('home');
Route::middleware('guest:admin')->group(function(){
    Route::post('/login',[LoginController::class,'login']);
    Route::get('/login',[LoginController::class,'create'])->name('login');
});
