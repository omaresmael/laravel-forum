<?php

namespace App;
use App\Filters\ThreadFilters;

use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
    use RecordActivities;
    protected $guarded =[];

    protected static function boot() // this function happens whenever thead been dealt with
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder){
            $builder->withCount('replies'); // this function add 'replies_count' to the Thread properties
        });

    }


    public function channel(){
        return $this->belongsTo(Channel::class, 'channel_id');
}
    public function path(){
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }
    public function replies(){
        return $this->hasMany(Reply::class)->withCount('favorites')->with('favorites');
    }
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function scopeFilter($query,$filters)
    {

        return $filters->apply($query);
    }



}
