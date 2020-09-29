<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class ReplyController extends Controller
{


    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(thread $thread)
    {

        return $thread->replies()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Thread $thread)

    {

        $this->validate(\request(),[
            'body' => 'required'
        ]);
           $reply = $thread->addReply([
                'body' => \request('body'),
                'user_id' => auth()->id()
            ]);

           if (\request()->expectsJson()){
               return $reply->load('owner');
           }
           return redirect($thread->path())
               ->with('flash','Your Reply Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $reply->update(\request(['body']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reply $reply
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Reply $reply, Thread $thread)
    {

        $this->authorize('update',[$reply]);


        $reply->delete();
        if(\request()->expectsJson()){
            return response(['message'=>'it\'s done']);
        }
        return redirect($thread->path())
            ->with('flash','your Reply has Been Successfully Deleted');

    }
}
