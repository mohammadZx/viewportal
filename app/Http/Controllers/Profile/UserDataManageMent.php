<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Options\Uploader;
use App\User;
class UserDataManageMent extends Controller
{
    public $allowsMeta = [];

    public function index($userid = null){
        // show edit form
        $user = auth()->user();

        // admin change other user data
        if($userid ){
            $user = User::findOrFail($userid);
        }

        return view('auth.edit', [
            'user' => $user,
            'userid' => $userid
        ]);
    }
    public function update(Request $req, $userid = null){

        $user = auth()->user();
        
        // admin change other user data
        if($userid ){
            $user = User::findOrFail($userid);
        }

        $validator = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],
            'phone' => ['required', 'size:11', Rule::unique('users')->ignore($user->id),],
        ];
        
        if(isset($data['type']) && $data['type'] == 'expert'){
            $validator['type'] = ['required'];
            $validator['shaba'] = ['required', 'max:255', 'min:22', 'max:26'];
            $validator['cartmeli'] = ['file','max:300'];
            $validator['nezampezeshki'] = ['file', 'max:300'];
            $validator['nezampezeshkit'] = ['file' ,'max:300'];
    
        }
     
        $validation = Validator::make($req->all(), $validator);
        $validation->validate();

        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->role = 'customer';
        if($req->type == 'customer') $user->save();
        $user->role = 'expert_one';
        $user->save();

        $user->setMeta('shaba', $req->shaba,  0 , true);

        if($req->cartmeli){
            $cartMeli = Uploader::add($req->cartmeli);
            $user->setMeta('cartmeli', $cartMeli->id,  0 , true);
        }
       if($req->nezampezeshki){
            $nezampezeshki = Uploader::add($req->nezampezeshki);
            $user->setMeta('nezame_dampezeshki', $nezampezeshki->id,  0 , true);
        }
        if($req->nezampezeshkit){
            $nezampezeshkit = Uploader::add($req->nezampezeshkit);
            $user->setMeta('nezame_dampezeshki_t', $nezampezeshkit->id, 0 , true);
        }
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'تغییرات شما با موفقیت ثبت شد'
        ]);
    }
}
