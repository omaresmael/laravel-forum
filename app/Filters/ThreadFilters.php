<?php

namespace App\Filters;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Http\Request;



class ThreadFilters extends Filters
{
    protected $filters = ['by','popular'];
    protected $builder;


    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    public function popular()
    {

        $this->builder->getQuery()->orders = []; // Removes any previous order (like latest) to add our popular order
        return $this->builder->orderBy('replies_count','desc');
    }
}
