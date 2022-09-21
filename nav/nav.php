<?php
include 'dbconn/dbconn.php';
include 'session/ss.php';
$username = $_SESSION['username'];
$querry6 ="SELECT * FROM `notifications` WHERE username = '$username' ORDER bY `sno` DESC  ";
$querry6fire = mysqli_query($conn, $querry6);
$num6 = mysqli_num_rows($querry6fire);
$fetch6 = mysqli_fetch_assoc($querry6fire);
if($num6 > 0){
    if($fetch6['status']== 'unseen'){
        $_SESSION['unseen'] = true ;
    }else{
        unset( $_SESSION['unseen']);
    }
}


?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/21a4a21a84.js" crossorigin="anonymous"></script>
<nav class="navbar   desktop d-none d-lg-block ">
    <div class="container-fluid ">
        <a class="navbar-brand" style="text-decoration: none; color:whitesmoke;" href="index"> <img style="width:135px" src="nav/talent-vale-logo.webp" alt="" srcset=""></b></a>

        <ul class="navbar-nav d-flex flex-row  mb-2 mb-lg-0">

            <li class="nav-item me-4">
                <a class="nav-link active" aria-current="page" href="index"><i class="fas fa-home m-1 " style="color:black;"></i></a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link active" aria-current="page" href="eventlist"><i class="fas fa-bullhorn"  style="color:black;"></i></a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link active" aria-current="page" href="leaderboard"><i class="fas fa-chart-bar" style="color:black;"></i></a>
            </li>
            <li class="nav-item  me-4">
                <span style="color:black; top:3px; right:185px; font-size:x-small "  class="position-absolute badge1 p-2 rounded-pill bg-light"></span>
                <a class="nav-link position-relative" aria-current="page" href="chatlist"><i class="fas fa-comment-dots"  style="color:black;"></i></a>
                
          
            </li>

            <li class="nav-item me-4 " data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <a class="nav-link position-relative" href="#"><img src="nav/Alert@2x.png" alt="notification">
                    <?php  if(isset($_SESSION['unseen']) && $_SESSION['unseen']==true){
            echo ' <span style="color:black;" class="position-absolute top-4 start-100 translate-middle badge p-2 rounded-pill bg-light">          
!

                    <span class="visually-hidden">unread messages</span>
                </span>';
          } ?>
                </a>
               <!-- Modal -->
<div class="modal  " id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b><strong>Notification</strong></b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column justify-content-center ">
          <?php
          if($num6 != 0){
          foreach($querry6fire as $fetch6){
              $nsn = $fetch6['sno'];
            $string = $fetch6['message'];        
            if (strlen($string) > 25){
               $new_string = substr($string, 0, 25) . '...';
               if($fetch6['status'] == 'unseen'){
                ?>
                <div class="container border  m-0" style="background-color:aquamarine ;">
                   <span><strong>DATE & TIME</strong></span> <p><?php echo $fetch6['time'];?></p>
                    <h4><?php echo ($new_string . "\n"); ?><br><a href="noti?id=<?php echo $nsn ?>">view more</a></h4>
                </div>
                <?php
              }else{
                 ?>
                 <div class="container border  m-0" >
                    <span><strong>DATE & TIME</strong></span> <p><?php echo $fetch6['time'];?></p>
                     <h4><?php echo ($new_string . "\n"); ?><br><a href="noti?id=<?php echo $nsn ?>">view more</a></h4>
                 </div>
                 <?php
              }
              }  
            }
        }else{
            echo 'no notifications yet';
        }
            ?>
      </div>
    
    </div>
  </div>
</div>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="search"><img src="nav/Search@2x.png" alt="search"></a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="settings"><i class="fa fa-gear" style="color:black;"></i></a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link position-relative" href="profile?id = profile"><img src="nav/Profile@2x.png"
                        alt="profile"><?php
          if(isset($_SESSION['empty']) && $_SESSION['empty']==true){
            echo ' <span style="color:black;" class="position-absolute top-4 start-100 translate-middle rounded-pill bg-light">
                    !
                </span>';
          } ?> </a>
            </li>
            <?php
         if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']==true ){
           echo '
           <li class="nav-item me-4">
          <a class="nav-link"  href="admin"><i class="fa fa-screwdriver" style="color:black;"></i></a>
          </li>
          
          '; }
      
        ?>

        </ul>
        <!-- </div> -->
    </div>
</nav>
<!------------------------ mobile view  ------------------------------------------------->
<nav class="navbar  d-lg-none">
    <div class="container-fluid m-0  ">
        <a class="navbar-brand m-0 p-0"  style="text-decoration: none; color:whitesmoke;"  href="index"><img style="width:160px" src="nav/talent vale logo.png" alt="" srcset=""></a>
        <ul class="navbar-nav d-flex flex-row ">

            <li class="nav-item m-0 p-0">
                <a class="nav-link m-0 p-0 me-3" href="add"><img src="nav/Add@2x.png" alt=""></a>
            </li>
            <li class="nav-item m-0 p-0">
                <a class="nav-link  m-0 p-0  me-3 " aria-current="page" href="eventlist"><i class="fas fa-bullhorn"  style="color:black;"></i></a>
            </li>
            <li class="nav-item m-0 p-0">
            <span style="color:black; top:3px; right:65px; font-size:x-small "  class="position-absolute badge1 p-1 rounded-pill bg-light"></span>
                <a class="nav-link position-relative  m-0 p-0  me-3" aria-current="page" href="chatlist"><i class="fas fa-comment-dots"  style="color:black;"></i></a>
            </li>
            <li class="nav-item m-0 p-0">
                <a class="nav-link  m-0 p-0  me-3 " aria-current="page" href="leaderboard"><i class="fas fa-chart-bar" style="color:black;"></i></a>
            </li>
            <li class="nav-item m-0 p-0">
                <a class="nav-link position-relative m-0 p-0" style="text-decoration:none; color:black;"
                    aria-current="page" href="profile"><img src="nav/Profile@2x.png" alt="">
                    <?php
          if(isset($_SESSION['empty']) && $_SESSION['empty']==true){
          echo '<span style="color:black;" class="position-absolute top-4 start-100 translate-middle badge rounded-pill bg-light">
          !
          <span class="visually-hidden">unread messages</span>
      </span>';
           } ?></a>
            </li>
        </ul>
    </div>


</nav>
<script src="jquery-3.6.0.js" ></script>

<script>
    function getcount() {
       
    $.ajax({
    url: 'ajax?getcount',
    method: 'POST',
    dataType: 'json',  
    success: function (response) {
// console.log(response);  
if(response == 0){
    $(".badge1").hide();
}else{
   $(".badge1").html(response);
   $(".badge1").show();
}
    }
    });
}
getcount();

setInterval(() => {
getcount();

}, 1000);
</script>
<style>
.navbar {
    background: #fc4a1a;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #f7b733, #fc4a1a);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

#count {
    background: yellow;
    border-radius: 50%;
    padding: 4px;
    position: relative;
    top: -8px;
    right: 4px;
    font-size: 8px;

}


@media only screen and (max-width: 1200px) {}
</style>