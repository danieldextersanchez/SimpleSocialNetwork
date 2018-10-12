function post(token,user_id,post){
    $.ajax({
        url : "posts",
        type : 'PUT',
        data: {
            "_token": token,
            "user_id": user_id,
            "post": post
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
}


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