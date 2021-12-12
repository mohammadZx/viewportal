<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;
use App\Transaction;
class CouponValidateController extends Controller
{
    public $coupon;
    public $data;
    public $messages = [];

    public function __construct($coupon, $data)
    {
        $this->coupon = $coupon;
        $this->data = $data;
    }

    public function exsit(){
        $coupon = Coupon::where('code', $this->coupon)->first();
        if($coupon){
            $this->coupon = $coupon;
        }else{
            $this->coupon = (object) [
                'id' => 0,
                'expire_at' => null,
                'coupon_use' => 0,
                'user_coupon_use' => 0,
                'role' => ''
            ];

            $this->messages[] = 'کوپن تخفیف موجود نمی باشد';
        }
        return $this;

    }

    public function expriry(){
        if($this->coupon->expire_at && $this->coupon->expire_at <= Carbon::now()){
            $this->messages[] = 'تاریخ مصرف کوپون گذشته است';
        }
        return $this;
    }

    public function usage(){
        if($this->coupon->coupon_use == 1){
            $this->messages[] = 'تعداد استفاده از کوپون به پایان رسیده است';
        }
        return $this;
    }

    public function userUsage(){
        
        $userCouponUse = Transaction::
        // where('user_id', $this->data->user()->id)->
        where('coupon_id', $this->coupon->id)->count();
        if(
            $this->coupon->user_coupon_use == $userCouponUse
            &&
            $this->coupon->user_coupon_use != 0
            ){
                $this->messages[] = 'تعداد استفاده از کوپون برای شما به پایان رسیده است';
        }

        return $this;
    }

    public function validateRole(){
        
        if($this->coupon->role != null && json_decode($this->coupon->role, true)){
            $roles = json_decode($this->coupon->role, true);
            $exsitRoleStatus = false;
            foreach($roles['options'] as $role){ 
                if($role == $this->data->selectedOption) $exsitRoleStatus = true;
            }
            if(!$exsitRoleStatus) $this->messages[] = 'کوپون برای این دسته به کار نمی رود';
        }
        return $this;
    }

    public function check(){
        if(count($this->messages) == 0) return true;
        return $this->messages;
    }
}
