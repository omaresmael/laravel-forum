<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class Favorite extends Model
{
    use RecordActivities;
    protected $guarded =[];

    public function favorited(){
        return $this->morphTo(); // it returns the favorited instance ex => a reply
    }
}
