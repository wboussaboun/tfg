@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('sidenavActions')
<a href="/tasks">Show Events</a>
@endsection
@section('content')
<form action="{{ route('tasks.store') }}" method="post">
  {{ csrf_field() }}
  Task name:
  <br />
  <input type="text" name="name" />
  <br /><br />
  Task description:
  <br />
  <textarea name="description"></textarea>
  <br /><br />
  Start time:
  <br />
  <input type="date" name="start_date" class="datepicker" />
  <br /><br />
  End time:
  <input type="date" name="end_date" class="datepicker" />
  <br /><br />
  <input type="submit" value="Save" />
</form>
@endsection
