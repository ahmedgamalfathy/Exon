<?php

namespace App\Http\Controllers\API\Auth;

use Exception;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
     public function FirstRegister(Request $request)
    {
        try {
            $validated= $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|unique:users,phone|digits:11',
                'email' => 'required|email|unique:users,email',
                'applier'=>["required",Rule::in(['مُعلم','طالب'])]
            ]);
            $data = User::create([
              "name"=>$validated['name'],
              "phone"=>$validated['phone'],
              "email"=>$validated['email'],
              "code"=>rand(1000,9999),
              'expired_at' => now()->addMinutes(5),
              "applier"=>$validated['applier']
            ]);

            return response()->json([
                "status"=>200,
                "data"=>$data
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json([
                "status"=>422,
                "msg"=>$errors
            ],422);
        }
    }
   //verifyPhoneCode
    public function SecondRegister($phone,Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'code' => 'required|exists:users,code'
              ]);
              if ($validator->fails()) {
                return response()->json([
                    "status"=>422,
                    "msg"=>$validator->errors(),
                ],422);
               }
               $user=User::where('phone',$phone)->first();
               if($user){
                if($user->code != $request->input('code')){
                    return response()->json([
                        "status"=>422,
                        "msg"=> $validator->errors(),
                    ],422);
                }
                if($user->expired_at < now()){
                    return response()->json([
                        "status"=>422,
                        "msg"=>'Time of code is expired ,please resend code again!',
                    ],422);
                    }
                    $user->update([
                        'code'=>null,
                        'expired_at'=>null
                    ]);
                    return response()->json([
                        "status"=>200,
                        "data"=>$user
                    ],200);
               }else{
                return response()->json([
                    "msg"=>'User Not Found' ],404);
              }
        } catch (\Throwable $th) {
            return response()->json([
                "msg"=>'internal server error..'
            ],500);
        }

    }
   //step 3
   public function ThirdRegister(Request $request,$phone)
   {
       try {
           $validated=$request->validate([
               "password"=>'required|confirmed|min:8',
               "stage_id"=>'required|string|exists:stages,id',
               "grade_id"=>'nullable|string|exists:grades,id',
               "mater" => 'nullable|array',
               "mater.*" => 'exists:materials,title',
               "photo"=>'nullable|array',
               "photo.*" => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,'
           ]);
        $user= User::where('phone',$phone)->first();
        if($user){
            $photos =[];
            if($request->hasFile('photo')){
                foreach ($request->file('photo') as $photo) {
                    $path=$photo->store('FileTeacher','image');
                    $photos[]=$path;
                    $validated['photo']=json_encode($photos);
                }
            }
            $validated['password']=Hash::make($validated['password']);
            $token = $user->createToken($user->phone,['*'],now()
            ->addMonth())->plainTextToken;
           $user->update($validated);
           $data= [
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email,
            "phone"=>$user->phone,
            "stage"=>$user->stage_id,
            "mater"=>$user->mater,
            "grade"=>$user->grade_id,
            "photo"=>is_null($user->photo) ? [] :array_map(function($photo){
                return asset('Exon/'.$photo);
            },json_decode($user->photo,true)),
            "token"=>$token,];
            return response()->json([
                "status"=>200,
                "data"=>$data
            ]);
        }else{
            return response()->json([
                "status"=>404,
                 "msg"=>"model not found"
            ]);
        }

       } catch (ValidationException $e) {
            return response()->json([
                "status"=>422,
                "msg"=>$e
            ]);
       }

   }
   public function resendCode($phone)
   {
       try{
           $user=User::where('phone',$phone)->first();
           if($user){
               $code=rand(1000,9999);
               $user->update([
               'code'=>$code,
               'expired_at'=>now()->addMinutes(5)
               ]);

               return response()->json([
                   "status"=>200,
                   "data" => $user
               ]);
           }else{
               return response()->json([
                   "status"=>404,
                   "msg"=>'User Not Found'
               ],404);
           }

           }catch(\Exception $ex){
               return response()->json([
                 "msg"=>'internal server error',
               ],500);
           }
   }

   public function login()
   {
       $data= Request()->validate([
           "phone"=>"required|numeric",
           "password"=>"required|min:8"
       ]);
    $user= User::where('phone',$data['phone'])->first();
    if(!$user){
        return response()->json([
            "status"=>422,
            'msg' => 'يوجد خطا  في الموبيل او الباسورد'], 422);
        }
    if($user && $user->applier === "مُعلم" && $user->is_approve === true ){
        if(!Auth::attempt(["phone"=>$data['phone'],"password"=>$data['password']])){
            return response()->json([
                "status"=>401,
                'msg' => 'Unauthorized'], 401);
            }
        }else{
        return response()->json([
            "status"=>403,
            'msg' => 'طلبك قيد المراجعة 😊'], 403);
        }

        $user =Auth::user();
        if(!$user){
            return response()->json([
                 "status"=>404,
                "msg"=>"UserNotFound"],404);
         }
        $user =User::findOrFail($user->id);
        $token =$user->createToken($user->phone,['*'],now()->addMonth())->plainTextToken;
        $data=
            [
                    "id"=>$user->id,
                    "name"=>$user->name,
                    "email"=>$user->email,
                    "phone"=>$user->phone,
                    "stage"=>$user->stage_id,
                    "mater"=>$user->mater,
                    "grade"=>$user->grade,
                    "photo"=>is_null($user->photo) ? null : asset('/images/'. $user->photo),
                    "token"=>$token,
            ];
        return response()->json([
            "status"=>200,
            "data"=>$data,
        ],200);
   }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "status"=>200,
                "msg"=>'user logged out Successfully',
            ],200 );
        } catch (\Exception $e) {
            return response()->json([
                "status"=>500,
                'msg'=>'internal serever Error,,'],500);
        }
    }
    public function resetPassword($phone,Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                    'code' => 'required|exists:users,code',
                    'password' => ['required','confirmed',Password::min(8)]
                ]);
            if ($validator->fails()) {
                return response()->json([
                     "msg"=> $validator->errors()],422);
            }
            $user=user::where('phone',$phone)->first();
            if($user){
                if($user->code !=$request->input('code')){
                    return response()->json([
                        "status"=>422,
                        "msg"=> 'code is wrong, write it again'],422);
                }
                if($user->expired_at < now()){
                    return response()->json([
                        "status"=>422,
                        "msg"=> 'Time of code is expired ,please resend code again!'],422);
                }
                if(Hash::check($request->input('password'),$user->password)){
                    return response()->json([
                        "status"=>404,
                        "msg"=> 'you can\'t use old password as new password'],404);
                }
                $user->update([
                    'password'=>bcrypt($request->input('password')),
                    'code'=>null,
                    'expired_at'=>null
                ]);
                $token=$user->createToken($user->phone)->plainTextToken;
                $data = [
                    'id'=>$user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    // 'photo' =>!$request->hasFile('photo')? null: BASEURLPHOTO . $user->photo,
                    'token' => $token,
                    'token_type'=>"bearer"
                ];
                 return response()->json([
                     "status"=>200,
                     "msg"=>'password changed successfully',
                     "data"=>$data
                 ],200);
            }else{
                return  response()->json([
                    "status"=>404,
                    "msg"=>'user Not Found',
                ],404);
            }

        }catch(\Exception $ex){
            response()->json([
                "msg"=>'internal server error..',
            ],500);
        }
    }
    public function homePage()
    {
            $user=Auth::user();
            if(!$user){
                return response()->json([
                    "status"=>401,
                    "data"=>"unauthorized"
                ]);
            }

           if($user->applier === "مُعلم")
           {
            $user=User::with('stage')->findOrFail($user->id);
           }else{
            $user=User::with('stage','grade')->findOrFail($user->id);
            $user->grade->materials;
           }

           if(!$user){
            return response()->json([
                "status"=>404,
                "msg"=>"model notfound"
            ]);
           }
           return response()->json([
               "status"=>200,
               "data"=>$user,
           ]);
    }


}
