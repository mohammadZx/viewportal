<?php

namespace App\Http\Controllers\Coupon;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','DESC')->paginate(PRE_PAGE);
        return view('admin.coupon.index', [
            'coupons' => $coupons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = Option::all();
        return view('admin.coupon.add', ['options' => $options]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = [
            'code' => ['required', 'max:255'],
            'content' => ['has','max:255'],
            'discount' => ['has'],
            'type' => ['has'],
            'expire_at' => ['has'],
            'coupon_use' => ['has'],
            'role' => ['has'],
        ];
        $validation = Validator::make($request->all(), $roles);
        $validation->validate();
        $coupon = new Coupon();
    
        $coupon->code = $request->code;
        $coupon->content = $request->content;
        $coupon->discount = $request->discount;
        $coupon->discount_type = $request->type;
        $coupon->expire_at = $request->expire_at ? explode(' ', toGregorian($request->expire_at))[0] : 0;
        $coupon->coupon_use = $request->coupon_use ? $request->coupon_use : 0;
        if($request->role){
            $coupon->role = json_encode(['options'=> $request->role]);
        }else{
            $coupon->role = '{}';
        }
        $coupon->save();
        return redirect()->route('coupon.edit', $coupon->id)->with('message', [
            'type' => 'success',
            'message' => 'کد تخفیف شما با موفقیت ثبت شد'
        ]);
        
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
        $options = Option::all();
        $coupon = Coupon::findOrFail($id);
        if($coupon->expire_at) $coupon->expire_at = explode(' ', toJalali($coupon->expire_at))[0];
        return view('admin.coupon.edit', ['options' => $options, 'coupon' => $coupon]);
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
        $roles = [
            'code' => ['required', 'max:255'],
            'content' => ['has','max:255'],
            'discount' => ['has'],
            'type' => ['has'],
            'expire_at' => ['has'],
            'coupon_use' => ['has'],
            'role' => ['has'],
        ];
        $validation = Validator::make($request->all(), $roles);
        $validation->validate();
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->content = $request->content;
        $coupon->discount = $request->discount;
        $coupon->discount_type = $request->type;
        $coupon->expire_at = $request->expire_at ? explode(' ', toGregorian($request->expire_at))[0] : 0;
        $coupon->coupon_use = $request->coupon_use ? $request->coupon_use : 0;
        if($request->role){
            $coupon->role = json_encode(['options'=> $request->role]);
        }else{
            $coupon->role = '{}';
        }
        $coupon->save();
        return redirect()->route('coupon.edit', $coupon->id)->with('message', [
            'type' => 'success',
            'message' => 'کد تخفیف شما با موفقیت ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'کد تخفیف با موفقیت حذف شد'
        ]);
    }
}
