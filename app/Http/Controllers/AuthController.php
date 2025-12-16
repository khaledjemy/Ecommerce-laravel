<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
    
        $user = User::create($data);
        return response()->json([
            'user' => $user,
        ]);
    }
    
  public function login(Request $request)
  {
    $data = $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|min:6',
    ]);
   
    $user = User::where('email',$data['email'])->first();
    if(!$user || !Hash::check($data['password'],$user->password))
    {
        return response([
          'msg'=>'invaid',
        ]);
    }
    $token = $user->createToken('auth_token')->plainTextToken;
    
    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
  }

  public function userprofile()
  {
    $userdata = auth()->user();

    return response()->json([
        'status'=>true,
        'message'=>'user login profile',
        'data'=>$userdata,
        'id'=>auth()->user()->id,
    ]);

  }


public function logout()
{
    auth()->user()->tokens()->delete();

    return response()->json([
        'status'=>true,
        'message'=>'user logout',
        'data'=>[],
        
    ]);

}

public function userResource()
{
  $userdata = new ResourceResponse(User::findOrfail(auth()->user()->id));

  return response()->json([
      'status'=>true,
      'message'=>'user login profile using api resource',
      'data'=>$userdata,
      'id'=>auth()->user()->id,
  ]);

}

 
public function userCollection()
{
  $userdata = new ResourceCollection(user::get());

  return response()->json([
      'status'=>true,
      'message'=>'user login profile using api collection',
      'data'=>$userdata,
      
  ]);

}
}
