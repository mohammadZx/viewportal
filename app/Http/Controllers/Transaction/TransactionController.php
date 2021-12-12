<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)->where('name','CASE')->orderBy('id', 'DESC')->paginate(PRE_PAGE);
        if(request()->is('transaction') && (auth()->user()->can('admin') || auth()->user()->can('superadmin'))){
            $transactions = Transaction::where('name','CASE')->orderBy('id', 'DESC')->paginate(PRE_PAGE);
        }
        return view('customer.transaction.index', [
            'transactions' => $transactions
        ]);
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
        $tr = Transaction::findOrFail($id);
        $tr->request ? $tr->request->comments()->delete() : null;
        $tr->request()->delete();
        $tr->delete();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => "تراکنش با موفیت حذف شد"
        ]);

    }
}
