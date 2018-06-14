@extends('layouts.logged')
@section('title')
{{$user->name}}'s Profile
@endsection
@section('title')
<link href="/css/cardcss.css" rel="stylesheet">
@endsection
@section('content')
<div class="outer">
	  <div class="middle">
		<div class="inner">
		  <form>
			<div class="card mb-3 headerAdjusting mx-auto borderPad" style="max-width: 35rem;">
			  <div class="card-header text-center">Profile</div>
			<div class="form-group">
				<label for="name">Name: {{$user->name}}</label>
        <label for="name">E-mail: {{$user->email}}</label>
        <label for="name">Photo: brb</label>
			</div>
			<a href="/user/edit">Edit Profile</a>

			</div>
			</form>
		</div>
	  </div>
	</div>
@endsection
