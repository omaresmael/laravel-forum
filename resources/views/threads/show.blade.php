@extends('layouts.app')
@inject('str', 'Illuminate\Support\Str')
@section('content')
    <section class="container">
        <section class="row ">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/profile/{{$thread->owner->name}}"> {{$thread->owner->name}}</a> Posted:
                        {{$thread->title}}
                        @can('update',$thread)
                            <form action="{{$thread->path()}}" method="post" style="float: right">
                                {{csrf_field()}}
                                {{method_field('delete')}}

                                <button type="submit" >
                                    Delete
                                </button>

                            </form>
                        @endcan
                    </div>
                    <div class="panel-body">
                    {{$thread->body}}
                    </div>
                </div>


                @foreach($replies as $reply)
                    <reply :attributes="{{$reply}}" inline-template v-cloak>

                    <div id="reply-{{$reply->id}}" class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                                <h5 class="flex">
                                <a href="/profile/{{$reply->owner->name}}">{{$reply->owner->name}}</a>
                                <p style="display: inline">Said {{$reply->created_at->diffForHumans()}}</p>
                                </h5>
                                @if(auth()->check())
                                    <favorite :reply="{{$reply}}" ></favorite>

                                    @endif

                            </div>

                        </div>
                        <div  class="panel-body">
                            <div v-if="editing">
                                <textarea class="form-control" v-model="attributes.body"></textarea>
                                <button class=" btn btn-primary btn-xs" @click="update" style="margin-right: 1px">
                                    Update
                                </button>
                                <button @click="editing = false" class=" btn btn-link btn-xs" style="margin-right: 1px">
                                    Cancel
                                </button>
                            </div>
                            <div v-else v-text="attributes.body" >

                            </div>
                        </div>

                        @can('update', $reply)
                            <div class="panel-footer" style="display: flex; align-items: center ">
                                <button @click="editing = true" class=" btn btn-info btn-xs" style="margin-right: 1px">
                                    Edit
                                </button>
                                <button @click="destroy" class=" btn btn-danger btn-xs" style="margin-right: 1px">
                                    Delete
                                </button>

                            </div>

                        @endcan
                    </div>
                </reply>

                @endforeach
                {{$replies->links()}}
                @if(auth()->check())

                    <form  method="post" action="/threads/{{$thread->id}}/replies" >

                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Hava somethin to say?" rows="5"></textarea>
                        </div>
                        <input type="submit" class="btn btn-default" value="Submit">
                    </form>
                @else
                    <a href="/login">Please sign in to participate</a>

                @endif
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <p> This thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href="#">{{$thread->owner->name}}</a>  and has {{$thread->replies_count }} {{Str::plural('comment',$thread->replies_count)}} </p>
                    </div>
                </div>
            </div>

        </section>








    </section>
@endsection
