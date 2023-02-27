<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    public function login(){
        $request = request()->all();
        $rules = [
            "email" => "required|max:255|email|exists:users,email",
            "password" => "required|max:255|min:6",
            "toc" => 'required|in:1'
        ];
        $messages = [
            "toc.required" => "Please accept the terms and conditions and privacy policy."
        ];
        $validator = Validator::make($request, $rules, $messages);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if(auth()->attempt(['email' => $request['email'], 'password' => $request['password']])){
            if(auth()->user()->is_active != 1){
                return response()->json(['status' => 'error', 'message' => 'Your account is inactive.'], 200);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully.',
                'route' => route('admin.dashboard')
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid email or password.'], 200);
    }

    public function logout(){
        auth()->guard()->logout();
        return redirect()->route('admin-login-view');
    }
}
