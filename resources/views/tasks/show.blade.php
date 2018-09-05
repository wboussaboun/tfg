@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('sidenavActions')
<a href="/tasks/create">Create Event</a>
<a href="/tasks">Show Events</a>
@endsection
@section('content')

  {{ csrf_field() }}
  Task name: {{$task->name}}
  <br /><br />
  Task description: {{$task->description}}
  <br /><br />
  Start time: {{$task->start_date}}
  <br /><br />
  End time: {{$task->end_date}}
  <br /><br />
  <form method="post" action="/tasks/{{$task->id}}">
    <input type="hidden" name="_method" value="DELETE">
    <div class="form-group" >
        {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">
                Delete Task
            </button>
    </div>
  </form>


@endsection
