<?php
namespace App\Policies;

use App\Policies\AccessHandler;
use Carbon\Carbon;
class AdminPolicy extends AccessHandler{
    
    public function filterName(){
        return 'admin';
    }

    public function applyFilter($builder){
        if(request()->is('request')){
            return $builder;
        }
        return $builder->whereHas('transaction', function($q){
            $q->where('user_id', auth()->user()->id);
        });
    }
}