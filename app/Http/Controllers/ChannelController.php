<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use Illuminate\Http\Request;




class ChannelController extends Controller
{
    public function show(Channel $channel){
        $threads = $channel->threads;

        return view('threads.index',compact('threads'));
    }
}
