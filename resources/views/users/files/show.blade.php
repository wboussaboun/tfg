@extends('layouts.app')
@section('title')
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
    <tr>
      <td>{{$file->id}}</td>
      <td>{{$file->name}}</td>
      <td><button>Delete File</button></td>
    </tr>
</tbody>
</table>
@endsection
