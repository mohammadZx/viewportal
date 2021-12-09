<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use App\Request as Req;
use Illuminate\Support\Facades\Validator;
use App\Options\Uploader;
class QuestionRequestController extends Controller
{
    public function create($id){
        $tr = Transaction::findOrFail($id);
        if(!auth()->user()->can('admin') && $tr->user->id != auth()->user()->id){
            return abort(403);
        }
        $request = $tr->request ? Req::find($tr->request->id) : null;
        $imageCount = $tr->optionVar->option->roles()->where('role_key', 'attachment_count')->first();
        return view('question.request', [
            'tr' => $tr,
            'imageCount' => $imageCount,
            'request' => (object) [
                'id' => $request ? $request->id : null,
                'title' => $request ? $request->title : null,
                'content' => $request ? $request->content : null,
                'name' => $request ? $request->getMeta('name', true) : null,
                'material' => $request ? $request->getMeta('material', true) : null,
                'age' => $request ? $request->getMeta('age', true) : null,
                'race' => $request ? $request->getMeta('race', true) : null,
                'weight' => $request ? $request->getMeta('weight', true) : null,
                'history' => $request ? $request->getMeta('history', true) : null,
                'attachment' => $request ? $request->getMeta('attachment') : []
            ]
        ]);
    }   
    public function store(Request $req, $id){
        $validations = [
            'title' => ['required', 'max:255'],
            'content' => ['max:1000'],
            'name' => ['required', 'max:255'],
            'age' => ['required', 'max:255'],
            'material' => ['required', 'max:255'],
            'race' => ['required', 'max:255'],
            'weight' => ['required', 'max:255'],
            'history' => ['max:500'],
        ];
        $validator = Validator::make($req->all(), $validations);
        $validator->validate();

        $tr = Transaction::findOrFail($id);
        if(!auth()->user()->can('admin') && $tr->user->id != auth()->user()->id){
            return abort(403);
        }
        
        $imageCount = $tr->optionVar->option->roles()->where('role_key', 'attachment_count')->first();
        $imageCount = $imageCount ? $imageCount->role_value : IMAGECOUNT;
        $request = new Req();
        $request->status = "new";
        $status = "create";
        if($req->has('req_id')){
            $request = Req::findOrFail($req->req_id);
            $request->status = "updated";
            $status = "update";
            $request->meta()->where('meta_key', 'attachment')->delete();
        }
        $request->transaction_id = $tr->id;
        $request->title = $req->title;
        $request->content = $req->content;

        $request->save();
        $request->setMeta('name', $req->name, 0 , true);
        $request->setMeta('age', $req->age, 0 , true);
        $request->setMeta('material', $req->material, 0 , true);
        $request->setMeta('race', $req->race, 0 , true);
        $request->setMeta('weight', $req->weight, 0 , true);
        $request->setMeta('history', $req->history, 0 , true);

        if($req->has('files') && $req->files){
            $files = count($req->all()['files']) <= $imageCount ? $req->all()['files'] : array_slice($req->all()['files'],0 ,$imageCount);
            // upload images
            foreach($files as $file){
                $attament = Uploader::add($file);
                $request->setMeta('attachment', $attament->id);
            }
        }
        
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => "سوال شما با موفقیت ".__('app.'.$status)." شد"
        ]);
    }
}
