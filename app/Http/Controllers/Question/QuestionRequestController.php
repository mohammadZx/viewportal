<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionRequestController extends Controller
{
    public function create($id){
        dd('show question form');
    }   
    public function store(Request $request, $id){
        dd('store and update request');
    }
}
