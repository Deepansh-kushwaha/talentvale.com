<?php
require 'dbconn/dbconn.php';
require 'session/ssr.php';
$username = $_SESSION['username'];
// for follow
if(isset($_GET['follow'])){
    
    $u_n = $_POST['user_id'];
    $sql = "SELECT * FROM `follow` WHERE `follower_name` = '$username'";
    $sqlrun = mysqli_query($conn , $sql);
    $fetch = mysqli_fetch_assoc($sqlrun);
    if($fetch['user_name'] != $u_n ){
    $querry13 = "INSERT INTO `follow` (`follower_name`, `user_name`) value ('$username' , '$u_n') ";
    $querry13fire =mysqli_query($conn, $querry13);
    if($querry13fire){
        $response['status']= true ;
     }else{
        $response['status']= false;
     }
    echo json_encode($response);
}
}

// for unfollow 
if(isset($_GET['unfollow'])){
    $u_nn = $_POST['user_id_U'];
    $sql2 = "SELECT * FROM `follow` WHERE `follower_name` = '$username'";
    $sql2run = mysqli_query($conn , $sql2);
    $fetch2 = mysqli_fetch_assoc($sql2run);
    if($fetch2['user_name'] = $u_nn && $fetch2['follower_name'] = $username ){
    $querry14 = "DELETE FROM `follow` WHERE `follower_name` = '$username' && `user_name`= '$u_nn'  ";
    $querry14fire = mysqli_query($conn, $querry14);
    if($querry14fire){
        $response['status']= true ;
     }else{
        $response['status']= false;
     }
    echo json_encode($response);
}
}


if(isset($_GET['liked'])){

    $likeid = $_POST['user_id_l'];

      $querry15 = "INSERT INTO `likes`(`user`,`post_no`) VALUES ('$username','$likeid')";
      $querry15fire = mysqli_query($conn, $querry15);
      if($querry15fire){
         // for geting no of likes 
$sql3 = "SELECT * FROM `likes` WHERE `post_no` = $likeid ";
$sql3run = mysqli_query($conn, $sql3);
$num3row = mysqli_num_rows($sql3run);
// for updating likes no 
$sql5 = "UPDATE `posts` SET `likes`='$num3row' WHERE sno = $likeid";
$sql5run = mysqli_query($conn, $sql5);
if($sql5run){
          $response['status']= true;
}else{
   $response['status']= false;
}
       }else{
          $response['status']= false;
       }
      echo json_encode($response);  
    
}

if(isset($_GET['unliked'])){

    $dlikeid = $_POST['user_id_l'];

      $querry16 = "DELETE FROM `likes` WHERE user ='$username' && post_no = $dlikeid ";
      $querry16fire = mysqli_query($conn, $querry16);
      if($querry16fire){
         // for geting no of likes 
      $sql3 = "SELECT * FROM `likes` WHERE `post_no` = $dlikeid";
      $sql3run = mysqli_query($conn, $sql3);
      $num3row = mysqli_num_rows($sql3run);
      // for updating likes no 
      $sql5 = "UPDATE `posts` SET `likes`='$num3row' WHERE sno = $dlikeid";
      $sql5run = mysqli_query($conn, $sql5);
      if($sql5run){
               $response['status']= true;
      }else{
         $response['status']= false;
      }
       }else{
          $response['status']= false;
       }
      echo json_encode($response);  
    
}

if(isset($_GET['vote'])){

   $voteid = $_POST['user_id_v'];

     $querry15 = "INSERT INTO `vote`(`user`,`post_no`) VALUES ('$username','$voteid')";
     $querry15fire = mysqli_query($conn, $querry15);
     if($querry15fire){
         $response['status']= true;
      }else{
         $response['status']= false;
      }
     echo json_encode($response);  
   
}
if(isset($_GET['unvote'])){

   $unvoteid = $_POST['user_id_v'];

     $querry16 = "DELETE FROM `vote` WHERE user ='$username' && post_no = $unvoteid ";
     $querry16fire = mysqli_query($conn, $querry16);
     if($querry16fire){
         $response['status']= true;
      }else{
         $response['status']= false;
      }
     echo json_encode($response);  
   
}
if(isset($_POST['uptext'])){
    $tex = $_POST['textpost'];
    $sql17 = "INSERT INTO `posts`( `username`, `text`) VALUES ('$username','$tex')";
    $sql17run = mysqli_query($conn, $sql17);
    if($sql17run){
      $added = true;
      $_SESSION['added']=true;
       header("location:index");
    }
}


