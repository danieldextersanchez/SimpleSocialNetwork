@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')


<div class="container content" >

<h4 class='inline'>What's happening?</h4>
<label id='charnum' class='floatright inline'>140</label>


<textarea id='postinput' name="postinput" class='form-control' maxlength="140">
</textarea>
<br>
<div style='min-height:50px;min-width:100px'>
<button class='btn btn-default floatright' id='update' style='height:50px;width:100px'>Update</button> 
</div>

<h4 style='margin-top:50px'><b>Home</b></h4>


@if(sizeof($posts) > 0)
<div id='home'>
  <?php
   for($i=0;$i<sizeof($posts);$i++){
    $name = $posts[$i]->name;   
    $post = $posts[$i]->status;
    $id = $posts[$i]->id;
    $username = $posts[$i]->username;
    
    $date =Carbon\Carbon::parse($posts[$i]->created_at)->diffForHumans();
    echo "
    
    <div class='well postedpost pointer' style='background-color:#FFFFFF' >

        <div class='floatright postactions' style='display:none'>
        <i value='$id' class='material-icons share' >
        reply
        </i>
       </div>
       
       <div class='postcontent' >
       <b>$name</b> ".'@'."$username . $date<br>
       $post
       </div>
    </div>
       ";
   }

  ?>
    
</div>
@else
<div class='center' style='margin-top:100px'><h3>There are no posts</h3></div>

@endif


@yield('posts')


</div>
@stop








<div id='spinkit' style='display:none'></div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title center">Retweet This?</h4>
        </div>
        <div class="modal-body" id='sharebody'>
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!--SCRIPTS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.core.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/alertify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@if(Auth::user() != null )
<script src="{{asset('js/http.js')}}"></script>
<script>  
        $(document).on("click","#update",function(){
            $("#update").html($("#spinkit").html());
            post("{{ csrf_token() }}","{{Auth::user()->id}}",$("#postinput").val())
        })    
</script>
@else
<script>
$(document).on("click","#update",function(){ 
    alertify.error("Please login");
})
</script>
@endif  


<script src='{{asset('js/scripts.js')}}'>
</script>