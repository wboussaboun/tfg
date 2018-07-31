@extends('layouts.logged')
@section('title')
Shared Folders
@endsection
@section('sidenavActions')
<a href="/user/folders/">My Files</a>
@endsection
@section('content')

<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">Owner</th>
  </tr>
</thead>
<tbody>
  @foreach($folders as $cFolder)
    <tr>
      <td>{{$cFolder->id}}</td>
      <td><a href="/user/folders/{{$cFolder->id}}">{{$cFolder->name}}</a></td>
      <td>{{$cFolder->user_id}}</td>
    </tr>
  @endforeach
</tbody>
</table>
<div id="results"></div>
@endsection
