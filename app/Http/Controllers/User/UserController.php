<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Pipeline\Pipeline;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pipelines = app(Pipeline::class)
        ->send(User::query())
        ->through([
            new \App\QueryFilters\UserSearch(User::class),
        ])
        ->thenReturn();
        $users = $pipelines->orderBy('id', 'DESC')->paginate(PRE_PAGE);
        return view('admin.user.index', ['users' => $users]);
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'کاربر با موفقیت حذف شد'
        ]);
    }

    public function clearingWallet(Request $req, $id){
      
        $req->validate([
            'authority' => ['required']
        ]);

        $user = User::findOrFail($id);      
        $user->transactions()->create([
            'name' => strtoupper('wallet'),
            'price' => $user->wallet,
            'status' => 1,
            'autority_code' => $req->authority,
            'comment' => $req->has('comment') ? $req->comment : null
        ]);
        $user->wallet = 0;
        $user->save();
        return redirect()->back()->with('message',[
            'type' => 'success',
            'message' => 'کاربر تسویه شد. کیف پول ایشان خالی شد'
        ]);
    }
}
