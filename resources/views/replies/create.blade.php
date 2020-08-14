@extends('layouts.app')

@section('content')
    <form  method="post" action="/reply/{{$thread}}" >

        @csrf
        <label for="lname">body</label><br>
        <input type="text"  name="body"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
