@extends('layouts.app')
@section('channels')

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Channels</a>
        <div class="dropdown-menu">
    @foreach($channels as $channel)
        <a class="dropdown-item" href="/threads/{{$channel->slug}}">
                {{$channel->slug}} <br>

            </a>
            @endforeach
        </div>
@endsection

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse($threads as $thread)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <h4 class="flex">
                                <a href="{{$thread->path()}}">{{$thread->title}}</a>

                            </h4>
                            <a href="{{$thread->path()}}" ><strong> {{$thread->replies_count}} {{Str::plural('reply',$thread->replies_count)}} </strong></a>
                        </div>
                    </div>
                    <div class="panel-body">
                                    <p class="body">
                                        {{$thread->body}}
                                    </p>
                            <hr>



                    </div>
                </div>
                @empty
                    <p>There are no relevant results now</p>
                @endforelse
                    {{$threads->links()}}

            </div>
        </div>



    </section>
@endsection
