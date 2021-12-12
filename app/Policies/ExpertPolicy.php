<?php
namespace App\Policies;

use App\Policies\AccessHandler;
use Carbon\Carbon;
class ExpertPolicy extends AccessHandler{
    
    public function filterName(){
        return 'expert';
    }

    public function applyFilter($builder){
    if(request()->is('request')){
        return $builder->where('status', '<>', 'comment');
    }
    return $builder->whereHas('transaction', function($q){
        $q->where('user_id', auth()->user()->id);
    });
    }
}