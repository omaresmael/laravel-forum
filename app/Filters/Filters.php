<?php


namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @param $username
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters as $filter){

            if ($this->hasFilters($filter)){

                $this->$filter($this->request->$filter);
            }
        }
        return $builder;

    }

    /**
     * @param $filter
     * @return bool
     */
    public function hasFilters($filter): bool
    {
        return $this->request->has($filter) && method_exists($this, $filter);
    }
}
