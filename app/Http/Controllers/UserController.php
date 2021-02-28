<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
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

  public function updateUserProfile(Request $request){

    $user = auth()->user();
    $data = $request->only('first_name','last_name','full_address','bio','password');
    if($request->hasFile('profile_image')){
      if (Storage::disk('public')->exists($user->profile_image)) Storage::disk('public')->delete($user->profile_image);
      $data['profile_image'] = $request->file('profile_image')->store('profileImages');
    }
    User::find($user->id)->update($data);
    return new UserResource(User::find($user->id));

  }

  public function getUserProfile(){

    $user = auth()->user();
    return new UserResource($user);

  }

  public function deleteUserProfile(){

    $user = auth()->user();
    $user->delete();
    return response()->json(['data'=> ['message' => 'User deleted successfully.']]);

  }




}
