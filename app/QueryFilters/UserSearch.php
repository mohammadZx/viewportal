<?php
namespace App\QueryFilters;

use App\QueryFilters\Filter;

class UserSearch extends Filter{
    
    public function filterName(){
        return 'search';
    }

    public function applyFilter($builder){
        return $builder->where('name', 'LIKE', "%".request()->get($this->filterName())."%")
        ->orWhere('phone', 'LIKE', "%".request()->get($this->filterName())."%");
    }
}