
var http  = {
    post : function(token,user_id,post){
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
                http.loadpost(token);
                alertify.success(result.message);
            },
            error:function(xhr, status, error){
                $("#update").html("Update");
                http.loadpost(token);
                alertify.error(errormessage(xhr.responseText));
            }
        })
    },  
     loadpost : function(token){
        $.ajax({
          url:"load/posts",
          type:"POST",
          data: {
            "_token" : token
          },success:function(data){
            $("#home").html(data);
          },error : function(xhr){
            console.log(xhr); 
          }
        })
      },
      share : function(token,user_id,post_id,message){
        console.log(user_id,post_id,message);
        $.ajax({
            url : "retweet",
            type : "PUT",
            data : {
                post_id : post_id,
                message : message,
                user_id : user_id,
                _token : token
            },
            success : function(data){
                alertify.success("Retweeted");
                http.loadpost(token);
            }
        })
      },

      deletepost : function(id,token){
        $.ajax({
            url : "deletepost",
            type : "DELETE",
            data :{ 
                postid : id,
                _token : token
            }, success : function(){
                alertify.success('Deleted');
                http.loadpost(token);
            }
        })
      }
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
