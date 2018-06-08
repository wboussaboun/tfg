@extends('layouts.app')
@section('title')
{{$user->name}}'s Storage
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
  @foreach($user->files as $file)
    <tr>
      <td>{{$file->id}}</td>
      <td><a href="/user/files/{{$file->id}}">{{$file->name}}</a></td>
      <td>{{$user->name}}</td>
    </tr>
  @endforeach
</tbody>
</table>
@endsection
