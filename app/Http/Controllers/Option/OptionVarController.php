<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use App\OptionVar;

class OptionVarController extends Controller
{
    public function index($optionId){
        $option = Option::findOrFail($optionId);
        return response()->json($option->vars);
    }


    public function store(Request $req){
        $var = new OptionVar();
        $var->option_id = $req->option;
        $var->name = $req->name;
        $var->content = $req->content;
        $var->price = $req->price;
        $var->site_commission = $req->site_commission;
        $var->commission_type = $req->commission_type;
        $var->reference = $req->reference;
        $var->save();
        return response()->json($var);
    }

    public function destrory($id){
        $var = OptionVar::findOrFail($id);
        $var->delete();
        return;
    }
}
