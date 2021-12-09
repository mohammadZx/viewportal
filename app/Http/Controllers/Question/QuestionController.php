<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use App\Coupon;
use App\Http\Controllers\Coupon\CouponValidateController;
use App\Http\Controllers\Coupon\CalcCouponPrice;
use App\OptionVar;
use App\OptionType;
use App\Options\GateWay\GateWay;
use App\Transaction;

class QuestionController extends Controller
{
  
    public function create()
    {
        // send to view
        
        return view('question.send');
    }

    public function set(Request $req){

        // set transaction to session and got to gateway
        $couponValidator = new CouponValidateController($req->coupon, $req);
        $validation = $couponValidator->exsit()->expriry()->usage()->validateRole()->check();
        $type = OptionType::find($req->type);
        $var = OptionVar::find($req->var);
        $price =  $type->price + $var->price;
        if($validation === true){
            $calculator = new CalcCouponPrice($req->coupon,$price);
            $price -= $calculator->calc();
        }else{
            $req->request->add([
                'coupon' => 0
            ]);
        }
        
        $req->request->add([
            'price' => $price,
            'description' =>  $var->option->name.'-'. $var->name,
            'callback' => route('user.check_question'),
            'user' => auth()->user()->id
        ]);
        session()->put('shop', $req->all());
        $gate = new GateWay($req->gateway, $req->all());
        return $gate->send();

    }

    public function check(){
        if(!session()->has('shop')) return redirect()->route('user')->with('message', [
            'type' => 'warning',
            'message' => 'اشکال در پرداخت'
        ]);

        $req = session()->get('shop');
        $gate = new GateWay($req['gateway'], $req);
        $verify = $gate->verify();

        if($verify->status == 1){

            $coupon = Coupon::where('code',$req['coupon'])->first();
            $transaction = new Transaction();
            $transaction->name = 'CASE';
            $transaction->user_id = $req['user'];
            $transaction->option_var_id = $req['var'];
            $transaction->option_type_id = $req['type'];
            $transaction->price = $req['price'];
            $transaction->coupon = $coupon ? $req['coupon'] : null;
            $transaction->status = 1;
            $transaction->authority_code = $verify->authority;
            $transaction->gate_way = $req['gateway'];
            $transaction->save();


            return redirect()->route('user.question_request', $transaction->id)->with('message' , [
                'type' => 'success',
                'message' => 'پرداخت شما موفیت آمیز بود. در این قسمت سوال خود را بپرسید.'
            ]);
        }
        return redirect()->route('user.send_question')->with('message' , [
            'type' => 'warning',
            'message' => 'پرداخت شما با موفقیت انجام نشد. در صورت کسری وجه بازگردانده می شود.'
        ]);
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
