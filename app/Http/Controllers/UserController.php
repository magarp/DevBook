<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
{

  public function register(CreateUserRequest $request){

    $data = $request->only('first_name','last_name','dob','national_insurance_number','full_address','bio','email','password');
    if($request->hasFile('profile_image')){
      $data['profile_image'] = $request->file('profile_image')->store('profileImages');
    }
    $user = User::create($data);
    $access_token = $user->createToken('Customer')->accessToken;
    return response()->json(['data'=> ['access_token' => $access_token]]);

  }

}
