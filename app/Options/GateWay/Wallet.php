<?php
namespace App\Options\GateWay;
use App\Options\GateWay\GateWayInterface;
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
        dd('wallet');
    }

    public function verify(){
       dd('verify wallet');
    }

}