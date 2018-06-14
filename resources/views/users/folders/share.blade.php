@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
  {!! Form::open(['method' => 'POST', 'action'=>'FolderController@shareWith']) !!}
    <div class="form-group">
      <input type="hidden" name="folderID" value="{{$folder->id}}">
      {!! Form::text('name', null, ['class'=> 'form-controll']) !!}//send a list of names?
      {!! Form::submit('Share File', ['class' => 'btn btn-primary']) !!}
    </div>

  {!! Form::close() !!}
@endsection
