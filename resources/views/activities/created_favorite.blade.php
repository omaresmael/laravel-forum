@if($activity->subject->favorited)
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">

                {{$user->name}} Favorited A Reply:

                <a href="{{$activity->subject->favorited->path()}}">{{$activity->subject->favorited->body}}</a>

            </h5>



        </div>

    </div>

</div>
@endif

