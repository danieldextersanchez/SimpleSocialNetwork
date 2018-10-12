<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.core.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/themes/alertify.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.1/alertify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#spinkit").load("views/spinkit?_token='{{csrf_token()}}' ");
})


$(document).on("mouseenter",".postedpost",function(e){
    $(this).css("background-color","#F0F0F2");
    $(this).children('.postactions').show();
})
$(document).on("mouseleave",".postedpost",function(){
    $(this).css("background-color","#FFFFFF");
    $(this).children('.postactions').hide();
})

$(document).on("click",".share",function(){
    alert($(this).attr("value"));
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
</script>
@if(Auth::user() != null )
<script>

    
        $(document).on("click","#update",function(){
            $("#update").html($("#spinkit").html());
            $.ajax({
                url : "posts",
                type : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": "{{Auth::user()->id}}",
                    "post": $("#postinput").val()
                },
                success:function(result){
                    $("#update").html("Update");
                    alertify.success(result.message);
                },
                error:function(xhr, status, error){
                    $("#update").html("Update");
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