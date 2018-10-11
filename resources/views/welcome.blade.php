@extends('layouts.app')

@section('content')

<div id='spinkit' style='display:none'></div>
<div class="container content" >
<h4 class='inline'>What's happening?</h4>
<label id='charnum' class='floatright inline'>140</label>


<textarea id='postinput' name="postinput" class='form-control' maxlength="140">
</textarea>
<br>
<button class='btn btn-default floatright' id='update' style='height:50px;width:100px'>Update</button> 
<div>


</div>









@endsection



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.core.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




<script>
$(document).ready(function(){
    $("#spinkit").load("views/spinkit");
})
$(document).on("keyup","#postinput",function(e){
    $("#update").html($("#spinkit").html());
            var limit = 140;
            var length = $(this).val().length;
            var result = limit - length;
            $("#charnum").text(result);
            if (result <= 0 && e.which !== 0 && e.charCode !== 0) {
                $('textarea').val((tval).substring(0, tlength - 1));
                return false;
            }
        })
</script>
@if(Auth::user() != null )
<script>
        $(document).on("click","#update",function(){

            $.ajax({
                url : "posts",
                type : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": "{{Auth::user()->id}}",
                    "post": $("#postinput").val()
                },
                success:function(result){
                    alertify.success(result.message);
                },
                error:function(xhr, status, error){
                    alertify.error(errormessage(xhr.responseText));
                }
            })
        })


    function errormessage(error){
    error = JSON.parse(error);
    var errors = Object.keys(error);
    let message = "<ul>";
      for(let i =0;i<errors.length;i++){
          for(let k=0;k<error[errors[i]].length;k++){
              if(error[errors[i]][k] != undefined){
                  message += "<li>"+error[errors[i]][k]+"</li>";
              }
          }
      }
      message+="<ul>";
      return message;
  }
</script>
@else
<script>


$(document).on("click","#update",function(){ 
    alertify.error("Please login");
})
</script>

@endif  