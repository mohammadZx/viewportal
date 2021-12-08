<?php
namespace App\Options\GateWay;
use Illuminate\Support\Facades\Redirect;
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
        if($this->data['price'] == 0){
            return Redirect::to($this->data['callback']);
        }
        return $this->gateWay->send();
    }

    public function verify(){
        if($this->data['price'] == 0){
            return (object) [
                'status' => 1,
                'authority' => 999
            ];
        }
        return $this->gateWay->verify();
    }

}