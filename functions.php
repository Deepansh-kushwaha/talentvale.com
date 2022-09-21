
   <?php  
   include 'dbconn/dbconn.php';
   include 'session/ssr.php';
   error_reporting(0);
   
   $username = $_SESSION['username'];
 // for active chat ids 
$sql = "SELECT `from_user` ,`to_user` FROM `chats` WHERE `from_user` = '$username' OR `to_user` = '$username' ORDER BY sno DESC";
$sqlrun = mysqli_query($conn ,$sql);
$fetch=  mysqli_fetch_all($sqlrun, true);
$ids = array();
// echo "<pre>";
// print_r($fetch);
foreach($fetch as $ch){
if($ch['from_user']!=$username && !in_array($ch['from_user'],$ids)){
$ids[]=$ch['from_user'];
} 
if($ch['to_user']!=$username && !in_array($ch['to_user'],$ids)){
$ids[]=$ch['to_user'];
} 
}

// print_r($ids);       
// $user_id = "testkumar";
// // for getting messages 
// $sql2 = "SELECT * FROM `chats` WHERE (`from_user` = '$username' && `to_user` = '$user_id') || (`from_user` = '$user_id' && `to_user` = '$username') ORDER BY sno DESC";
// $sql2run = mysqli_query($conn ,$sql2);
// $fetch2 = mysqli_fetch_all($sql2run, true);
// echo "<pre>";
// print_r($ids);

// for get all messages
$active_cht_id = $ids;
$conversation = array();
foreach($active_cht_id as $index=>$id){ 
    $conversation[$index]['usr_id'] = $id;
    $user_id = $id;
// for getting messages 
$sql2 = "SELECT * FROM `chats` WHERE `from_user` = '$user_id' && `to_user` = '$username' ORDER BY sno DESC";
$sql2run = mysqli_query($conn ,$sql2);
$fetch2 = mysqli_fetch_all($sql2run, true);
    $conversation[$index]['msg'] = $fetch2;
}
$chats = $conversation;
// print_r($chats);

if($chats[0]['usr_id'] != ""){
   foreach($chats as $chat){
       $ch_user = $chat['usr_id'];
       $sql3 ="SELECT * FROM `signupinfo` WHERE `username` = '$ch_user'";
       $sql3run = mysqli_query($conn, $sql3);
    $fetch3 = mysqli_fetch_assoc($sql3run);
       
    $time = date('H:i -(F jS, Y)',strtotime($chat['msg'][0]['time']));
    $sql2 = "SELECT * FROM `chats` WHERE `from_user` = '$ch_user' && `to_user` = '$username' && read_status = 0";
$sql2run = mysqli_query($conn ,$sql2);
$fetch2 = mysqli_num_rows($sql2run);

// echo strlen($chat['msg'][0]['msg']);
if(strlen($chat['msg'][0]['msg']) > 15){
$new_str = substr($chat['msg'][0]['msg'], 0, 15) . "...";
}else{
    $new_str = $chat['msg'][0]['msg']; 
}

   ?>
   
   <div class="container p-0  chatlist_item" onclick="window.location='https://talentvale.com/chat?u=<?=$fetch3['username']?>'" >
  
       <div class=" d-flex    border  justify-content-center m-0 p-0" style="border-radius: 10px;">

                                   <div class="container col-3 d-flex justify-content-center align-items-center p-0  ">
                                       <a href="vprofile?id=<?=$fetch3['username']?>"><?php
                                                                                                    if ($fetch3['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $fetch3['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                       </a>
                                   </div>
                                   <div class="container d-flex flex-column  justify-content-start align-items-start text-start m-0 p-0">
                                       <div class="d-flex">
                                           <div class="container m-0 p-0"><small class="m-0"><strong><b><?= $fetch3['firstname']?></b></strong></small>
                                           </div>
                                           <div class="container m-0 ps-1 p-0"><small class="m-0"><strong><b><?=$fetch3['lastname'] ?></b></strong></small>
                                           </div>
                                           </div>
                                    
                                           <small class="<?=$chat['msg'][0]['read_status']?'text-muted':''?>" ><b><?=$new_str?></b></small>
                                           <small class="timeago <?=$chat['msg'][0]['read_status']?'text-muted':''?>" ><b><?= $time?></b></small>
                                   </div>
                                   <?php
                                   if($fetch2 > 0){
                                   ?>
                               <div class=" container m-0 p-0 col-1 d-flex justify-content-center align-items-center">
                               <span class="dot p-1 rounded-circle" style=""><?=$fetch2?></span>
                               </div>
                               <?php
                                   }
                               ?>
                               </div>
                            
       </div>
       <?php
   }
}else{
    echo '<div class="container-fluid p-0  d-inline-block text-center">
       <h5>Find someone to chat with <a href="search" >click here</a></h5> 
    </div>';
}

   ?>