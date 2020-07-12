<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
class LoadController extends Controller
{
    public function validateLogin(Request $request){
        return Validator::make($request->except('_token'),[
            'user_id' => 'required|exists:users,identification_number',
            'password' => 'required',
        ]);
    }

    public function login(Request $request){
        $validation = $this->validateLogin($request);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
        }else{
            if (Auth::guard('my_users')->attempt(['identification_number' => $request['user_id'],'password' => $request['password'], 'role' => '1'] , 1) ){
                return redirect()->route('admin_home');
            }else if(Auth::guard('my_users')->attempt(['identification_number' => $request['user_id'],'password' => $request['password'], 'role' => '6']  , 1) ){
                return redirect()->route('lecturer_home');
            }else if(Auth::guard('my_users')->attempt(['identification_number' => $request['user_id'],'password' => $request['password'], 'role' => '7']  , 1) ){
                return redirect()->route('student_home');
            }else{
                return redirect()->route('home')->withErrors(['password_error' => 'Password is incorrect'])->withInput();
            }
        }
    }

    public function logout(Request $request){
        Auth::guard('my_users')->logout();
        return redirect()->route('home')->with(['password_error'=> 'You have been logged out successfully']);
        }
}
