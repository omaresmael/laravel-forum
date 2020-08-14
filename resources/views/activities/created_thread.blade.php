
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                {{$user->name}} published
                <a href="{{$activity->subject->path()}}">{{$activity->subject->title}}</a>

            </h5>



        </div>

    </div>
    <div class="panel-body">
        {{$activity->subject->body}}
    </div>
</div>

