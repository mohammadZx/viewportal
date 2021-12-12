<?php
namespace App\Policies;

use Closure;

abstract class AccessHandler{

    public function handle($request, Closure $next){

        $builder = $next($request);

        if(!auth()->user()->can($this->filterName())){
           return $builder;  
        }
        
        return $this->applyFilter($builder);   
    }

    abstract public function filterName();
    abstract public function applyFilter($builder);

}