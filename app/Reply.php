<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordActivities;
    protected $guarded =[];
    protected $with = ['owner'];

    protected $appends = ['isFavorited'];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites(){
        return $this->morphMany(Favorite::class, 'favorited');
    }
    public function favorite(){
        if (! $this->favorites()->where(['user_id' => auth()->id()])->exists())
       return $this->favorites()->create(['user_id' => auth()->id()]);

        /* hey omar from the future, I know you feel dumber now
           so i hope this comment makes it less dumb.
           Morph many relationship is like many to many but with
           three partners, the main partners - in this case use-
           rs and replies - shares a many to many relation thro-
           ugh the third partner -in this case: favorites - the
           reply has many favorites each by a user, and the us-
           er has many favorites each of a reply.
           /////////////////////////////////////
           you may now wonder: where the favorited id and the t-
           ype! - you silly dumb ass - the morphMany function in some
           magical way get them and assign them by default */


    }
    public function unFavorite(){
        return $this->favorites()->where(['user_id' => auth()->id()])->delete();
    }
    public function isFavorited(){
        return $this->favorites->where('user_id', auth()->id())->count();

    }
    public function getIsFavoritedAttribute(){ // that took the output of a function and parse it to json object with variable $append
        return $this->isFavorited();
    }


    public function thread(){
        return $this->belongsTo(Thread::class);
    }
    public function path(){
        return $this->thread->path().'#reply-'.$this->id;
    }

}
