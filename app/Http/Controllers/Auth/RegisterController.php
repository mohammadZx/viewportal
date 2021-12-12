<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Options\Uploader;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'phone' => ['required', 'size:11', 'unique:users'],
        ];
        
        if(isset($data['type']) && $data['type'] == 'expert'){
            $validator['type'] = ['required'];
            $validator['shaba'] = ['required', 'max:255', 'min:22', 'max:26'];
            $validator['cartmeli'] = ['required', 'file','max:300'];
            $validator['nezampezeshki'] = ['required', 'file', 'max:300'];
            $validator['nezampezeshkit'] = ['required', 'file' ,'max:300'];
    
        }
        return Validator::make($data, $validator);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['type'] . "_one",
            'password' => Hash::make($data['password']),
        ]);
        
        if($data['type'] == 'expert'){
            $cartMeli = Uploader::add($data['cartmeli']);
            $nezampezeshki = Uploader::add($data['nezampezeshki']);
            $nezampezeshkit = Uploader::add($data['nezampezeshkit']);

            $user->setMeta('shaba', $data['shaba']);
            $user->setMeta('status', 'disable');
            $user->setMeta('cartmeli', $cartMeli->id);
            $user->setMeta('nezame_dampezeshki', $nezampezeshki->id);
            $user->setMeta('nezame_dampezeshki_t', $nezampezeshkit->id);
        }
        return $user;
    }
}
