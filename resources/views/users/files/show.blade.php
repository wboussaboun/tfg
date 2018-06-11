@extends('layouts.app')
@section('title')
@endsection
@section('content')
<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">Download</th>
  </tr>
</thead>
<tbody>
    <tr>
      <td>{{$file->id}}</td>
      <td>{{$file->name}}</td>
      <td>
        <form method="get" action="/user/files/dl/{{$file->id}}">

          <div class="form-group">
            {!! Form::submit('Download File', ['class' => 'btn btn-primary']) !!}
          </div>

        </form>
      </td>
    </tr>
</tbody>
</table>

@endsection
