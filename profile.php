<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);
ob_start();
$username = $_SESSION['username'];
if (!isset($username)) {
  header("location: login");
}
$select = "SELECT * FROM `signupinfo` WHERE username = '$username'";
$result = mysqli_query($conn, $select);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/21a4a21a84.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="keywords" content="talent ,vaale ,vale, talentvale login ,talentvale signup, build ,portfolio,join talentvale.com, join , talentvale.com,talentvaale, wale, talent waale, talentvalue, show login
 ,chat, chat with your friends,">
  <meta name="author" content="Deepansh kushwaha">
    <title>Your Profile</title>
</head>

<body>

    <?php
  require 'nav/nav.php';


  if (mysqli_num_rows($result) > 0) {
    $fetch = mysqli_fetch_assoc($result);
  } else {
    echo 'you are not logedin';
  }

  ?>
    <div class="cotainer">
        <!-- img cotainer -->
        <div class="container d-flex flex-column justify-content-center   mt-4">
            <?php
      if ($fetch['img'] == '') {
        echo '<img  src="icons/Group 328.png" id="img_profile"> <span  class=" m-0 p-2 edit rounded-circle " data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i  class="fa fa-camera"></i>
    </span>';
      } else {
        echo '<img id="img_profile" src= "' . $fetch['img'] . '"> <span  class=" m-0 p-2 edit rounded-circle " data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i  class="fa fa-camera"></i>
    </span>';
      }
  ?>
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Choose new profile Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="file" name="userfile" id="file" accept="image/png, image/jpeg" required>
                                <input type="hidden" name="name" value="<?php echo $fetch['username'] ?>">
                                <?php
                $id = $fetch['sno'];
                if (isset($_POST['save'])) {
                  $name = $_POST['name'];
                  $filename = $_FILES["userfile"]["name"];
                  $tempname = $_FILES["userfile"]["tmp_name"];
                  $folder = "userimg/" . time().basename($filename);
                  if(file_exists($fetch['img'])){
                    unlink($fetch['img']);
                  
                  if ($name != "" && $filename != "") {
                    move_uploaded_file($tempname, $folder);
                    $query = "UPDATE signupinfo SET img = '$folder' WHERE sno = '$id';";
                    $data = mysqli_query($conn, $query);
                    if ($data) {
                      $done = "Image updated please reload";
                      header("location:profile");
                    }
                  } else {
                     $done =  "Can not update, Please retry";
                  }
                }else{
                  if ($name != "" && $filename != "") {
                    move_uploaded_file($tempname, $folder);
                    $query = "UPDATE signupinfo SET img = '$folder' WHERE sno = '$id';";
                    $data = mysqli_query($conn, $query);
                    if ($data) {
                      $done = "Image updated please reload";
                      header("location:talentvale.com");
                    }
                  } else {
                     $done =  "Can not update, Please retry";
                  }
                }
                }
                else{
                  $done= "";
                }


                ?>
                                <button type="submit" name="save" id="save" class="btn btn-warning mt-2">
                                    Save changes
                                </button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php
            $row ="SELECT `username`FROM `posts` WHERE username = '$username'";
            $rowfire = mysqli_query($conn, $row);
            $numrow = mysqli_num_rows($rowfire);
            ?>
        </div>
        <div class="d-flex justify-content-center">
        <a class="container" style="text-decoration:none;color:#0e0e0d" href="vprofile?id=<?php echo $username;?>">   <div class="container text-center">
                <h3 style="color:gray ;"> <?php echo "$numrow" ?></h3>
                <h6> <strong> Posts</strong></h6>
            </div></a>
            <?php
            $sql2 = "SELECT * FROM `follow` WHERE follower_name ='$username'";
            $sql2run = mysqli_query($conn, $sql2);
            $num2row = mysqli_num_rows($sql2run);
            $sql3 = "SELECT * FROM `follow` WHERE `user_name` ='$username'";
            $sql3run = mysqli_query($conn, $sql3);
            $num3row = mysqli_num_rows($sql3run);
            ?>
            <div class="container text-center" data-bs-toggle="modal" data-bs-target="#follow">
                <h3 style="color:gray ;"> <?php echo $num3row;?></h3>
                <h6> <strong > Followers</strong></h6>
                </div>
 <!-- Modal for follower -->
 <div class="modal fade" id="follow" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Followers</h5>
                            <button type="button" class="close rounded-pill" style="border:none;background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="container ">
                                            <?php

                                            foreach ($sql3run as $l) {
                                                $name = $l['follower_name'];
                                                $sql4 = "SELECT * FROM `signupinfo` WHERE `username`= '$name' ";
                                                $sql4run = mysqli_query($conn, $sql4);
                                                $sql4f =  mysqli_fetch_assoc($sql4run);
                                            ?>
                                                <div class="row row-cols-3 mb-2">
                                                    <div class="container">
                                                        <a href="vprofile?id=<?php echo $product['username']; ?>"><?php
                                                                                                                        if ($sql4f['img'] == '') {
                                                                                                                            echo '<img id="img_profile2"  src="icons/Group 328.png" alt="img profile">';
                                                                                                                        } else {
                                                                                                                            echo '<img id="img_profile2" src= "' . $sql4f['img'] . '">';
                                                                                                                        }
                                                                                                                        ?>
                                                        </a>
                                                    </div>
                                                    <div class="container">
                                                        <h5><?php echo $l['follower_name']; ?></h5>
                                                    </div>
                                                    <div class="container">
                                                        <?php
                                                        $querry12 = "SELECT * FROM `follow` WHERE  `follower_name` = '$username' && `user_name`= '$name'";
                                                        $querry12fire = mysqli_query($conn, $querry12);
                                                        $num12 = mysqli_num_rows($querry12fire);
                                                        ?>

                                                        <?php
                                                        if ($name != $_SESSION['username']) {
                                                            if ($num12 != 1) {
                                                        ?>
                                                                <button style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" class="btn btn-md ms-4 followbtn" data-user-id='<?php echo $name ?>'><strong> FollowBack</strong></button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" class="btn btn-md ms-4 unfollowbtn" data-unfollow-id='<?php echo $name ?>'><strong>
                                                                        Following</strong></button>

                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
               
           
            <div class="container text-center"  data-bs-toggle="modal" data-bs-target="#following">
                <h3 style="color:gray ;"> <?php echo $num2row;?></h3>
                <h6> <strong> Following</strong></h6>
            </div>
<!-- Modal for following list -->
<div class="modal fade" id="following" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Followers</h5>
                            <button type="button" class="close rounded-pill" style="border:none;background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="container ">
                                            <?php

                                            foreach ($sql2run as $l2) {
                                                $name = $l2['user_name'];
                                                $sql9 = "SELECT * FROM `signupinfo` WHERE `username`= '$name' ";
                                                $sql9run = mysqli_query($conn, $sql9);
                                                $sql9f =  mysqli_fetch_assoc($sql4run);
                                            ?>
                                                <div class="row row-cols-3 mb-2">
                                                    <div class="container">
                                                        <a href="vprofile?id=<?php echo $product['username']; ?>"><?php
                                                                                                                        if ($sql9f['img'] == '') {
                                                                                                                            echo '<img id="img_profile2"  src="icons/Group 328.png" alt="img profile">';
                                                                                                                        } else {
                                                                                                                            echo '<img id="img_profile2" src= "' . $sql9f['img'] . '">';
                                                                                                                        }
                                                                                                                        ?>
                                                        </a>
                                                    </div>
                                                    <div class="container">
                                                        <h5><?php echo $l2['user_name']; ?></h5>
                                                    </div>
                                                    <div class="container">
                                                        <?php
                                                        $querry12 = "SELECT * FROM `follow` WHERE  `follower_name` = '$username' && `user_name`= '$name'";
                                                        $querry12fire = mysqli_query($conn, $querry12);
                                                        $num12 = mysqli_num_rows($querry12fire);
                                                        ?>

                                                        <?php
                                                        if ($name != $_SESSION['username']) {
                                                            if ($num12 != 1) {
                                                        ?>
                                                                <button style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" class="btn btn-md ms-4 followbtn" data-user-id='<?php echo $name ?>'><strong>Follow</strong></button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" class="btn btn-md ms-4 unfollowbtn" data-unfollow-id='<?php echo $name ?>'><strong>
                                                                        Unfollow</strong></button>

                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <p style="color:red;"><?php echo $done; ?></p>

        

        <!-- usrname cont -->
                <div class="container d-flex flex-column  justify-content-center align-items-center text-center  p-0">
                            <div class="d-flex">
                                <div class="container m-0 p-0"><h2
                                        class="m-0"><strong><b><?php echo $fetch['firstname']; ?></b></strong></h2>
                                </div>
                                <div class="container m-0 ms-1 p-0"><h2
                                        class="m-0"><strong><b><?php echo $fetch['lastname']; ?></b></strong></h2>
                                </div>
                            </div>
                            <h3 style="color:gray ;"><b><?php echo $fetch['username']; ?></b></h3>
                        </div>

        <?php
        if($fetch['day']=='' OR $fetch['month'] == ''  OR $fetch['year'] == '' OR $fetch['skills']== '' OR $fetch['education']== '' OR $fetch['hobbies']== '' ){
          $_SESSION['empty'] = true ;
          echo '<div class= "text-center"><h5 style="color:red;">Complete Your Profile</h5></div>';
        }else{
          $_SESSION['empty']=false;
        }
        ?>
        <div class="container col-md-6 mt-4  main ">
            <div class="container text-center">
                <h6><b>Date Of Birth</b></h6>
            </div>
            <!-- dob container -->
            <div class="container  d-flex justify-content-center">
                <div class="css-input container d-flex justify-content-center ">
                    <!-- <label for="dob">Day</label> -->

                    <?php
          if ($fetch['day'] == '') {
            echo '--';
          } else {
            echo $fetch['day'];
          }
          ?>


                </div>
                <div class="css-input container d-flex justify-content-center ">
                    <!-- <label for="dob">Month</label> -->

                    <?php
          if ($fetch['month'] == '') {
            echo '--';
          } else {
            echo $fetch['month'];
          }
          ?>

                </div>
                <div class="css-input container d-flex justify-content-center ">
                    <!-- <label for="dob">Year</label> -->

                    <?php
          if ($fetch['year'] == '') {
            echo '--';
          } else {
            echo $fetch['year'];
          }
          ?>


                </div>
            </div>
            <!-- skills  -->
            <div class="container d-flex flex-column align-items-center ">
                <label for="skills"><b>Skills</b></label>
                <div class="css-input container text-center ">
                    <?php
          if ($fetch['skills'] == '') {
            echo '--';
          } else {
            echo $fetch['skills'];
          }
          ?></div>
                <!-- education -->
                <label for="education"><b>Education</b></label>
                <div class="css-input container text-center ">
                    <?php
          if ($fetch['education'] == '') {
            echo '--';
          } else {
            echo $fetch['education'];
          }
          ?></div>
                <!-- hobbies -->
                <label for="hobbies"><b>Your hobbies</b></label>
                <div class="css-input container text-center ">
                    <?php
          if ($fetch['hobbies'] == '') {
            echo '--';
          } else {
            echo $fetch['hobbies'];
          }
          ?></div>

            </div>
        </div>
        <!-- button grp -->
        <div class="container d-flex flex-row justify-content-center col-md-6">
            <a class="btn btn-primary m-2"
                href="update_profile?id= <?php echo $fetch['sno']; ?>&d=<?php echo $fetch['day']; ?>&m=<?php echo $fetch['month']; ?>&y=<?php echo $fetch['year']; ?>&sk=<?php echo $fetch['skills']; ?>&ho=<?php echo $fetch['hobbies']; ?>&ed=<?php echo $fetch['education']; ?> ">
                <b> Update</b>
            </a>
            <a class="btn btn-danger m-2" href="logout"><b>Logout</b></a>
        </div>

    </div>

    <?php
  require 'footer/footer.php';
  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="jquery-3.6.0.js" type="text/javascript"></script>
<script src="custom.js"></script>
    <style>
    body {
        background-image: url("icons/wave (2).svg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;

    }

    .css-input {

        padding: 5px;
        font-size: 20px;
        border-width: 2px;
        border-color: #ec9541;
        background-color: #ffffff;
        color: #0e0e0d;
        border-style: solid;
        border-radius: 19px;
        box-shadow: 1px 2px 6px rgba(66, 66, 66, .75);
        text-shadow: -32px 0px 26px rgba(66, 66, 66, .75);
    }

    .css-input:focus {
        outline: none;
    }

    #img_profile {
        background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
        height: 200px;
        width: 200px;
        object-fit: scale-down;
        border-radius: 50%;
        margin: 0 auto 20px auto;
        display: block;
        /* border: 8px solid #F6A62D;
        border-style:solid; */

    }
    #img_profile2 {
                height: 4em;
                width: 4em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }
    .edit {
        background-color:whitesmoke;
        /* border-radius: 50% 50%; */
        position: absolute;
        top: 220px;
        left: 60%;
        /* font-size: 3vh; */
    }
    </style>

</body>

</html>