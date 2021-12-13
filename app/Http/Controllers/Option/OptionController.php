<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OptionController extends Controller
{
    public function index(){
        $options = Option::orderBy('id','DESC')->paginate(PRE_PAGE);
        return view('admin.option.index', [
            'options' => $options
        ]);
    }

    public function create(){
        return view('admin.option.add');        
    }

    public function store(Request $request){
        $roles = [
            'name' => ['required', 'max:255'],
            'content' => ['has','max:255'],
            'attachment_count' => ['required'],
        ];
        $validation = Validator::make($request->all(), $roles);
        $validation->validate();
        $option = new Option();
    
        $option->name = $request->name;
        $option->content = $request->content;
        $option->save();
        $option->roles()->create([
            'role_key' => 'attachment_count',
            'role_value' => $request->attachment_count
        ]);
        return redirect()->route('option.edit', $option->id)->with('message', [
            'type' => 'success',
            'message' => 'دسته با موفقیت درج شد'
        ]);
        
    }
    
    public function edit($id){
        $option = Option::findOrFail($id);
        return view('admin.option.edit', ['option' => $option]);   
    }
    public function update(Request $request, $id){
        $roles = [
            'name' => ['required', 'max:255'],
            'content' => ['has','max:255'],
            'attachment_count' => ['required'],
        ];
        $validation = Validator::make($request->all(), $roles);
        $validation->validate();
        $option = Option::findOrFail($id);
        $option->name = $request->name;
        $option->content = $request->content;
        $option->save();
        $option->roles()->delete();
        $option->roles()->create([
            'role_key' => 'attachment_count',
            'role_value' => $request->attachment_count
        ]);
        return redirect()->route('option.edit', $option->id)->with('message', [
            'type' => 'success',
            'message' => 'دسته با موفقیت ویرایش شد'
        ]);
    }

    public function destroy($id){
        $option = Option::findOrFail($id);
        $option->delete();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'دسته با موفقیت حذف شد'
        ]);
    }
}
