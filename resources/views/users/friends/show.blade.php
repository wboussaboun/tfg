@extends('layouts.logged')
@section('title')
{{$user->name}}'s friends
@endsection
@section('sidenavActions')

<a class="addFriend">Add Friend</a>
@endsection
@section('content')

<table class="table">
<thead>
  <tr>
    <th scope="col">name</th>
    <th scope="col">email</th>
    <th scope="col">Delete</th>

  </tr>
</thead>
<tbody>
  @foreach($user->friends as $friend)
    <tr class="friend-{{$friend->id}}">
      <td>{{$friend->name}}</td>
      <td>{{$friend->email}}</td>
      <td><button class="deleteFriend" data-id="{{$friend->id}}">Delete Friend</button></td>
    </tr>
  @endforeach
</tbody>
</table>
<div id="results"></div>

<div id="ui_add_friend" style="display:none; cursor: default">
        <h1>Add friend.</h1>
        <input type="text" placeholder="john" id="friend"/>
        <input type="button" id="yes" value="Add" />
        <input type="button" id="no" value="Cancel" />
</div>
<script src="/js/jquery.blockUI.js"></script>
<script>
$(document).ready(function() {
$(".deleteFriend").click(function(){
  var id = $(this).data("id");
  $.ajax(
  {
    url: "/friend/delete/"+id,
    type: 'GET',
    success: function(result){
      $("#results").html(result);
      $("#friend-"+id).remove();
    }
  });
});


$(".addFriend").click(function(){

  $.blockUI({ message: $('#ui_add_friend'), css: { width: '275px' } });
});

$('#yes').click(function() {
  // update the block message
  console.log($("#friend").val())
  $.ajax(
  {
  url: "/friends/store",
  type: 'POST',
  data: {
    '_token': $('input[name=_token]').val(),
    'friend' : $("#friend").val(),
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

});
</script>
@endsection
