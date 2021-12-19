<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Options\GateWay\GateWay;
use App\Transaction;
class UserWalletController extends Controller
{
    public function index(){
        $transactions = Transaction::where('user_id', auth()->user()->id)->where(function($q){
            $q->where('name', 'WALLET')->orWhere('name','WALLET_CHARGE');
        })->get();
        return view('wallet.index', [
            'transactions' => $transactions
        ]);
    }
    public function charge(Request $req){
        $req->validate([
            'price' => ['required']
        ]);

        if(!filter_var($req->price, FILTER_VALIDATE_INT)){
            return redirect()->back()->with('message', [
                'type' => 'warning',
                'message' => 'لطفا یک مقدار معبتر وارد نمایید'
            ]);
        }
        session()->put('wallet_charge', $req->all());
        $req->request->add(
            [
                'description' => 'شارژ کیف پول',
                'callback' => route('user.verify')
            ]
        );
        $gate = new GateWay('zarinpal', $req->all());
        return $gate->send();
    }
    public function verify(){
        if(!session()->has('wallet_charge')) return redirect()->route('user')->with('message', [
            'type' => 'warning',
            'message' => 'اشکال در پرداخت'
        ]);

        $req = session()->get('wallet_charge');
        $gate = new GateWay('zarinpal', $req);
        $verify = $gate->verify();
        if($verify->status == 1){

            // set transaciton
            auth()->user()->transactions()->create([
                'name' => 'WALLET_CHARGE',
                'price' => $req['price'],
                'status' => 1,
                'authority_code' => $verify->authority,
                'gate_way' => 'zarinpal'
            ]);
        
            $this->set($req['price']);
            return redirect()->route('user.wallet')->with('message' , [
                'type' => 'success',
                'message' => 'کیف پول شما با موفقیت شارژ شد'
            ]);
        }
        return redirect()->route('user.wallet')->with('message' , [
            'type' => 'warning',
            'message' => 'پرداخت شما با موفقیت انجام نشد. در صورت کسری وجه بازگردانده می شود.'
        ]);
    }
    public function set($price, $user = null){
        $user = $user ? $user : auth()->user();
        $user->wallet += $price;
        $user->save();
        return;
    }
    public function liquidation(Request $request){

        if(auth()->user()->wallet <= 10000)  return redirect()->route('user.wallet')->with('message' , [
            'type' => 'warning',
            'message' => 'مبلغ موجود در کیف پول شما کمتر از 10 هزار تومان برای برداشت می باشد.'
        ]);

        auth()->user()->transactions()->create([
            'name' => 'WALLET',
            'price' => auth()->user()->wallet,
            'status' => 0,
            'gate_way' => 'wallet'
        ]);
        
        $user = auth()->user();
        $user->wallet = 0;
        $user->save();

        return redirect()->route('user.wallet')->with('message' , [
            'type' => 'success',
            'message' => 'درخواست شما با موفقیت انجام شد. و در اولین فرصت مبلغ مورد نظر به حساب شما واریز خواهد شد.'
        ]);

    }
}
