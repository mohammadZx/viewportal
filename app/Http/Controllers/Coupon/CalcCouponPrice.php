<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;


class CalcCouponPrice extends Controller
{
    public $coupon;
    public $price;

    public function __construct($coupon, $price)
    {
        $this->coupon = Coupon::where('code', $coupon)->first();
        $this->price = $price;
    }

    public function calc(){
        if($this->coupon->discount_type == 'static'){
             return $this->coupon->discount;
        }elseif($this->coupon->discount_type == 'percent'){
            return (($this->coupon->discount / 100) * $this->price);
        }
        return 0;

    }

}
