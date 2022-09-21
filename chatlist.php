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
// print_r($fetch2);

// for get all messages
$active_cht_id = $ids;
$conversation = array();
foreach($active_cht_id as $index=>$id){ 
 $conversation[$index]['usr_id'] = $id;
 $user_id = $id;
// for getting messages 
$sql2 = "SELECT * FROM `chats` WHERE (`from_user` = '$username' && `to_user` = '$user_id') || (`from_user` = '$user_id' && `to_user` = '$username') ORDER BY sno DESC";
$sql2run = mysqli_query($conn ,$sql2);
$fetch2 = mysqli_fetch_all($sql2run, true);
 $conversation[$index]['msg'] = $fetch2;
}
// print_r($conversation);
$chats = $conversation;
$chatlist = '';
foreach($chats as $chat){
    $ch_user = $chat['usr_id'];
    $sql3 ="SELECT * FROM `signupinfo` WHERE `username` = '$ch_user'";
    $sql3run = mysqli_query($conn, $sql3);
 $fetch3 = mysqli_fetch_assoc($sql3run);
    
 $time = date('H:i -(F jS, Y)',strtotime($chat['msg'][0]['time']));
}
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/2.0.2/timeago.min.js" integrity="sha512-sl01o/gVwybF1FNzqO4NDRDNPJDupfN0o2+tMm4K2/nr35FjGlxlvXZ6kK6faa9zhXbnfLIXioHnExuwJdlTMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>chats</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
    <div class="d-flex row-cols-2 ">
    <div class="btn col-3" onclick="history.back()"><i class="fas fa-angle-left"></i></div>
  <h1 class="text-center"><b><strong>Chats</strong></b></h1> 
    </div>
<div class="container col-md-6" id="sample">


</div>


   
<?php include 'footer/footer.php'; ?>
<script src="jquery-3.6.0.js" ></script>
    <script src="custom.js" ></script>
    <script>
$('#sample').load("functions");
setInterval(function(){
    $('#sample').load("functions");
}, 1000);    
    
    </script>
<style>
     .img_profile {
            height: 4em;
            width: 4em;
            object-fit: scale-down;
            background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
            border-radius: 50%;
            /* margin: 0 auto 20px auto; */
            display: block;
            border: 4px solid #F6A62D;
            border-style: solid;

        }
   
            #img_profile {
                height: 3em;
                width: 3em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }

.dot{
    background-color: #F6A62D;
    font-size:xx-small;
    
}
</style>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        </body>

</html>