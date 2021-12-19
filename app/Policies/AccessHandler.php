<?php
namespace App\Policies;

use Closure;

abstract class AccessHandler{

    public function handle($request, Closure $next){

        $builder = $next($request);

        if(auth()->user()->can($this->filterName())){
            $builder =  $this->applyFilter($builder);   
        }else{
            $builder = $builder->whereHas('transaction', function($q){
                $q->where('user_id', auth()->user()->id);
            });
        }
        return $builder;
    }

    abstract public function filterName();
    abstract public function applyFilter($builder);

}