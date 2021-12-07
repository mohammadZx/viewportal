<?php
namespace App\QueryFilters;

use Closure;

abstract class Filter{
    public $table;
    public function __construct($model)
    {
        $this->table = (new $model)->getTable();   
    }
    public function handle($request, Closure $next){

        $builder = $next($request);

        if(!request()->has($this->filterName())){
           return $builder;  
        }
        
        return $this->applyFilter($builder);   
    }

    abstract public function filterName();
    abstract public function applyFilter($builder);

}