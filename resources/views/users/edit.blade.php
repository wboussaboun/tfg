@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
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
        <label for="email">E-mail: {{$user->email}}</label>
        <label for="name">Photo: brb</label>
			</div>
			<a href="/user/edit">Edit Profile</a>

			</div>
			</form>
		</div>
	 </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit profile</div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/user/update" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{$user->name}}" required autofocus>
                            </div>
                            </div>
                            <div class="form-group">
																<label for="file" class="col-md-4 control-label">Profile Photo</label>
                                {!! Form::file('file', null, ['class'=> 'form-controll']) !!}
                            </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
										<form method="post" action="/user/delete">
											<input type="hidden" name="_method" value="DELETE">
											<div class="form-group" >
													{{ csrf_field() }}
													<div class="col-md-8 col-md-offset-4">
															<button type="submit" class="btn btn-danger">
																	Delete
															</button>
													</div>
											</div>
										</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
