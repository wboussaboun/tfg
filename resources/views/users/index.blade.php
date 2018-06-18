@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
<a href="/user/folders">Go to my files</a><br>
<a href="/tasks">Calendario</a><br>
<a href="/friends">Amigos</a>
@endsection
