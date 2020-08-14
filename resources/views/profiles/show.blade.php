@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">


                    @foreach($activities as $date => $activity)
                        <h3 class="page-header">{{$date}}</h3>

                        @foreach($activity as $record)
                            @if($record->subject == null)
                                @continue
                            @endif
                            @if(view()->exists("activities.$record->type"))
                                @include("activities.".$record->type,['activity' => $record] )
                            @endif
                                @endforeach

                    @endforeach
                   {{-- {{$date->links()}} --}}

                </div>
                </div>
            </div>
        </div>

@endsection