if (isset($_POST['delpos'])){
  $posid = $_POST['posd'];
$querry2 = "SELECT * FROM `posts` WHERE sno =$posid";
$querry2fire = mysqli_query($conn, $querry2);
$fetch3 = mysqli_fetch_assoc($querry2fire);
   if(file_exists($fetch3['postimg'])){
   $pimg = $_POST['delimg'];
   $querry3 = "DELETE FROM `posts` WHERE sno = '$posid'";
   $querry3fire = mysqli_query($conn, $querry3);
   if ($querry3fire) {
       unlink($pimg);
      //  for deleting likes after post delete
       $querry16 = "DELETE FROM `likes` WHERE post_no = $posid ";
       $querry16fire = mysqli_query($conn, $querry16);
       if($querry16fire){
         // for deleting of comments associated to posts 
         $sql19 = "DELETE FROM `comment` WHERE pst_id = $posid";
         $sql19run = mysqli_query($conn, $sql19);
         if($sql19run){
            // for deleting of vote associated to post
            $querry12 = "DELETE FROM `vote` WHERE post_no = $posid";
            $querry12fire = mysqli_query($conn, $querry12);
         }
         }
       $_SESSION['pstdel'] = true;
       header("location:index");
   } else {
       $_SESSION['pstdel'] = false;
       header("location:index");
   }
}else{
   $pimg = $_POST['delimg'];
   $querry3 = "DELETE FROM `posts` WHERE sno = '$posid'";
   $querry3fire = mysqli_query($conn, $querry3);
   if ($querry3fire) {
      //  for deleting likes after post delete
      $querry16 = "DELETE FROM `likes` WHERE user ='$username' && post_no = $posid ";
      $querry16fire = mysqli_query($conn, $querry16);
      if($querry16fire){
      // for deleting of comments associated to post
      $sql19 = "DELETE FROM `comment` WHERE pst_id = $posid";
      $sql19run = mysqli_query($conn, $sql19);
      if($sql19run){
         // for deleting of vote associated to post
         $querry12 = "DELETE FROM `vote` WHERE post_no = $posid";
         $querry12fire = mysqli_query($conn, $querry12);
      }
      }
      $_SESSION['pstdel'] = true;
      header("location:index");
   } else {
      $_SESSION['pstdel'] = false;
      header("location:index");
  }
}
}


if(isset($_GET['addcomment'])){
   $msg = $_POST['comment'] ;
   $psi = $_POST['post_id'];
   $sql19 = "INSERT INTO `comment`( `user_id`,`pst_id`, `msg`) VALUES ('$username','$psi','$msg')";
   $sql19run = mysqli_query($conn, $sql19);
   if($sql19run){
      $response['status']= true ;
   }else{
      $response['status']= false ;
   }
   echo json_encode($response);  
}
if(isset($_POST['delcmt'])){
   $psi = $_POST['delcmt'];
   $sql19 = "DELETE FROM `comment` WHERE `user_id` ='$username' && `pst_id` = $psi";
   $sql19run = mysqli_query($conn, $sql19);
   if($sql19run){
      $_SESSION['cmtdel'] = true;
      header("location:comments?id=$psi");
   }else{
      $_SESSION['cmtdel'] = false;
      header("location:comments?id=$psi");
   }  
}




// for getting mssages list 

if(isset($_GET['getmessages'])){
   $user_id =$_POST['chatter_id'];
//  for getting messages 
$sql2 = "SELECT * FROM `chats` WHERE (`from_user` = '$username' && `to_user` = '$user_id') OR (`from_user` = '$user_id' && `to_user` = '$username') ORDER BY sno DESC ";
$sql2run = mysqli_query($conn ,$sql2);
$fetch2 = mysqli_fetch_all($sql2run, true);
foreach($sql2run as $fetch2){
// echo "<pre>";
// print_r($fetch2);
$sql4 = "UPDATE `chats` SET `read_status`='1' WHERE `from_user` = '$user_id' && `to_user` = '$username'";
$sql4run = mysqli_query($conn, $sql4);
if($fetch2['from_user'] == $username){
    $cl1 = 'align-self-end bg-warning text-light';
    $cl2 = 'text-light text-muted';
}else{
    $cl1 = 'align-self-start ';
    $cl2 = 'text-muted';
}
$time = date('H:i -(F jS, Y)',strtotime($fetch2['time']));
$chatmsg[]='
       <div class="p-3 m-1  d-inline-block shadow-lg col-10 '.$cl1.'" style="border-radius:50px 50px 50px 50px;">
      <b><strong  style="font-size:medium">  '.$fetch2['msg'].'</strong> </b><br>
        <span style="font-size:x-small" class="d-inline-block '.$cl2.'">'. $time.'</span>
       </div>

   

</div>
';
}
$json['chat']['msgs'] = $chatmsg;  
echo json_encode($json);
}

// for sending message 
if(isset($_GET['sendmessages'])){
$user_id = $_POST['user_id'];   
$text = $_POST['text'];
// $newtext = wordwrap($text, 30, "<br />\n");
$sql = "INSERT INTO `chats`(`from_user`, `to_user`, `msg`) VALUES ('$username','$user_id','$text')";
$sqlrun = mysqli_query($conn , $sql);
if($sqlrun){
   $response['status']= true ;
}else{
   $response['status']= false ;
}
echo json_encode($response);  
}

if(isset($_GET['getcount'])){

   $sql2 = "SELECT * FROM `chats` WHERE `to_user` = '$username' && read_status = 0";
   $sql2run = mysqli_query($conn ,$sql2);
   $fetch2 = mysqli_num_rows($sql2run);
   if($sql2run){
      $response['status']= true ;
      $response = $fetch2;
   }else{
      $response['status']= false ;
   }
   echo json_encode($response);  
}


?>    