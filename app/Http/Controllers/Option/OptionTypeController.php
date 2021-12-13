<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use App\Option;
use App\OptionType;
use Illuminate\Http\Request;

class OptionTypeController extends Controller
{
    public function index($optionId){
        $option = Option::findOrFail($optionId);
        return response()->json($option->types);
    }

    public function store(Request $req){
        $type = new OptionType();
        $type->option_id = $req->option;
        $type->name = $req->name;
        $type->content = $req->content;
        $type->price = $req->price;
        $type->site_commission = $req->site_commission;
        $type->commission_type = $req->commission_type;
        $type->order_no = $req->order;
        $type->save();
        return response()->json($type);
    }

    public function destrory($id){
        $var = OptionType::findOrFail($id);
        $var->delete();
        return;
    }
}
