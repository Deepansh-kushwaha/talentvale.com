<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
$username = $_SESSION['username'];
$sql6 ="SELECT * FROM `signupinfo` WHERE `username` = '$username' ";
$sql6run = mysqli_query($conn, $sql6);
$fetch6sql= mysqli_fetch_assoc($sql6run);
$mail = $fetch6sql['email'];
// for deleting user 
if(isset($_POST['user_delete'])){
    $user_id = $_POST['user_delete'];
    $usrnfdp = $_POST['usrnfdp'];
    $querry2 = "DELETE FROM `signupinfo` WHERE sno = '$user_id'";
$querry2fire = mysqli_query($conn , $querry2);
if($querry2fire){
    $sql2= "DELETE FROM `posts` WHERE username = '$usrnfdp' ";
    $sql2run =mysqli_query($conn,$sql2);
    if($sql2run){
   header("location:admin?id=deleted");
    }
}else{
    header("location:admin?id=unsuccessful");
}
}
// for blocking user 
if(isset($_POST['user_block'])){
    $user_id = $_POST['user_block'];
    // $usrnfdp = $_POST['usrnfdp'];
    $querry2 = "UPDATE `signupinfo` SET `userstat`='inactive' WHERE sno = '$user_id'";
$querry2fire = mysqli_query($conn , $querry2);
if($querry2fire){
   
   header("location:admin?id=blocked");
   
}else{
    header("location:admin?id=unblocked");
}
}
// for unblocking user
if(isset($_POST['user_unblock'])){
    $user_id = $_POST['user_unblock'];
    // $usrnfdp = $_POST['usrnfdp'];
    $querry2 = "UPDATE `signupinfo` SET `userstat`='active' WHERE sno = '$user_id'";
$querry2fire = mysqli_query($conn , $querry2);
if($querry2fire){
   
   header("location:admin?id=unblocked");
   
}else{
    header("location:admin?id=blocked");
}
}

// for deleting post
if (isset($_POST['post_delete'])) {
    $pimg = $_POST['delimg'];
    if(file_exists($pimg)){
       
    $user_id = $_POST['post_delete'];
    $querry3 = "DELETE FROM `posts` WHERE sno = '$user_id'";
    $querry3fire = mysqli_query($conn, $querry3);
    if ($querry3fire) {
        unlink($pimg);
        //  for deleting likes after post delete
       $querry16 = "DELETE FROM `likes` WHERE post_no = $user_id ";
       $querry16fire = mysqli_query($conn, $querry16);
       if($querry16fire){
         // for deleting of comments associated to posts 
         $sql19 = "DELETE FROM `comment` WHERE pst_id = $user_id";
         $sql19run = mysqli_query($conn, $sql19);
         if($sql19run){
            // for deleting of vote associated to post
            $querry12 = "DELETE FROM `vote` WHERE post_no = $user_id";
            $querry12fire = mysqli_query($conn, $querry12);
         }
         }
        header("location:admin?id=imgsuccessful");
    } else {
        header("location:admin?id=imgunsuccessful");
    }
}
}

// for role manegement

