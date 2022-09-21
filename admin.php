<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
ob_start();
error_reporting(0);
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){     
    if (!isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == true) {
        header("loction:login?id=notadmin");
    }
}else{
    header("loction:login?id=notadmin");
}
$username = $_SESSION['username'];
$querry = "SELECT * FROM `signupinfo` WHERE 1";
$querryfire = mysqli_query($conn, $querry);
$querry2 = "SELECT * FROM `posts` WHERE 1";
$querry2fire = mysqli_query($conn, $querry2);
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <title>Admins space</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
    <?php
    $deleted = $_GET['id'];
    if ($deleted == "deleted") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> User Account is Deleted .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "deleted2") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> User notification is Deleted .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "deleted3") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> Event is Deleted .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "sended") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> Notification is Sended.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "eve") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> Event is added.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "imgsuccessful") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> Post is deleted.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "eveended") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>success</strong> Event is ended.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "everesumed") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> Event is resumed.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "blocked") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success</strong> user Blocked.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($deleted == "unblocked") {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>success</strong> user Unblocked.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    $user_name = $_GET['id'];
    if ( $user_name == "admi") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> New Admin Added.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ( $user_name == "notadmi") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Unsuccessfull</strong> Already An Admin.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
$user_handel = $_GET['id'];
    if ( $user_handel == "user") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong>  Admin Removed.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ( $user_handel == "notuser") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Unsuccessfull</strong>  Already An User.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <h1 class="text-center"><b><strong>Admin Pannel</strong></b></h1>

    <div class="container">
        <div class="container d-flex justify-content-center">

            <ul class="pagination">

                <li class="page-item "> <button class="btn btn-danger m-4" id="btn"> Users</button></li>
                <li class="page-item "> <button class="btn btn-danger m-4" id="btn2"> Users Post</button></li>
                <li class="page-item "> <button class="btn btn-danger m-4" id="btn3"> Role Mgr</button></li>
                <li class="page-item "> <button class="btn btn-danger m-4" id="btn4"> Send Noti</button></li>
                <li class="page-item "> <button class="btn btn-danger m-4" id="btn5"> Add Event</button></li>


            </ul>
        </div>
        <!-- ----------------users /box -------------------------------------->
        <div class="container-fluid" id="box">
            <table class="table table-hover  table-striped">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Email</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Date & Time Of Joining</th>
                        <th scope="col">Block user</th>
                        <th scope="col">DELETE USER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($num = mysqli_num_rows($querryfire) > 0) {
                        while ($fetch = mysqli_fetch_assoc($querryfire)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $fetch['sno']; ?></th>
                                <td><?php echo $fetch['firstname'] ;?></td>
                                <td><?php echo $fetch['lastname']; ?></td>
                                <td><?php echo $fetch['username']; ?></td>
                                <td><?php echo $fetch['email']; ?></td>
                                <td>       <a href="vprofile?id=<?php echo $fetch['username']; ?>"><?php
                                                                                                    if ($fetch['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $fetch['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                   </td>
                                <td><?php echo $fetch['date']; ?> </td>
                                <td class="m-auto">
                                <?php
                                if($fetch['userstat'] == "active"){
                                ?>
                                    <form action="deluser" method="POST">
                                      
                                        <button class="btn btn-info" name="user_block" id="" value="<?php echo $fetch['sno']; ?>">Block</button>


                                    </form>
                                    <?php
                                }else{
                                    ?>
                                       <form action="deluser" method="POST">
                                      
                                      <button class="btn btn-warning" name="user_unblock" id="" value="<?php echo $fetch['sno']; ?>">Unblock</button>


                                  </form>
                                  <?php
                                }
                                    ?>
                                </td>
                                <td class="m-auto">
                                    <form action="deluser" method="POST">
                                        <input type="hidden" name="usrnfdp" value="<?php echo $fetch['username'] ;?>">
                                        <button class="btn btn-danger" name="user_delete" id="" value="<?php echo $fetch['sno']; ?>">Delete User</button>


                                    </form>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!----------------posts box  --------------------------------------->
        <div class="container-fluid" id="box2">
            <table class="table table-hover  table-striped">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Description</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Category</th>
                        <th scope="col">Team Members</th>
                        <th scope="col">Date & Time Of posting</th>
                        <th scope="col">DELETE USER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($num = mysqli_num_rows($querry2fire) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($querry2fire)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $fetch2['sno'] ?></th>
                                <td><?php echo $fetch2['username'] ?></td>
                                <td><img id="img_profile" src="<?php echo $fetch2['postimg'] ?>" alt="photo unavailable"></td>
                                <td><?php echo $fetch2['description'] ?></td>
                                <td><?php echo $fetch2['tags'] ?></td>
                                <td><?php echo $fetch2['category'] ?></td>
                                <td><?php echo $fetch2['teammember'] ?></td>
                                <td><?php echo $fetch2['post_time'] ?> </td>
                                <td class="m-auto">
                                    <form action="deluser" method="POST">
                                        <input type="hidden" name="delimg" value="<?php echo $fetch2['postimg'] ?>">
                                        <button class="btn btn-danger" name="post_delete" value="<?php echo $fetch2['sno'] ?>">Delete post</button>
                                    </form>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            ?>
        </div>
        <!---------------------role mgr  ------------------------------------->
        <div class="container-fluid" id="box3">
            <?php
            $querry4 = "SELECT `role` FROM `signupinfo` WHERE `role` = 1";
            $querry4fire = mysqli_query($conn, $querry4);
            $num1 = mysqli_num_rows($querry4fire);
            ?>
            <div class="cotainer text-center">
                <h3><?php echo "$num1"?></h3>
                <h4>No Of Admins</h4>
            </div>
            <div class="container d-flex justify-content-center ">
                <form class="form-floating mb-3" action="deluser" method="POST">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Enter username " required>
                 <label for="floatingInput">Enter username </label>
                 <button name="admi" class="btn btn-danger m-4" >Make Admin </button>
                 <button name="user" class="btn btn-danger m-4" >Make User</button>
                </form>
            </div>
            <?php

   
    ?>
            </div>

            <!-------------send noti  --------------------------------------------------------->
            <div class="container-fluid mb-4" id="box4">
                <h5 class="text-center mt-3">send notifications to single user at a time</h5>
            <div class="container col-6">
                <form action="deluser" method="POST" class="form-group">
                    <input class="form-control" type="text" name="nusr" id="nusr" placeholder="user name to send noti" style=" border-radius: 18px;" required>
                    <textarea class="form-control" name="notitext" id="notitext" placeholder="write notification text  " style="min-height: 10px; border-radius: 18px;" required ></textarea>
                    <button type="submit" name="sndnoti" class="form-control btn btn-warning"><b> send notication</b></button>
                </form>
                <h5 class="text-center mt-3">send notifications to multiple user at a time</h5>
                 <div class="container col-12">
                     <form action="deluser" method="POST" class="form-group">
                    <textarea class="form-control" name="notitext2" id="notitext" placeholder="write notification text  " style="min-height: 10px; border-radius: 18px;" required></textarea>
                    <button type="submit" name="sndnoti2" class="form-control btn btn-warning"><b> send notication</b></button>
                </form>
          
                 </div>
            </div>
            <div class="container">
            <table class="table table-hover  table-striped">
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Delete</th>
                      
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $querry7 ="SELECT * FROM `notifications` ORDER BY sno DESC ";
                    $querry7run = mysqli_query($conn,$querry7);
                    if ($num7 = mysqli_num_rows($querry7run) > 0) {
                        while ($fetch7 = mysqli_fetch_assoc($querry7run)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $fetch7['username']; ?></th>
                                <td><?php echo $fetch7['message'] ;?></td>
                                <td><?php echo $fetch7['status']; ?></td>
                                <td class="m-auto">
                                    <form action="deluser" method="POST">
                                        <button class="btn btn-danger" name="noti_del" value="<?php echo $fetch7['sno']; ?>">Delete noti</button>


                                    </form>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
            </div>
</div>
           
            <!-------------Add event  --------------------------------------------------------->
            <div class="container-fluid mb-4" id="box5">
                <h5 class="text-center mt-3">Add a new event</h5>
            <div class="container col-6">
                <form action="deluser" method="POST" class="form-group">
                    <input class="form-control" type="text" name="evena" id="nusr" placeholder="Name of event" style=" border-radius: 18px;" required>
                    <input class="form-control" type="text" name="eveli" id="nusr" placeholder="any link for event" style=" border-radius: 18px;">
                    <input class="form-control" type="datetime-local" name="dtime" id="dtime" placeholder="" style=" border-radius: 18px;">
                    <textarea class="form-control" name="evetext" id="notitext" placeholder="write about event  " style="min-height: 10px; border-radius: 18px;" required></textarea>
                    <button type="submit" name="addeve" class="form-control btn btn-warning"><b> Add event</b></button>
                </form>
            </div>
            <div class="container">
            <table class="table table-hover  table-striped">
                <thead>
                    <tr>
                        <th scope="col">Event name</th>
                        <th scope="col">Event Message</th>
                        <th scope="col">Event Link</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Delete</th>
                      
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $querry9 ="SELECT * FROM `events` ORDER BY sno DESC ";
                    $querry9run = mysqli_query($conn,$querry9);
                    if ($num9 = mysqli_num_rows($querry9run) > 0) {
                        while ($fetch9 = mysqli_fetch_assoc($querry9run)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $fetch9['event_name']; ?></th>
                                <td><?php echo $fetch9['event_message'] ;?></td>
                                <td><?php echo $fetch9['event_link'] ;?></td>
                                <td><?php echo $fetch9['st_time']; ?>
                                <td style="color: green;"><b><?php echo $fetch9['event_status']; ?></b>
                                <?php
                                if($fetch9['event_status'] == "Running"){
                                ?>
                                <form action="deluser" method="POST">
                                        <button class="btn btn-warning" name="eve_end" value="<?php echo $fetch9['sno']; ?>"><b>End</b></button>
                                    </form>
                                    <?php
                                }else{
                                    ?>
                                      <form action="deluser" method="POST">
                                        <button class="btn btn-info" name="eve_res" value="<?php echo $fetch9['sno']; ?>"><b>Resume</b></button>
                                    </form>
                                    <?php
                                }
                                    ?>
                            </td>
                                <td class="m-auto">
                                    <form action="deluser" method="POST">
                                        <button class="btn btn-danger" name="eve_del" value="<?php echo $fetch9['sno']; ?>">Delete event</button>


                                    </form>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
            </div>

            </div>
            
        </div>
        <?php include 'footer/footer.php'; ?>

    <style>
        #box {
            display: none;
        }

        #box2 {
            display: none;
        }

        #box3 {
            display: none;
        }
        #box4 {
            display: none;
        }
        #box5 {
            display: none;
        }

        #img_profile {
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
    </style>

    <script type="text/javascript">
        if (document.getElementById("box").style.display = "block") {
            document.getElementById("btn").style.color = "black";
        }

        document.getElementById("btn").onclick = function() {
            if (document.getElementById("box").style.display = "none") {
                document.getElementById("box").style.display = "block"; 
                document.getElementById("box2").style.display = "none";
                document.getElementById("box3").style.display = "none";
                document.getElementById("box4").style.display = "none";
                document.getElementById("box5").style.display = "none";
                document.getElementById("btn").style.color = "black";
                document.getElementById("btn2").style.color = "white";
                document.getElementById("btn3").style.color = "white";
                document.getElementById("btn4").style.color = "white";
                document.getElementById("btn5").style.color = "white";
            }
        }

        document.getElementById("btn2").onclick = function() {

            document.getElementById("box").style.display = "none";
            document.getElementById("box2").style.display = "block";
            document.getElementById("box3").style.display = "none";
            document.getElementById("box4").style.display = "none";
            document.getElementById("box5").style.display = "none";
            document.getElementById("btn2").style.color = "black";
            document.getElementById("btn").style.color = "white";
            document.getElementById("btn3").style.color = "white";
            document.getElementById("btn4").style.color = "white";
            document.getElementById("btn5").style.color = "white";
        }

        document.getElementById("btn3").onclick = function() {

            document.getElementById("box").style.display = "none";
            document.getElementById("box2").style.display = "none";
            document.getElementById("box3").style.display = "block";
            document.getElementById("box4").style.display = "none";
            document.getElementById("box5").style.display = "none";
            document.getElementById("btn3").style.color = "black";
            document.getElementById("btn2").style.color = "white";
            document.getElementById("btn").style.color = "white";
            document.getElementById("btn4").style.color = "white";
            document.getElementById("btn5").style.color = "white";
        }
        document.getElementById("btn4").onclick = function() {

            document.getElementById("box").style.display = "none";
            document.getElementById("box2").style.display = "none";
            document.getElementById("box3").style.display = "none";
            document.getElementById("box5").style.display = "none";
            document.getElementById("box4").style.display = "block";
            document.getElementById("btn4").style.color = "black";
            document.getElementById("btn2").style.color = "white";
            document.getElementById("btn").style.color = "white";
            document.getElementById("btn3").style.color = "white";
            document.getElementById("btn5").style.color = "white";
        }
        document.getElementById("btn5").onclick = function() {

            document.getElementById("box").style.display = "none";
            document.getElementById("box2").style.display = "none";
            document.getElementById("box3").style.display = "none";
            document.getElementById("box4").style.display = "none";
            document.getElementById("box5").style.display = "block";
            document.getElementById("btn5").style.color = "black";
            document.getElementById("btn2").style.color = "white";
            document.getElementById("btn").style.color = "white";
            document.getElementById("btn3").style.color = "white";
            document.getElementById("btn4").style.color = "white";
        }
    </script>
</body>


</html>