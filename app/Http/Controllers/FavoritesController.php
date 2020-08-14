<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{


    /**
     * FavoritesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
       $reply->favorite();
        if(\request()->expectsJson()){
            return response(['message'=>'it\'s done']);
        }
        return back();

    }
    public function destroy(Reply $reply)
    {
        $reply->unFavorite();
        if(\request()->expectsJson()){
            return response(['message'=>'it\'s done']);
        }

    }
}
