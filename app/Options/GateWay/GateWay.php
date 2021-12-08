<?php
namespace App\Options\GateWay;

class GateWay{
    public $gateWay;
    public $data;
    public function __construct($name = 'Zarinpal', $data)
    {
        $class = "\App\Options\GateWay\{GATE}";
        $class = str_replace('{GATE}',$name, $class);
        $this->data = $data;
        if(class_exists($class)){
            $this->gateWay = new $class($this->data);
        }else{
            $this->gateWay = new \App\Options\GateWay\Zarinpal($this->data);
        }
            
    }

    public function send(){
        return $this->gateWay->send();
    }

    public function verify(){
        return $this->gateWay->verify();
    }

}