<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function index(Channel $channel, ThreadFilters $filters)
    {

        $threads = Thread::with('channel')->filter($filters)->latest()->paginate(20);

        if ($channel->exists){
           $threads = $channel->threads()->latest()->get();
        }
        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd(\request());

        $this->validate($request,[
            'title' => 'required',
            'body' =>  'required',//'required|exists:channels,id'
            'channel_id' => 'required',
            ]


            );

        $thread = new Thread();
        $thread->create([
           'title' => \request('title'),
            'channel_id' => \request('channel_id'),
            'body' => \request('body'),
            'user_id' => auth()->id()
        ]);
        return redirect('/threads')
            ->with('flash','Your Thread Has Been Published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, Thread $thread)
    {

        $replies = $thread->replies()->with('owner')->paginate(4) ;
        return view('threads.show',compact(['thread','replies']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {

            $this->authorize('update',$thread);

            $thread->replies()->delete();

            $thread->delete();
            return redirect('threads?by='.$thread->owner->name)
                ->with('flash','your Thread has Been Successfully Deleted');

    }
}
