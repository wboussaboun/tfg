@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
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
														<tr>
															<td>
                            <label for="name" class="col-md-4 control-label">Name</label>
														</td>
														<td>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{$user->name}}" required autofocus>
                            </div>
														</td>
														<tr>
                            </div>
                            <div class="form-group">
															<tr>
																<td>
																	<label for="file" class="col-md-4 control-label">Profile Photo</label>
																</td>
																<td>
                                	{!! Form::file('file', null, ['class'=> 'form-controll']) !!}
																</td>
                            </div>


												<td>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
										<br>
												<form method="post" action="/user/delete">
													<input type="hidden" name="_method" value="DELETE">
													<div class="form-group" >
															{{ csrf_field() }}
															<div class="col-md-8 col-md-offset-4">
																	<button type="submit" class="btn btn-danger">
																			Delete Account
																	</button>
															</div>
													</div>
												</form>
											</td>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
