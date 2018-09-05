@extends('layouts.logged')
@section('title')
{{$user->name}}'s Profile
@endsection
@section('html_head')
<link href="/css/cardcss.css" rel="stylesheet">
@endsection
@section('sidenavActions')
<a href="/user/edit">Edit Profile</a>

@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
									
										<div class="form-group">
											<label for="name">Name: {{$user->name}}</label><br>
							        <label for="email">E-mail: {{$user->email}}</label><br>
										</div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
