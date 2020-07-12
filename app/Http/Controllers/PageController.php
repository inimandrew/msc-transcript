<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index(Request $request){

        if(Auth::guard('my_users')->check()){

            if(Auth::guard('my_users')->user()->role == '1'){
                return redirect()->route('admin_home');
            }else if(Auth::guard('my_users')->user()->role == '6'){
                return redirect()->route('lecturer_home');
            }else if(Auth::guard('my_users')->user()->role == '7'){
                return redirect()->route('student_home');
            }
        }
        $title = "Login";
        return view('login');
    }

    public function EditProfile(Request $request){
        $title = "Edit Profile ";
        return view('edit_profile',['title' => $title]);
    }


}
