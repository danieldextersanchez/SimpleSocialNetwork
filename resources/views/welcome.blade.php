<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='{{asset('js/http.js')}}'></script>

@extends('layouts.app')
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

<div id='home'> 
</div>




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
        </div><br>
        <textarea id='retwmessage' class='form-control center' style='width:90%;text-align:left' placeholder='Add a comment...'></textarea>
        <div class="modal-body well center" style='width:100%;text-align:left;margin-top:20px'>
          <div id='sharebody'></div>
        </div>
        <div class="modal-footer">
          <button class='btn btn-default' id='retweet'>Retweet</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>







  
<!--SCRIPTS-->
<script>
    $(document).ready(function(){
      $("#spinkit").load("views/spinkit?_token='{{csrf_token()}}' ");
      http.loadpost("{{csrf_token()}}");
    })
</script>


@if(Auth::user() != null )
<script>  
        $(document).on("click","#update",function(){
            $("#update").html($("#spinkit").html());
            http.post("{{ csrf_token() }}","{{Auth::user()->id}}",$("#postinput").val());
        })        
</script>
@else
<script>
$(document).on("click","#update",function(){ 
    alertify.error("Please login");
})
</script>
@endif  



<script>
    $(document).ready(function(){
        $(document).on("mouseenter",".postedpost",function(e){
            $(this).css("background-color","#F0F0F2");
            $(this).children('.postactions').show();
        })
        $(document).on("mouseleave",".postedpost",function(){
            $(this).css("background-color","#FFFFFF");
            $(this).children('.postactions').hide();
        })
        var tweetid;
        var post_user_id;
        $(document).on("click",".share",function(){
            tweetid = $(this).attr("data-1");
            post_user_id = $(this).attr("data-2")
            var content = $(this).parents('div.postedpost').children('.postcontent').html(); 
            $("#sharebody").html(content);  
            $("#myModal").modal();
        })

        $(document).on("click","#retweet",function(){
          http.share("{{csrf_token()}}",post_user_id,tweetid,$("#retwmessage").val());
        })
        
        $(document).on("click",".deletepost",function(){
            var id = $(this).attr("value");
            alertify.confirm('Delete?',function(){
                http.deletepost(id,"{{csrf_token()}}");
            },function(){
                alertify.error("not deleted");
            });
        })

        $(document).on("click",".deleteshare",function(){
            var id = $(this).attr("value");
            alertify.confirm('Delete?',function(){
                http.deleteshare(id,"{{csrf_token()}}");
            },function(){
                alertify.error("not deleted");
            });
        })
        
        $(document).on("keyup","#postinput",function(e){
                    var limit = 140;
                    var length = $(this).val().length;
                    var result = limit - length;
                    $("#charnum").text(result);
                    if (result <= 0 && e.which !== 0 && e.charCode !== 0) {
                        $('textarea').val((tval).substring(0, tlength - 1));
                        return false;
                    }
        })
      })
    
      </script>

