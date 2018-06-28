@extends('layouts.logged')
@section('title')
{{$user->name}}'s Friends
@endsection
@section('sidenavActions')

<a href="/friends">Show Friends</a>

@endsection
@section('content')
  {!! Form::open(['method' => 'POST', 'action'=>'UserController@storeFriend']) !!}
    <div class="form-group">
      {!! Form::text('name', null, ['class'=> 'form-controll']) !!}
      {!! Form::submit('Add Friend', ['class' => 'btn btn-primary']) !!}
    </div>

  {!! Form::close() !!}
@endsection
