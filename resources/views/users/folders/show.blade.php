@extends('layouts.logged')
@section('title')
{{$folder->name}}
@endsection
@section('html_head')
<link rel="stylesheet" href="/css/dropzone.css">
<script src="/js/dropzone.js"></script>
@endsection
@section('sidenavActions')
<a href="/user/folders/{{$folder->folder_id}}">Parent folder: {{$folder->folder_id}}</a><br>
<a class="createFolder">Create Folder</a>
<a href="/user/folder/shared">View my shared folders</a>
<a href="/user/file/shared">View my shared files</a>


@endsection
@section('content')

<table class="table" id="folder_table">
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
      <td>
      @if($user->id==$cFolder->user_id)
        <button class="deleteFolder" data-id="{{$cFolder->id}}">Delete Folder</button>
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
      <td>
        @if($user->id==$cFile->user_id)
          <button class="deleteFile" data-id="{{$cFile->id}}">Delete File</button>
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






   <div class="row">
       <div class="col-sm-10 offset-sm-1">

           <form method="post" action="/user/files"
                 enctype="multipart/form-data" class="dropzone" id="my-dropzone">
               {{ csrf_field() }}
               <div class="dz-message">
                   <div class="col-xs-8">
                       <div class="message">
                           <p>Drop files here or Click to Upload</p>
                       </div>
                   </div>
               </div>
               <div class="fallback">
                   <input type="file" name="file" multiple>
               </div>
           </form>
       </div>
   </div>

   <div id="preview" style="display: none;">

       <div class="dz-preview dz-file-preview">
           <div class="dz-image"><img data-dz-thumbnail /></div>

           <div class="dz-details">
               <div class="dz-size"><span data-dz-size></span></div>
               <div class="dz-filename"><span data-dz-name></span></div>
           </div>
           <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
           <div class="dz-error-message"><span data-dz-errormessage></span></div>



           <div class="dz-success-mark">

               <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                   <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                   <title>Check</title>
                   <desc>Created with Sketch.</desc>
                   <defs></defs>
                   <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                       <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                   </g>
               </svg>

           </div>
           <div class="dz-error-mark">

               <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                   <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                   <title>error</title>
                   <desc>Created with Sketch.</desc>
                   <defs></defs>
                   <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                       <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                           <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                       </g>
                   </g>
               </svg>
           </div>
       </div>
   </div>

<a href="/user/folders/{{session()->get('currentFolder')}}"><button>Done</button></a>



<div id="results"></div>
<input type="text" class="selected_value" hidden value=""/>

<div id="ui_share_folder" hidden>
  <div class="panel panel-default">
    <div class="panel-heading">Whom to share with</div>

    <div class="panel-body">
      <input type="text" placeholder="john" class="whom"/>
      <input type="button" id="yesShareFolder" class="btn btn-primary" value="Share" />
      <input type="button" class="no" value="Cancel" />
    </div>
  </div>

</div>

<div id="ui_share_file" hidden>

  <div class="panel panel-default">
    <div class="panel-heading">Whom to share with</div>

    <div class="panel-body">
      <input type="text" placeholder="john" class="whom"/>
      <input type="button" id="yesShareFile" class="btn btn-primary" value="Share" />
      <input type="button" class="no" value="Cancel" />
    </div>
  </div>


</div>

<div id="ui_delete_folder" hidden>

  <div class="panel panel-default">
    <div class="panel-heading">Are you sure you want to delete the folder?</div>

    <div class="panel-body">
      <input type="button" class="btn btn-danger yesDeleteFolder" value="Delete" />
      <input type="button" class="no" value="Cancel" />
    </div>
  </div>


</div>

<div id="ui_delete_file" hidden>

  <div class="panel panel-default">
    <div class="panel-heading">Are you sure you want to delete the file?</div>

    <div class="panel-body">
      <input type="button" class="btn btn-danger yesDeleteFile" value="Delete" />
      <input type="button" class="no" value="Cancel" />
    </div>
  </div>


