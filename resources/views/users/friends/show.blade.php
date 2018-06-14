@extends('layouts.logged')
@section('title')
{{$user->name}}'s friends
@endsection
@section('sidenavActions')

<a href="/friends/add">Add Friend</a>
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
<script>
$(document).ready(function() {
$(".deleteFriend").click(function(){
              var id = $(this).data("id");
              $.ajax(
              {
                  url: "/friends/delete/"+id,
                  type: 'DELETE',
                  success: function(result){
                    $("#results").html(result);
                    $(".friend-"+id).remove();
                  }
              });


          });

});
</script>
@endsection
