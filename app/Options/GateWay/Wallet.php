<?php
namespace App\Options\GateWay;
use App\Options\GateWay\GateWayInterface;
use App\User;
use Illuminate\Support\Facades\Redirect;

class Wallet implements GateWayInterface{
    public $data;
    public $info = [
        'name' => 'wallet',
        'f_name' => 'کیف پول',
    ];
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send(){
        $user = User::find($this->data['user']);
        if(!$user) return redirect()->back()->with('message', [
            'type' => 'warning',
            'message' => 'درخواست نامعتبر'
        ]);
        if($user->wallet < $this->data['price']) return redirect()->back()->with('message', [
            'type' => 'warning',
            'message' => 'درخواست نامعتبر'
        ]);
        return Redirect::to($this->data['callback']);
    }

    public function verify(){
        $user = User::find($this->data['user']);
        $user->wallet = $user->wallet - $this->data['price'];
        $user->save();
        return (object) [
            'status' => 1,
            'authority' => 999
        ];
    }

}