<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use App\User;
class UserWalletController extends Controller
{
    public function index(){
        $transactions = Transaction::where('name', 'WALLET')->orderBy('id','DESC')->paginate(PRE_PAGE);
        return view('admin.user.wallet', ['transactions' => $transactions]);
    }
    public function changeStatus(Request $request){
        $request->validate([
            'authority' => ['required']
        ]);
        $tr = Transaction::findOrFail($request->id);
        $tr->status = 1;
        $tr->authority_code = $request->authority;
        $tr->save();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'درخواست شما با موفقیت انجام شد'
        ]);
    }
}
