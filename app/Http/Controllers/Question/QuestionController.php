<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use App\Http\Controllers\Coupon\CouponValidateController;
use App\Http\Controllers\Coupon\CalcCouponPrice;
use App\OptionVar;
use App\OptionType;
class QuestionController extends Controller
{
  
    public function create()
    {
        // send to view
        
        return view('question.send');
    }

    public function set(Request $req){
        // set transaction to session and got to gateway
    }

    public function check(Request $req){
        // chck payment was success or not
        // if success redirect to request question
        // make transaction
        // else back to create method and send message
    }

    public function setCoupon(Request $req){
        //check and set coupon by question transaction data
        $result = [
            'discount_price' => 0,
            'type' => 'success',
            'messages' => ['کد تخفیف با موفقیت ثبت شد']
        ];
        $couponValidator = new CouponValidateController($req->discountCode, $req);
        $validation = $couponValidator->exsit()->expriry()->usage()->validateRole()->check();
        
        if($validation === true){
            $type = OptionType::find($req->selectedType);
            $var = OptionVar::find($req->selectedVar);
            $price = $type->price + $var->price;

            $calculator = new CalcCouponPrice($req->discountCode, $price);
            $result['discount_price'] = $calculator->calc();
        }else{
            $result['messages'] = $validation;
            $result['type'] = 'danger';
        }
        return response()->json($result);
    }

    public function getOptions(){
        $options = Option::with(['vars', 'types'])->get();
        return response()->json($options);
    }


}
