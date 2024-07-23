<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //loginPage function
    public function loginPage(){
        return view('auth.login');
    }

     //registerPage function
    public function registerPage(){
        return view('auth.register');
    }

    //Auth admin or user
    public function dashboard(){
        User::where('id',Auth::user()->id)->update(['active'=>1]);
        if(Auth::user()->role=='admin'){

            return redirect()->route('admin#dashboard');

        }else if(Auth::user()->role=='user'){

            return redirect()->route('user#myDashboard');

        }

    }

    //change password
    public function changePassword(Request $req){
        $current_password=User::where('id',$req->user_id)->first()->password;
        if (Hash::check($req->current_password, $current_password)) {
            if ($req->new_password===$req->renew_password) {
                User::where('id',$req->user_id)->update(['password'=>Hash::make($req->new_password)]);
                return back()->with(['success'=>"Password change successful."]);
            }else{
                return back()->with(['danger'=>"New password and renew password must be same."]);
            }
        }else{
            return back()->with(['danger'=>"Wrong current password. Please try agqin"]);
        }
    }

    public function notActive(){
        User::where('id',Auth::user()->id)->update(['active'=>0]);
        return response()->json([
            'status'=>'successful'
        ], 200);
    }
}
