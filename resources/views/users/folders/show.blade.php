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
    <th scope="col">Actions</th>
  </tr>
</thead>
<tbody>
  @foreach($folder->childFolders as $cFolder)
    <tr class="folder-{{$cFolder->id}}">
      <td>{{$cFolder->id}}</td>
      <td><a href="/user/folders/{{$cFolder->id}}">{{$cFolder->name}}</a></td>
      <td>{{$user->name}}</td>
      <td><button class="deleteFolder" data-id="{{$cFolder->id}}">Delete Folder</button>
      @if($user->id==$cFolder->user_id)
          <button class="shareFolder" data-id="{{$cFolder->id}}">Share Folder</button>
          <button class="favFolder" data-id="{{$cFolder->id}}">Set as favorite</button>
      @endif
      </td>
    </tr>
  @endforeach
  @foreach($folder->childFiles as $cFile)

    <tr class="file-{{$cFile->id}}">
      <td>{{$cFile->id}}</td>
      <td><a href="/user/files/{{$cFile->id}}">{{$cFile->name}}</a></td>
      <td>{{$user->name}}</td>
      <td><button class="deleteFile" data-id="{{$cFile->id}}">Delete File</button>
      @if($user->id==$cFile->user_id)
          <button class="shareFile" data-id="{{$cFile->id}}">Share File</button>
          <button class="favFile" data-id="{{$cFile->id}}">Set as favorite</button>
          <form method="get" action="/user/files/dl/{{$cFile->id}}">
            {!! Form::submit('Download File', ['class' => 'btn btn-primary']) !!}
          </form>
    @endif
      </td>
    </tr>

  @endforeach
</tbody>
</table>
<div id="results"></div>
<input type="text" class="selected_value" hidden value=""/>

<div id="ui_share_folder" style="display:none; cursor: default">
        <h1>Whom to share with.</h1>
        <input type="text" placeholder="john" class="whom"/>
        <input type="button" id="yes" value="Share" />
        <input type="button" id="no" value="Cancel" />
</div>
<script src="/js/jquery.blockUI.js"></script>
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
$(".favFolder").click(function(){
  var id = $(this).data("id");
  $.ajax(
  {
    url: "/user/folders/fav/"+id,
    type: 'GET',
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function(result){
      if (result==1) $("#results").html('success');
      else $("#results").html('error');
    }
  });
});

$(".favFile").click(function(){
  var id = $(this).data("id");
  $.ajax(
  {
    url: "/user/files/fav/"+id,
    type: 'GET',
    data: {
      '_token': $('input[name=_token]').val(),
    },
      success: function(result){
      if (result==1) $("#results").html('success');
        else $("#results").html('error');
      }
  });

});

$(".shareFolder").click(function(){
  var id = $(this).data("id");
  $(".selected_value").val(id);
  console.log($(".selected_value").val());
  $.blockUI({ message: $('#ui_share_folder'), css: { width: '275px' } });

});




$('#yes').click(function() {
  // update the block message
  $.ajax(
  {
    url: "/user/folder/shareFolder",
    type: 'POST',
    data: {
      '_token': $('input[name=_token]').val(),
      'id' : $(".selected_value").val(),
      'whom' : $(".whom").val()
    },
    success: function(result){
      $("#results").html(result);
    }
  });

});






$('#no').click(function() {
    $.unblockUI();
    return false;
});

$(".shareFile").click(function(){
  var id = $(this).data("id");
  var whom = 0;

});

});

</script>
@endsection
