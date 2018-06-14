@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
<a href="/user/folders">Go to my files</a><br>
<a href="/user">Show Profile (no implementado)</a><br>
<a href="/user">Edit profile (no implementado)</a>
@endsection
