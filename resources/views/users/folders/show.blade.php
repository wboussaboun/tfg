@extends('layouts.logged')
@section('title')
{{$folder->name}}
@endsection
@section('sidenavActions')
<a href="/user/folders/{{$folder->folder_id}}">Parent folder: {{$folder->folder_id}}</a><br>
<a href="/user/folders/create">Create Folder</a>
<a href="/user/files/create">Upload File</a>
@endsection
@section('content')

<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">name</th>
    <th scope="col">Owner</th>
    <th scope="col">Delete</th>
    @if($user->id==$folder->user_id)
    <th scope="col">Share</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach($folder->childFolders as $cFolder)
    <tr class="folder-{{$cFolder->id}}">
      <td>{{$cFolder->id}}</td>
      <td><a href="/user/folders/{{$cFolder->id}}">{{$cFolder->name}}</a></td>
      <td>{{$user->name}}</td>
      <td><button class="deleteFolder" data-id="{{$cFolder->id}}">Delete Folder</button></td>
      @if($user->id==$cFolder->user_id)
      <td>
          <div class="form-group">
            <a href="/user/folder/share/{{$cFolder->id}}">Share Folder<a>
          </div>
      </td>
      @endif
    </tr>
  @endforeach
  @foreach($folder->childFiles as $cFile)
    <tr class="file-{{$cFile->id}}">
      <td>{{$cFile->id}}</td>
      <td><a href="/user/files/{{$cFile->id}}">{{$cFile->name}}</a></td>
      <td>{{$user->name}}</td>
      <td><button class="deleteFile" data-id="{{$cFile->id}}">Delete File</button></td>
      @if($user->id==$cFile->user_id)
      <td>
          <div class="form-group">
            <a href="/user/file/share/{{$file->id}}">Share File<a>
          </div>
      </td>
      @endif
    </tr>
  @endforeach
</tbody>
</table>
<div id="results"></div>
<script>
$(document).ready(function() {
$(".deleteFolder").click(function(){
              var id = $(this).data("id");
              $.ajax(
              {
                  url: ""+id,
                  type: 'DELETE',
                  data: {
                      '_token': $('input[name=_token]').val(),
                  },
                  success: function(result){
                    $("#results").html(result);
                    $(".folder-"+id).remove();
                  }
              });


          });

$(".deleteFile").click(function(){
        var id = $(this).data("id");
        $.ajax(
        {
            url: "/user/files/"+id,
            type: 'DELETE',
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(result){
              $("#results").html(result);
              $(".file-"+id).remove();
            }
        });


    });

});
</script>
@endsection
