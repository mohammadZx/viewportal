<?php
namespace App\Policies;

use App\Policies\AccessHandler;
use Carbon\Carbon;
class CustomerPolicy extends AccessHandler{
    
    public function filterName(){
        return 'customer';
    }

    public function applyFilter($builder){
        return $builder->whereHas('transaction', function($q){
            $q->where('user_id', auth()->user()->id);
        });
    }
}