@extends('layouts.logged')
@section('title')
edit {{$folder->name}} name
@endsection
@section('content')
  <label>Old name: {{$folder->name}}</label>
  <form method="post" action="/user/folders/{{$folder->id}}">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
      {!! Form::text('name', null, ['class'=> 'form-controll']) !!}
      {!! Form::submit('Create Folder', ['class' => 'btn btn-primary']) !!}
    </div>

  </form>
@endsection
