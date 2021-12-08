<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class QuestionRequestController extends Controller
{
    public function create($id){
        $tr = Transaction::find($id);
        return view('question.request', [
            'tr' => $tr
        ]);
    }   
    public function store(Request $request, $id){
        dd($request->all());
    }
}
