<?php
namespace App\Options\GateWay;
use App\Options\GateWay\GateWayInterface;
class Zarinpal implements GateWayInterface{
    public $data;
    public $info = [
        'name' => 'zarinpal',
        'f_name' => 'زرین پال',
    ];
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send(){
    
    }

    public function verify(){
       
    }

}