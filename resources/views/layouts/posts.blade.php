
@if(sizeof($posts) > 0 )

@for($i=0;$i<sizeof($posts);$i++)
    <?php 
    $posts[$i] = (object)$posts[$i];
    $name = $posts[$i]->firstname." ". $posts[$i]->lastname  ;  
    $post = $posts[$i]->status ;
    $id = $posts[$i]->id;
    $username = $posts[$i]->username; 
    $post_user_id = $posts[$i]->user_id;
    $date =Carbon\Carbon::parse($posts[$i]->created_at)->diffForHumans();
    ?>
    <div class='well postedpost pointer' style='background-color:#FFFFFF' >
    <div class='floatright postactions' value='{{$id}}' style='display:none'>
    <i data-1 ="{{$id}}"  data-2 ="{{$post_user_id}}" class='material-icons share pointer' >
        reply
        </i><br>
        @if(Auth::id() == $post_user_id  )
       <i class="material-icons deletepost pointer" value='{{$id}}'>
            delete_outline
        </i>
        @endif
       </div>
       
       <div class='postcontent' style='min-height:50px' >
       <img height="50px" style='float:left;border-radius:50%;margin-right:10px' src="storage/profile_pictures/{{$posts[$i]->image_url}}">
       <b>{{$name}}</b> @ {{$username}}  {{$date}}<br>
       {{$post}}
       </div>
    </div>
  @endfor
  @else 
  <div class='center' style='margin-top:100px'><h3>There are no posts</h3></div>
  @endif