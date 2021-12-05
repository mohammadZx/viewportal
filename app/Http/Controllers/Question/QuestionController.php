<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
  
    public function create()
    {
        // send to view
    }

    public function set(Request $request){
        // set transaction to session and got to gateway
    }

    public function check(Request $request){
        // chck payment was success or not
        // if success redirect to request question
        // make transaction
        // else back to create method and send message
    }

    public function setCoupon(Request $req){
        //check and set coupon by question transaction data
    }


}
