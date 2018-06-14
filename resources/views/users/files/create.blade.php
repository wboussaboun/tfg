@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
  {!! Form::open(['method' => 'POST', 'action'=>'FileController@store', 'files'=> true]) !!}
    <div class="form-group">
      {!! Form::file('file', null, ['class'=> 'form-controll']) !!}
      {!! Form::text('name', null, ['class'=> 'form-controll']) !!}
      {!! Form::submit('Upload File', ['class' => 'btn btn-primary']) !!}
    </div>

  {!! Form::close() !!}
@endsection
