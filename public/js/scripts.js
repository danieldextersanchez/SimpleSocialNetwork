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
    var content = $(this).parents('div.postedpost').children('.postcontent').html(); 
    $("#sharebody").html(content);  
    $("#myModal").modal();
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