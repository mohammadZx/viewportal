<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request as Req;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allTransactions = auth()->user()->transactions()->count();
        $faildTransactions = auth()->user()->transactions()->where('status',0)->count();
        $requests = Req::whereHas('transactions' , function($q){
            $q->where('user_id', auth()->user()->id);
        })->count();
        return view('home', [
            'allTransactions' => $allTransactions,
            'faildTransactions' => $faildTransactions,
            'requests' => $requests
        ]);
    }
}
