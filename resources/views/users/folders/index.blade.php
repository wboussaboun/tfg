@extends('layouts.logged')
@section('title')
{{$user->name}}'s Storage
@endsection
@section('content')
<a href="/user/folders/create">Create Folder</a>
<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">Owner</th>
  </tr>
</thead>
<tbody>
  @foreach($folder->childFolders as $cFolder)
    <tr>
      <td>{{$cFolder->id}}</td>
      <td><a href="/user/folders/{{$cFolder->id}}">{{$cFolder->name}}</a></td>
      <td>{{$user->name}}</td>
    </tr>
  @endforeach
  @foreach($folder->childFiles as $cFile)
    <tr>
      <td>{{$cFile->id}}</td>
      <td><a href="/user/files/{{$cFile->id}}">{{$cFile->name}}</a></td>
      <td>{{$user->name}}</td>
    </tr>
  @endforeach
</tbody>
</table>
@endsection
