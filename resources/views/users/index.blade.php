@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('sidenavActions')
<a href="/user/folders">Go to my files</a>
<a href="/tasks">Calendar</a>
<a href="/friends">Friends</a>

@endsection
@section('content')

@endsection
