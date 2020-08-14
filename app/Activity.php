<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo(); // it returns the recorded instance ex => if i created an thread, this function returns it;
    }

}
