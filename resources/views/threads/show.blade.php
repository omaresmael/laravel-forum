@extends('layouts.app')
@inject('str', 'Illuminate\Support\Str')
@section('content')
    <thread inline-template :initial-replies-count="{{$thread->replies_count}}">
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

                <replies  :thread="{{$thread->id}}" @erase="minusReply" @increase="incrementReply"></replies>





{{--                @if(auth()->check())--}}

{{--                    <form  method="post" action="/threads/{{$thread->id}}/replies" >--}}

{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <textarea name="body" id="body" class="form-control" placeholder="Hava somethin to say?" rows="5"></textarea>--}}
{{--                        </div>--}}
{{--                        <input type="submit" class="btn btn-default" value="Submit">--}}
{{--                    </form>--}}
{{--                @else--}}
{{--                    <a href="/login">Please sign in to participate</a>--}}

{{--                @endif--}}
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <p> This thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href="#">{{$thread->owner->name}}</a>  and has <span v-text="repliesCount"></span> {{Str::plural('comment',$thread->replies_count)}} </p>
                    </div>
                </div>
            </div>

        </section>








    </section>
    </thread>
@endsection
<script>
    import NewReply from "../../js/components/NewReply";
    export default {
        components: {NewReply}
    }
</script>