if(isset($_POST['admi'])){
    $user_name = $_POST['name'];
    $querry = "UPDATE `signupinfo` SET `role` = 1 WHERE username = '$user_name'";
    $querryfire = mysqli_query($conn,$querry);
    if($querryfire){
        header("location:admin?id=admi");
    }else{
        header("location:admin?id=notadmi");
}
}
if(isset($_POST['user'])){
    $user_handel = $_POST['name'];
    $querry3 = "UPDATE `signupinfo` SET `role` = 0 WHERE username = '$user_handel'";
    $querry3fire = mysqli_query($conn, $querry3);
    if($querry3fire){
        header("location:admin?id=user");
    }else{
        header("location:admin?id=notuser");
}
}
// for sending notification
if(isset($_POST['sndnoti'])){
    $nusr= $_POST['nusr'];
    $notitext= $_POST['notitext'];
    $querry5 = "INSERT INTO `notifications`(`username`, `message`) VALUES ('$nusr','$notitext')";
    $querry5fire = mysqli_query($conn, $querry5);
    if($querry5fire){
        header("location:admin?id=sended");
    }else{
        header("location:admin?id=notsend");
}
}
if(isset($_POST['sndnoti2'])){
    $sql6="SELECT username FROM `signupinfo`";
    $sql6run = mysqli_query($conn,$sql6);
    foreach($sql6run as $fe){
     $nusr2 = $fe['username']  ; 
    $notitext2= $_POST['notitext2'];
    $querry5 = "INSERT INTO `notifications`(`username`, `message`) VALUES ('$nusr2','$notitext2')";
    $querry5fire = mysqli_query($conn, $querry5);
    }
    if($querry5fire){
        header("location:admin?id=sended");
    }else{
        header("location:admin?id=notsend");
}
}
// for adding event
if(isset($_POST['addeve'])){

     $evena = $_POST['evena']  ; 
     $eveli = $_POST['eveli']  ; 
    $evetext= $_POST['evetext'];
    $sttime= $_POST['dtime'];
    $querry8 = "INSERT INTO `events`( `event_name`, `event_message`, `event_link`,`st_time`) VALUES ('$evena','$evetext','$eveli','$sttime')";
    $querry8fire = mysqli_query($conn, $querry8);
    if($querry8fire){
        header("location:admin?id=eve");
    }else{
        header("location:admin?id=noteve");
}
}
// for deleting notification
if(isset($_POST['noti_del'])){
    $user_id = $_POST['noti_del'];
    $querry2 = "DELETE FROM `notifications` WHERE sno = '$user_id'";
$querry2fire = mysqli_query($conn , $querry2);
if($querry2fire){
   header("location:admin?id=deleted2");
    }  else{
        header("location:admin?id=unsuccessful2");
    }
}

// for deleting events
if(isset($_POST['eve_del'])){
    $user_id = $_POST['eve_del'];
    $querry2 = "DELETE FROM `events` WHERE sno = '$user_id'";
$querry2fire = mysqli_query($conn , $querry2);
    $querry4 = "DELETE FROM `user_eve_regis` WHERE eve_name = '$user_id'";
$querry4fire = mysqli_query($conn , $querry4);
if($querry2fire){
   header("location:admin?id=deleted3");
    }
    else{
        header("location:admin?id=unsuccessful3");
    }
}

// for ending event
if(isset($_POST['eve_end'])){
    $eveid = $_POST['eve_end'];
    $querry3 = "UPDATE `events` SET `event_status` = 'Ended' WHERE sno = $eveid";
    $querry3fire = mysqli_query($conn, $querry3);
    if($querry3fire){
        header("location:admin?id=eveended");
    }else{
        header("location:admin?id=notended");
}
}
// for resuming event 
if(isset($_POST['eve_res'])){
    $eveid = $_POST['eve_res'];
    $querry3 = "UPDATE `events` SET `event_status` = 'Running' WHERE sno = $eveid";
    $querry3fire = mysqli_query($conn, $querry3);
    if($querry3fire){
        header("location:admin?id=everesumed");
    }else{
        header("location:admin?id=notresumed");
}
}

// for registering user in events 
if(isset($_POST['regisuser'])){
    $eveid = $_GET['id'];
    $umail = $_POST['email']  ; 
    $ename = $_POST['evename']  ; 
    if($umail == $mail){
   $querry8 = "INSERT INTO `user_eve_regis`( `eve_name`, `user_mail`) VALUES ('$ename', '$umail')";
   $querry8fire = mysqli_query($conn, $querry8);
   if($querry8fire){
       header("location:evregis?e=$eveid");
   }else{
       header("location:evregis?e=$eveid");
}
    }else{
        header("location:evregis?id=notuser&e=$eveid");
    }
}

// editing posts 
if(isset($_POST['edpst'])){
    $name = $_POST['name'];
    $desc = $_POST['description'];  
    $tags = $_POST['tags'];
    $cat = $_POST['category'];
    $tmem = $_POST['teammember'];
    if(($desc == "") && ($tags == "") && ($cat == "") && ($tmem == "")){
        header("location:vprofile?e=pstpup&id=$username");
    }else{
    $querry3 = "UPDATE `posts` SET `description`='$desc',`tags`='$tags',`category`='$cat',`teammembers`='$tmem',`date`='[value-9]'WHERE sno = $name";
    $querry3fire = mysqli_query($conn, $querry3);
    if($querry3fire){
        header("location:vprofile?e=pstup&id=$username");
    }else{
        header("location:vprofile?e=pstnup&id=$username");
    }
}
}

?>