</div>

<div id="ui_create_folder" hidden>

  <div class="panel panel-default">
    <div class="panel-heading">Enter the folder name</div>

    <div class="panel-body">
      <input type="text" placeholder="documents" class="folder_name"/>
      <input type="button" id="yesFolder" class="btn btn-primary" value="Create" />
      <input type="button" class="no" value="Cancel" />
    </div>
  </div>

</div>
<script src="/js/jquery.blockUI.js"></script>
<script>



$(document).ready(function() {

$(".deleteFolder").click(function(){
  var id = $(this).data("id");
  $(".selected_value").val(id);
  $.blockUI({ message: $('#ui_delete_folder')});
});

$(".uploadFile").click(function(){
  console.log("enter upload file");
  $.blockUI({ message: $('#ui_upload_file')});
});

$(".yesDeleteFolder").click(function(){
  console.log("yes delete folder");
  id = $(".selected_value").val();
  console.log(id);
  $.ajax({
    url: "/user/folders/"+id,
    type: 'DELETE',
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function(result){
      $("#results").html(result);
      $(".folder-"+id).remove();
      $.unblockUI();
    }
  });
});

$(".deleteFile").click(function(){
  var id = $(this).data("id");
  $(".selected_value").val(id);
  $.blockUI({ message: $('#ui_delete_file')});
});

$(".yesDeleteFile").click(function(){
        var id = id = $(".selected_value").val();
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
              $.unblockUI();
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
  $.blockUI({ message: $('#ui_share_folder')});

});

$(".shareFile").click(function(){
  var id = $(this).data("id");
  $(".selected_value").val(id);
  $.blockUI({ message: $('#ui_share_file') });
});

$(".createFolder").click(function(){
  $.blockUI({ message: $('#ui_create_folder') });
});

$('#yesShareFolder').click(function() {
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

$('#yesShareFile').click(function() {
  // update the block message
  $.ajax(
  {
    url: "/user/file/shareFile/",
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

$('#yesFolder').click(function() {
  // update the block message
  $.ajax(
  {
    url: "/user/folders",
    type: 'POST',
    data: {
      '_token': $('input[name=_token]').val(),
      'name' : $(".folder_name").val(),
    },
    success: function(result){
      $("#results").html(result);

      var tableRef = document.getElementById('folder_table').getElementsByTagName('tbody')[0];

// Insert a row in the table at the last row
      var newRow   = tableRef.insertRow(tableRef.rows.length);
      newRow.setAttribute("class", "folder-"+result)
// Insert a cell in the row at index 0
      var newCell  = newRow.insertCell(0);
      var newText  = document.createTextNode(result);
      newCell.appendChild(newText);

      var newCell  = newRow.insertCell(1);
      var newLink = document.createElement("a");
      newLink.setAttribute("href", "/user/folders/"+result);
      var newText  = document.createTextNode($(".folder_name").val());
      newLink.appendChild(newText);
      newCell.appendChild(newLink);

      var newCell  = newRow.insertCell(2);
      var newText  = document.createTextNode("{{$user->name}}");
      newCell.appendChild(newText);

      var newCell  = newRow.insertCell(3);
      var newButton = document.createElement("button");
      var newText  = document.createTextNode("Delete Folder");
      newButton.appendChild(newText);
      newButton.setAttribute("data-id", result);
      newButton.setAttribute("class", "deleteFolder");
      newCell.appendChild(newButton);

      var newButton = document.createElement("button");
      var newText  = document.createTextNode("Share Folder");
      newButton.appendChild(newText);
      newButton.setAttribute("data-id", result);
      newButton.setAttribute("class", "shareFolder");
      newCell.appendChild(newButton);

      var newButton = document.createElement("button");
      var newText  = document.createTextNode("Set as favorite");
      newButton.appendChild(newText);
      newButton.setAttribute("data-id", result);
      newButton.setAttribute("class", "favFolder");
      newCell.appendChild(newButton);




    }
  });

});




$('.no').click(function() {
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
