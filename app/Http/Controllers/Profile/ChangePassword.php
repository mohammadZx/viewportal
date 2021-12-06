<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
class ChangePassword extends Controller
{
    public function index($userid = null){
        // form to change password
        return view('auth.change-password', [
            'userid' => $userid
        ]);
    }
    public function update(Request $req, $userid = null){
        // change password
        $user = auth()->user();
        $validator = [
            'old_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6',]
        ];

        // admin change other user password
        if($userid){
            $user = User::findOrFail($userid);
            unset($validator['old_password']);
        }

        
        $validation = Validator::make($req->all(), $validator);
        $validation->validate();
    
    
        if(!$userid){
            if(!Hash::check( $req->old_password ,$user->password)){
                return redirect()->back()->with('message', [
                    'type' => 'danger',
                    'message' => 'رمز عبور فعلی مطابقت ندارد'
                ]);
            }
        }
        
        $user->password = Hash::make($req->new_password);
        $user->save();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'رمز عبور شما با موفقیت تغییر کرد'
        ]);
    }
}
