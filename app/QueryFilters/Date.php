<?php
namespace App\QueryFilters;

use App\QueryFilters\Filter;
use Carbon\Carbon;
class Date extends Filter{
    
    public function filterName(){
        return 'date';
    }

    public function applyFilter($builder){
        $date = explode(',', request()->get($this->filterName()));
        $start = isset($date[0]) ? date($date[0]) : Carbon::today();
        $end = isset($date[1]) ? date($date[1]) . " 00:00:00" : Carbon::today();
        return $builder->whereBetween('created_at', [$start, $end]);
    }
}