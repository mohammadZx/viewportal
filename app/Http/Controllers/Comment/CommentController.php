<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Request as Req;
use Illuminate\Support\Facades\Validator;
use App\Options\Uploader;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commets = Comment::where('user_id', auth()->user()->id)->orderBy('id','DESC')->paginate(PRE_PAGE);
        if(auth()->user()->can('admin')){
            $commets = Comment::orderBy('id','DESC')->paginate(PRE_PAGE);
        }
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
        $validation = [
            'graph' => ['required', 'max:255'],
            'tech' => ['required', 'max:255'],
            'interpretation' => ['required'],
            'diagnosis' => ['required'],
            'content' => ['required'],
            'request_id' => ['required', 'valid:requests,id'],
        ];
        $validatior = Validator::make($request->all(), $validation);
        $validatior->validate();
    
        $requestO = Req::findOrFail($request->request_id);
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->request_id = $request->request_id;
        $comment->tech = $request->tech;
        $comment->interpretation = $request->interpretation;
        $comment->diagnosis = $request->diagnosis;
        $comment->content = $request->content;
        $comment->save();
        $comment->setMeta('graph', $request->graph);
        $this->calcCommission($requestO);
        if($request->has('files') && $request->files){
            $files = count($request->all()['files']) <= 20 ? $request->all()['files'] : array_slice($request->all()['files'],0 ,20);
            // upload images
            foreach($files as $file){
                $attament = Uploader::add($file);
                $comment->setMeta('attachment', $attament->id);
            }
        }
        


        $requestO->status = "comment";
        if($requestO->transaction->optionVar->reference >= 2 && $requestO->comments()->count() < $requestO->transaction->optionVar->reference){
            $requestO->status = "reference";
        }
        $requestO->save();


        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'نظر شما با موفقیت ثبت شد'
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
        $comment = Comment::findOrFail($id);
        return view('customer.comment.edit', ['comment' => $comment]);
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
        $validation = [
            'graph' => ['required', 'max:255'],
            'tech' => ['required', 'max:255'],
            'interpretation' => ['required'],
            'diagnosis' => ['required'],
            'content' => ['required'],
        ];
        $validatior = Validator::make($request->all(), $validation);
        $validatior->validate();
        $comment = Comment::findOrFail($id);
        $comment->meta()->where('meta_key', 'attachment')->delete();

        $comment->tech = $request->tech;
        $comment->interpretation = $request->interpretation;
        $comment->diagnosis = $request->diagnosis;
        $comment->content = $request->content;
        $comment->save();
        $comment->setMeta('graph', $request->graph, 0 , true);

        if($request->has('files') && $request->files){
            $files = count($request->all()['files']) <= 20 ? $request->all()['files'] : array_slice($request->all()['files'],0 ,20);
            // upload images
            foreach($files as $file){
                $attament = Uploader::add($file);
                $comment->setMeta('attachment', $attament->id);
            }
        }
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'نظر شما با موفقیت ویرایش شد'
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
        $comment = Comment::findOrFail($id);
        $comment->setMeta('status', 0, 0, true);
        return redirect()->back()->with('message', [
            'type' => 'warning',
            'message' => 'کامنت با موفقیت بروز رسانی شد'
        ]);
    }

    public function approveforrequest($id){
        $comment = Comment::findOrFail($id);
        $comment->setMeta('status', 1, 0, true);
        return redirect()->back()->with('message', [
            'type' => 'success',
            'message' => 'کامنت با موفقیت بروز رسانی شد'
        ]);
    }


    public function calcCommission($request){
        $type = $request->transaction->optionType;
        $userTypePrice = 0;
        $var = $request->transaction->optionVar;
        $userVarPrice = 0;
        // calcType
        if($type->commission_type == 'static'){
            $userTypePrice = $type->price - $type->site_commission;
        }else{
            $userTypePrice = ($type->site_commission / 100) * $type->price;
        }

        for($i = $var->reference; $i >= 1; $i--){
            if($request->comments()->count() == $i){
                $varOption = $this->getVarOptionRole($var->option, $i);
                if($varOption->commission_type == 'static'){
                    $userVarPrice = $varOption->price - $varOption->site_commission;
                }else{
                    $userVarPrice = ($varOption->site_commission / 100) * $varOption->price;
                
                }
                break;
            }
        }
       
        $user = auth()->user();
        $user->wallet += $userTypePrice + $userVarPrice;
        $user->save();

    }

    public function getVarOptionRole($option, $varFactor){
        $var = $option->vars()->where('reference', $varFactor)->first();
        return $var;
    }
}
