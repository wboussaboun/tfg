@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('html_head')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="/css/fullcalendar.min.js"></script>
@endsection
@section('sidenavActions')
<a class="addTask">Create Event</a>
@endsection
@section('content')


<h3>Calendar</h3>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Full Calendar Example</div>

                <div class="panel-body">
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="results"></div>

<div id="ui_add_task" style="display:none; cursor: default">
        <h1>Add task.</h1>
        Task name:
        <br />
        <input type="text" class="name" />
        <br /><br />
        Task description:
        <br />
        <textarea class="description"></textarea>
        <br /><br />
        Start time:
        <br />
        <input type="date" class="start_date" class="datepicker" />
        <br /><br />
        End time:
        <br />
        <input type="date" class="end_date" class="datepicker" />
        <br /><br />
        <input type="button" id="yes" value="Add Task" />
        <input type="button" id="no" value="Cancel" />
</div>
<script src="/js/jquery.blockUI.js"></script>
<script>
$(".addTask").click(function(){
  $.blockUI({ message: $('#ui_add_task'), css: { width: '275px' } });
});

$('#yes').click(function() {
  // update the block message
  $.ajax(
  {
  url: "/tasks",
  type: 'POST',
  data: {
    '_token': $('input[name=_token]').val(),
    'name' : $(".name").val(),
    'description' : $(".description").val(),
    'start_date' : $(".start_date").val(),
    'end_date' : $(".end_date").val(),

  },
    success: function(result){
    $("#results").html(result);
    location.reload(true);
  }
});
});

$('#no').click(function() {
  $.unblockUI();
  return false;
});
</script>
{!! $calendar->script() !!}
@endsection
