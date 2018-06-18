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
<a href="/tasks/create">Create Event</a>
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

{!! $calendar->script() !!}
@endsection
