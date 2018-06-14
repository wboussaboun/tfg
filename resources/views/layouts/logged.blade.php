@extends('layouts.app')
@section('profilePhoto')
  <li>
    <img class="profileImage" src="http://www.cloudstorage.test/user/photo/{{$user->id}}" height="150" width="150"></img>
  </li>
@endsection

@section('extraScripts')
  <script>
    $(document).ready(function() {
        $.ajax(
        {
          url: "/user/photo/"+{{$user->id}},
          type: 'GET',
          success: function(result){
            $("#profileImage").html(result);
        }
      });
    });
  </script>
@endsection
