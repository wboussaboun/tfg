@extends('layouts.app')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
  {!! Form::open(['method' => 'POST', 'action'=>'FolderController@store']) !!}
    <div class="form-group">
      {!! Form::text('name', null, ['class'=> 'form-controll']) !!}
      {!! Form::submit('Create Folder', ['class' => 'btn btn-primary']) !!}
    </div>

  {!! Form::close() !!}
@endsection
