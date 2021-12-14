<?php
namespace App\Policies;

use App\Policies\AccessHandler;
use Carbon\Carbon;
class ExpertOnePolicy extends AccessHandler{
    
    public function filterName(){
        return 'expert_one';
    }

    public function applyFilter($builder){
    if(request()->is('request')){
        return $builder->where('requests.status', '<>', 'comment')->where('requests.status', '<>', 'reference');
    }
    return $builder->whereHas('transaction', function($q){
        $q->where('user_id', auth()->user()->id);
    });
    }
}