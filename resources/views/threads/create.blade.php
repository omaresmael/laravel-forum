@extends('layouts.app')

@section('content')

    <form  method="post" action="/threads/" >

        @csrf

        <select name="channel_id">
            <option selected> select one</option>
            @foreach($channels as $channel)

                <option name="channel_id" {{old('$channel->id') == $channel->id ? 'selected' : ''}} value="{{$channel->id}}">
                        {{$channel->slug}} </option>


            @endforeach
        </select>

        <input type="text"  name="title" placeholder="title" value="{{old('title')}}"><br><br>
        <textarea placeholder="body" name="body" >{{old('body')}}</textarea>

        <input type="submit" value="Submit">
        @if(count($errors))
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach

        @endif
    </form>
@endsection
