<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Request as Req;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commets = Comment::orderBy('id','DESC')->paginate(PRE_PAGE);
        return view('customer.comment.index', ['comments'=>$commets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    

    public function reference(){
    
        $requests = Req::select('requests.*')
        ->leftJoin('transactions', function($q){
            $q->on('transactions.id', 'requests.transaction_id');
        })
        ->leftJoin('option_types', function($q){
            $q->on('transactions.option_type_id', 'option_types.id');
        })
        ->where('requests.status', 'reference')->orderBy('option_types.order_no','ASC')->paginate(PRE_PAGE);
        return view('customer.request.index', [
            'requests' => $requests
        ]);
    }
    public function disapproveforrequest($id){

    }

    public function approveforrequest($id){

    }
}
