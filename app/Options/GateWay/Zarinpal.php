<?php
namespace App\Options\GateWay;
use App\Options\GateWay\GateWayInterface;
use Illuminate\Support\Facades\Redirect;
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
        $data = array('MerchantID' => '0e01acea-45ba-11e9-b737-000c29344814',
        'Amount' => $this->data['price'],
        'CallbackURL' => $this->data['callback'],
        'Description' => $this->data['description']);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
       ));
       $result = curl_exec($ch);
       $err = curl_error($ch);
       $result = json_decode($result, true);
       curl_close($ch);
       if ($err) {
        return  $err;
       } else {
        if ($result["Status"] == 100) {
        return Redirect::to('https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]);
        } else {
        return $result["Status"];
        }
       }
    }

    public function verify(){
        $Authority = $_GET['Authority'];
        $data = array('MerchantID' => '0e01acea-45ba-11e9-b737-000c29344814', 'Authority' => $Authority, 'Amount' => $this->data['price']);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        $dataShop['status'] = 0;
        $dataShop['authority'] = 0;      
        if ($result['Status'] == 100) {
        $dataShop['status'] = 1;
        $dataShop['authority'] = $result['RefID'];
        }
        return (object) $dataShop;
    }

}