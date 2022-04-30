<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserResource;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, __('User signed in'));
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>__('Unauthorised')]);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'img' => 'nullable|image|max:4096'
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        if ($request->img) {
            $filename = date('YmdHis').$request->img->getClientOriginalName();
            $request->img->storeAs('public/upload/profile/', $filename);
            $input['img'] = 'storage/upload/profile/' . $filename;
        }
        $user = User::create($input);
        $user->assignRole('Dev');
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, __('User created successfully.'));
    }

    public function profile()
    {
        if (auth()->guest()) {
            return $this->sendError('Unauthorised.', ['error'=>__('Unauthorised')]);
        }
        return new UserResource(User::find(Auth::user()->id));
    }

    public function logout()
    {
        if (auth()->guest()) {
            return $this->sendError('Unauthorised.', ['error'=>__('Unauthorised')]);
        }
        Auth::user()->tokens()->delete();
        return $this->sendResponse([], __('User successfully signed out'));
    }
}
