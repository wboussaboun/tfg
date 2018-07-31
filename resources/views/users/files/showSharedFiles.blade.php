@extends('layouts.logged')
@section('title')
Shared Files
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
  @foreach($files as $cFile)
    <tr class="file-{{$cFile->id}}">
      <td>{{$cFile->id}}</td>
      <td><a href="/user/files/{{$cFile->id}}">{{$cFile->name}}</a></td>
      <td>{{$cFile->user_id}}</td>
    </tr>
  @endforeach
</tbody>
</table>
<div id="results"></div>
@endsection
