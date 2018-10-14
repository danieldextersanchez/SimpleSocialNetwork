
@if(sizeof($posts) > 0 )

@for($i=0;$i<sizeof($posts);$i++)
    <?php 
    $newpost = (object)$posts[$i];
    $sharename = $newpost->sharefirst." ". $newpost->sharelast  ;  
    $name = $newpost->firstname." ". $newpost->lastname  ;  
    $shareusername = $posts[$i]->shareuse;
    $username = $posts[$i]->username;
    $post = $newpost->status ;
    $id = $newpost->id; 
    $post_user_id = $newpost->user_id;
    $date =Carbon\Carbon::parse($newpost->created_at)->diffForHumans();
    ?>
    
    @if($newpost->share_user_id == "")
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
       <img height="50px" style='float:left;border-radius:50%;margin-right:10px' src="storage/profile_pictures/{{$newpost->image_url}}">
       <b>{{$name}}</b> @ {{$username}}  {{$date}}<br>
       <div style='display:inline-block;'>
        <p style='word-break: break-all; '><?php echo nl2br($post); ?></p>
       </div>
       </div>
    </div>
    @else
    <div class='well postedpost pointer' style='background-color:#FFFFFF' >
            <div class='floatright postactions' value='{{$id}}' style='display:none'>            
                @if(Auth::id() == $newpost->share_user_id  )
               <i class="material-icons deleteshare pointer" value='{{$newpost->share_id}}'>
                    delete_outline
                </i>
                @endif
               </div>
               
               <div class='postcontent' style='min-height:50px' >
               
               <b><i class="material-icons" style='font-size:15px;margin-right:5px'>compare_arrows</i>{{$name}}</b>   Retweeted<br>
               <div style='margin-left:20px'>{{$newpost->message}}</div><hr>
               <div style='min-height:50px'>
               <img height="50px" style='float:left;border-radius:50%;margin-right:10px' src="storage/profile_pictures/{{$newpost->image_url}}">
               <b>{{$sharename}}</b> @ {{$shareusername}}  {{$newpost->post_created_at}}<br>
               {{$post}}
               </div>
               </div>
            </div>
      
    @endif
  @endfor
  @else 
  <div class='center' style='margin-top:100px'><h3>There are no posts</h3></div>
  @endif