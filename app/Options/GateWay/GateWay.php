<?php
namespace App\Options\GateWay;
class GateWay{
    public $gateWay;
    public $data;
    public function __construct($name, $data)
    {
        $class = "\App\Options\GateWay\$name";
        $this->data = $data;
        $this->gateWay = new $class($this->data);
    }

    public function send(){
        return $this->gateWay->send();
    }

    public function verify(){
        return $this->gateWay->verify();
    }

}