@extends('layouts.logged')
@section('title')
@endsection
@section('content')
<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">Download</th>
    @if($user->id==$file->user_id)
    <th scope="col">Share</th>
    @endif
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
      @if($user->id==$file->user_id)
      <td>
          <div class="form-group">
            <a href="/user/file/share/{{$file->id}}">Share File<a>
          </div>
      </td>
      @endif
    </tr>
</tbody>
</table>

@endsection
