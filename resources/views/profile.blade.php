<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='{{asset('js/http.js')}}'></script>
@extends('layouts.app')

@section('content')

<div class='center' style='width:50%' >
<img src="storage/profile_pictures/{{$userinfo[0]->image_url}}"  alt="" height="200px" width="200px" id='picturepreview'>
<h2 >{{$userinfo[0]->firstname}}{{ $userinfo[0]->lastname}}  </h2>
<form id='imageform' method='POST' action="updateimage" enctype='multipart/form-data'>
        {{ csrf_field() }}
<input type='file' id='displaypicture' name='file' style='display:none'>
</form>
<button class='form-control' id='changepicture'>Change Picture</button>
<div id='newbuttons' style='display:none'>
        <button class='btn btn-success' id='confirmchange'>Confirm</button><button class='btn btn-danger ' id='cancelchange' style='margin-left:10px'>Cancel</button>
</button>
</div>
</div>

@endsection





<script>
$(document).ready(function(){

    $(document).on("click","#changepicture",function(){
      $("#displaypicture").click();
    })
    $(document).on("change","#displaypicture",function(){
        var file = this.files[0];
        if(validateAndUpload(file)){
            previewFile(file.files);
            $("#changepicture").css("display","none");
            $("#newbuttons").show();
        }else{
            alertify.error("File type not supported");
        }
    })

    $(document).on("click","#cancelchange",function(){
        $("#changepicture").css("display","block");
        $("#picturepreview").attr("src","storage/profile_pictures/{{$userinfo[0]->image_url}}"); 
        $("#newbuttons").hide();
    })
    $(document).on("click","#confirmchange",function(){
        $("#imageform").submit();
    });
})

function validateAndUpload(input){
    var fileType = input["type"];
    var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, ValidImageTypes) < 0) {
        return false;
    }else{
        return true;
    }
}


function previewFile() {
  var preview = document.querySelector('img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();
  reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    reader.readAsDataURL(file);
  } 
}


</script>



