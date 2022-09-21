<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
$username = $_SESSION['username'];
error_reporting(0);
$added_post = $_GET['id'];
$query = "SELECT signupinfo.firstname,signupinfo.lastname,signupinfo.username,signupinfo.img,posts.sno,posts.username,posts.postimg,posts.text,posts.description,posts.tags,posts.category,teammembers FROM signupinfo JOIN posts on signupinfo.username=posts.username ORDER BY RAND()";
$query1run = mysqli_query($conn, $query);
$num = mysqli_num_rows($query1run);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="keywords" content="talent ,vaale ,vale, talentvale login ,talentvale signup, build ,portfolio,join talentvale.com, join , talentvale.com,talentvaale, wale, talent waale, talentvalue, show login
 ,chat, chat with your friends,">
  <meta name="author" content="Deepansh kushwaha">

    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://talentvale.com"/>
    <meta property="og:title" content="welcome to talentvale.com"/>
    <meta property="og:description" content="Build your portfolio for free and share it with others., Participate in events to get a certificate., Get likes and featured in our daily leaderboard.
"/>
    <meta property="og:image" content="https://talentvale.com/talent%20vale%20logo.png"/>
    <meta property="og:image:secure url" content="https://talentvale.com/talent%20vale%20logo.png"/>
    <link rel="img src" href="https://talentvale.com/talent%20vale%20logo.png" type="image/x-icon">
    <meta property="og:site_name" content="talentvale.com"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta property="fb:app_id" content="618785932454978"/>
     
    
    <meta name="twitter:image" content="https://talentvale.com/talent%20vale%20logo.png"/>
    <meta name="twitter:title" content="welcome to talentvale.com"/>
    <meta name="twitter:description" content="Start your journey to talentvale and see the magic in your life"/>
    <meta name="twitter:site" content=""/>
    <title>Talentvale.com</title>
</head>
<script>
    window.onload = function() {
        document.getElementById('loader').style.display = "none";
        document.getElementById('content').style.display = "block";
    };
</script>
<style>
    #content {
        display: none;
    }

    #loader img {
        width: 300px;

    }
</style>

<body>
    <?php require 'nav/nav.php' ?>
    <div id="loader">
        <div class="d-flex justify-content-center m-auto">
            <img src="eb7e7769321565.5ba1db95aab9f.gif" alt="loader">
        </div>
    </div>
    <div id="content">
        <!-- main area -->

        <div class="container d-flex">

            <!-- friends container -->
            <div class="container-fluid shadow-lg frnd col-3 me-2">

                <div class="container d-flex justify-content-center align-items-center mt-2 mb-0">
                    <h4><b><strong><u>Follow Suggestions</u></strong></b></h4>

                </div>
                <hr class="mt-0">
                <div class="container">
                    <?php
                    $sug = "SELECT * FROM `signupinfo` LIMIT 7";
                    $sugrun = mysqli_query($conn, $sug);
                    foreach ($sugrun as $su) {
                        $nam = $su['username']; 
                        $frnd = "SELECT * FROM `follow` WHERE `follower_name` = '$username' && `user_name`= '$nam' ";
                        $frndrun = mysqli_query($conn, $frnd);
                        $fr = mysqli_fetch_assoc($frndrun);
                        $nfr = mysqli_num_rows($frndrun);
                        if (($nfr != 1) && ($username != $nam)) {
                    ?>
                            <div class=" d-flex      row row-cols-3 mb-2  ">
                                <div class="container d-flex justify-content-center align-items-center p-0 m-0 ">
                                    <a href="vprofile?id=<?php echo $su['username']; ?>"><?php
                                                                                                    if ($su['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $su['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                </div>
                                <div class="container d-flex flex-column  justify-content-center align-items-center text-center m-0 p-0">

                                    <small style="color:grey ;"><b><?php echo $su['username']; ?></b></small>
                                    <?php
                                    $roname =$su['username'];
                                    $fname = $fr['user_name'];
                                    $foname = $fr['follower_name'];
                                    $frnd3 = "SELECT * FROM `follow` WHERE `follower_name` = '$roname' && `user_name`= '$username' ";
                                    $frnd3run = mysqli_query($conn, $frnd3);
                                    $num3 = mysqli_num_rows($frnd3run);
                                    if($num3 == 1  ){
                                    ?>
                                    <small style="font-size:xx-small ;">follows you</small>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="container  d-flex justify-content-center align-items-center m-0 p-0">
                                    <button style="background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px; color:white;" class="btn btn-sm btn-warning followbtn" data-user-id='<?php echo $nam; ?>'><b>
                                            Follow</b></button>
                                </div>

                            </div>
                    <?php
                        }
                    }
                    echo '<h6 class="text-center">You are all done</h6>'
                    ?>
                </div>
            </div>
            <div class="container-fluid shadow-sm m-0 p-0 scroll">
                <?php


                if ($_SESSION['added'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> New Post Added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                unset($_SESSION['added']);
                if ($added_post == "failed") {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed</strong> Failed To Add Post.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                if ($_SESSION['pstdel'] == true) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success</strong> Post Deleted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                unset($_SESSION['pstdel']);
                ?>
                <div class="container  m-0 p-0 d-flex justify-content-center flex-column ">
                    <?php

                    while ($product = mysqli_fetch_array($query1run)) {
                        $ssnot = $product['sno'];
                    ?>
                        <!--MAIN container -->
                        <div class="container-fluid morph  mt-1 mb-1 ">
                            <!-- img ,username, time , options  -->
                            <div class=" d-flex      row row-cols-3">
                                <div class="container d-flex justify-content-center align-items-center p-0 m-0 ">
                                    <a href="vprofile?id=<?php echo $product['username']; ?>"><?php
                                                                                                    if ($product['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $product['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                </div>
                                <div class="container d-flex flex-column  justify-content-center align-items-center text-center m-0 p-0">
                                    <div class="d-flex">
                                        <div class="container m-0 p-0"><small class="m-0"><strong><b><?php echo $product['firstname']; ?></b></strong></small>
                                        </div>
                                        <div class="container m-0 ms-1 p-0"><small class="m-0"><strong><b><?php echo $product['lastname']; ?></b></strong></small>
                                        </div>
                                    </div>
                                    <small style="color:gray ;"><b>@<?php echo $product['username']; ?></b></small>
                                </div>
                                <?php
                                if ($product['username'] == $username) {
                                ?>
                                    <div class="container d-flex justify-content-center align-items-center m-0 p-0">
                                        <div class="dropdown me-1">
                                            <div type="button" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                                                <img src="icons/black/Options@2x.png " alt="">
                                            </div>
                                            <ul class="dropdown-menu rounded-pill m-0 p-0" aria-labelledby="dropdownMenuOffset">
                                                <form action="ajax" method="POST">
                                                    <input type="hidden" name="posd" id="posd" value="<?php echo $product['sno']; ?>">
                                                    <input type="hidden" name="delimg" id="delimg" value="<?php echo $product['postimg']; ?>">
                                                    <button type="submit" id="demo" name="delpos" class="dropdown-item text-center rounded-pill" onclick="myFunction()" style="color:white;background-color:#fc4a1a">
                                                    <b> DELETE POST</b>
                                                </button>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                                <script>
                                    function myFunction() {

                                        var x;

                                        var r = confirm("Are you sure you want to delete this Post");

                                        if (r == true) {

                                            x = "You pressed OK!";

                                        } else {

                                            x = "You pressed Cancel!";
                                            return false;
                                        }

                                        document.getElementById("demo").innerHTML = x;

                                    }
                                </script>
                            </div>

                            <hr class="m-0 mt-1">
                            <!-- posts in mains  -->
                            <div class="conainer photos d-flex justify-content-center align-items-center">

                                <?php
                                if ($product['postimg'] == '') {
                                    echo '<div class="container"> <p class="text-center" style="word-wrap: break-word;">' . $product['text'] . '</p></div>';
                                } else {
                                    $simt =  $product['postimg'];
                                    echo '<img class="posti" src="' . $product['postimg'] . '" alt="">';
                                }
                                ?>



                            </div>

                            <div class="container description mt-2">
                                <?php $sdet =   $product['description'];?>
                                <h6><strong><?php echo $product['description']; ?></strong></h>
                            </div>

                            <hr class="m-0 mt-1">

                            <span>
                                <?php
                                $row_id = $product['sno'];
                                $sql = "SELECT * FROM `likes` WHERE user = '$username' && post_no = $row_id ";
                                $sqlrun = mysqli_query($conn, $sql);



                                if (mysqli_num_rows($sqlrun) == 1) {
                                    //user already liked   
                                    $likedisplay = 'display:none';
                                    $unlikedisplay = 'display:';
                                } else {
                                    $likedisplay = 'display:';
                                    $unlikedisplay = 'display:none';
                                }
                                ?>
                                <button id="like" style="border:none; background-color:white; font-size:x-large; <?php echo $likedisplay ?>;" class=" likebtn" data-post-id='<?php echo $product['sno']; ?>'><i style="color: black;" class="far fa-heart"></i></button>

                                <button id="dislike" style="border:none; background-color:white; font-size:x-large; <?php echo $unlikedisplay ?>;" class=" unlikebtn" data-post-id='<?php echo $product['sno']; ?>'><i style="color:red;" class="fas fa-heart"></i></button>

                                <button style="border:none; background-color:white; font-size:x-large;" type="button"><a style="color: black;" href="comments?id=<?php echo $row_id ?>"><i class="far fa-comment-alt"></i></a></button>
                                 
                                <span class=" dropup">
  <button  style="border:none; background-color:white; font-size:x-large;"  data-bs-toggle="dropdown" aria-expanded="false">
  <i style="color: black;" class="far fa-paper-plane"></i>
  </button>
  <span class="dropdown-menu m-0 p-0" style="border:none;">
  <ul class=" list-group list-group-vertical rounded-circle ">
    <!-- Dropdown menu links -->
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://api.whatsapp.com/send?phone=&text=<?php echo urlencode($sdet)?>http://talentvale.com/vsharepst?id=<?php echo $ssnot ; ?>" target="_blank"><i style="color:limegreen; " class="fab fa-whatsapp"></i> Whatsapp</a> </li>
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://twitter.com/share?text=<?php echo $sdet ;?>&url=https://talentvale.com/vsharepst?id=<?php echo $ssnot;?>&hashtags=#PHP" target="_blank"><i style="color: skyblue; " class="fab fa-twitter"></i> Twitter</a> </li>
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://facebook.com/sharer?u=https://talentvale.com/vsharepst?id=<?php echo $ssnot ; ?>" target="_blank"><i style="color: blue; " class="fab fa-facebook"></i> Facebook</a> </li>
  </ul>
</span>


                            </span>
<!-------------------------vote btn  ------------------------------->
                            <?php
                            $query10 = "SELECT * FROM `events`";
                            $query10run = mysqli_query($conn, $query10);
                            foreach($query10run as $num10){
                                $filtervalues = $num10['event_name'];
                            }
                            if($filtervalues == ''){
                                $filtervalue = 0;
                            }else{
                                $filtervalue = $filtervalues;
                            }
                            $query0 = "SELECT * FROM `posts` WHERE  CONCAT(tags) LIKE '%$filtervalue%' && sno =  $row_id ";
                            $query0run = mysqli_query($conn, $query0);
                            $num0 = mysqli_num_rows($query0run);
                            
                            if($num0  >0){

                                $row_id = $product['sno'];
                                $sql03 = "SELECT * FROM `vote` WHERE user = '$username' && post_no = $row_id ";
                                $sql03run = mysqli_query($conn, $sql03);



                                if (mysqli_num_rows($sql03run) > 0) {
                                    //user already voted  
                                    $votdisplay = 'display:none';
                                    $unvotedisplay = 'display:';
                                } else {
                                    $votedisplay = 'display:';
                                    $unvotedisplay = 'display:none';
                                }
                                ?>

                            <span >
                            <button style="border:none; background-color:white; <?php echo $votdisplay ;?>" type="button"  class=" votebtn" data-post-id='<?php echo $product['sno']; ?>'><img src="icons/vote-logo-_1_.webp" style="width:1em;" alt=""></button>
                            <button style="border:none; background-color:white; <?php echo $unvotedisplay ;?>" type="button"  class=" unvotebtn" data-post-id='<?php echo $product['sno']; ?>'><img src="icons/vote-logo-2.webp" style="width:1em;" alt=""></button>
                            </span>
<?php
                            }
?>
                            </span>
                            <div class="container mb-1">
                                <?php
                                $sql3 = "SELECT * FROM `likes` WHERE `post_no` = $row_id ";
                                $sql3run = mysqli_query($conn, $sql3);
                                $num3row = mysqli_num_rows($sql3run);
                                $sql6 = "SELECT * FROM `comment` WHERE `pst_id` = $row_id ";
                                $sql6run = mysqli_query($conn, $sql6);
                                $num6row = mysqli_num_rows($sql6run);
                                ?>
                                <small data-toggle="modal" data-target="#like<?php echo $row_id ?>"><b> Likes</b></small>
                                <strong> <?php echo $num3row ?></strong>
                                <span><b> comments</b></span>
                                <strong> <?php echo $num6row ?></strong>
                            </div>

 <!---------------------------------- conmment area  ------------------------------------------->
 <div id="error_status" class="text-center" style="color:red ;"></div>
 <div class="input-group mb-1 " >
     
     <textarea class="form-control txtarea comment-input    " aria-label="With textarea" placeholder="Say somthing about above"></textarea>
     <button class="btn input-group-text add-comment" type="button"  data-cs="comment-section<?=$product['sno']?>" data-cm-id="<?=$product['sno']?>" >
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"></path> </svg>
                            </button>
</div>



                        </div>
                        <!-- Modal for like list -->
                        <div class="modal fade" id="like<?php echo $row_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Likes</h5>
                                        <button type="button" class="close rounded-pill" style="border:none;background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container ">
                                            <?php

                                            foreach ($sql3run as $l) {
                                                $name = $l['user'];
                                                $sql4 = "SELECT * FROM `signupinfo` WHERE `username`= '$name' ";
                                                $sql4run = mysqli_query($conn, $sql4);
                                                $sql4f =  mysqli_fetch_assoc($sql4run);
                                            ?>
                                                <div class="row row-cols-3 mb-2">
                                                    <div class="container">
                                                        <a href="vprofile?id=<?php echo $product['username']; ?>"><?php
                                                                                                                        if ($sql4f['img'] == '') {
                                                                                                                            echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                                        } else {
                                                                                                                            echo '<img id="img_profile" src= "' . $sql4f['img'] . '">';
                                                                                                                        }
                                                                                                                        ?>
                                                        </a>
                                                    </div>
                                                    <div class="container">
                                                        <h5><?php echo $l['user']; ?></h5>
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

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px" class="btn btn-md ms-4 followbtn" data-user-id='<?php echo $name ?>'><strong> Follow</strong></button>
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

                    <?php
                    }

                    ?>
                </div>
            </div>

            <?php


            $select = "SELECT * FROM `signupinfo` WHERE username = '$username'";
            $result = mysqli_query($conn, $select);
            $fetch = mysqli_fetch_assoc($result);
            if ($fetch['day'] == '' && $fetch['month'] == ''  && $fetch['year'] == '' && $fetch['skills'] == '' && $fetch['education'] == '' && $fetch['hobbies'] == '') {
                $_SESSION['empty'] = true;
            } else {
                unset($_SESSION['empty']);
            }
            ?>
            <!-- profile container -->
            <div class="container-fluid shadow-lg prof  col-3 text-center m-0 ms-2 p-0">
                <div class="container-fluid m-0 p-0 coverimg"><img src="icons/wave.svg" alt=""></div>
                <div class="row row-col-3  m-0 p-0">
                    <div class="container-fluid profimg d-flex justify-content-center m-0 p-0">
                        <a href="vprofile?id=<?php echo $username; ?>"> <?php
                                                                            if ($fetch['img'] == '') {
                                                                                echo '<img class="shadow" id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                            } else {
                                                                                echo '<img class="shadow" id="img_profile" src= "' . $fetch['img'] . '">';
                                                                            }
                                                                            ?></a>
                    </div>
                    <div class="container-fluid d-flex flex-column align-items-center m-0 p-0 ">
                        <div class="container d-flex flex-column  justify-content-center align-items-center text-center m-0 p-0">
                            <div class="d-flex">
                                <div class="container m-0 p-0"><small class="m-0"><strong><b><?php echo $fetch['firstname']; ?></b></strong></small>
                                </div>
                                <div class="container m-0 ms-1 p-0"><small class="m-0"><strong><b><?php echo $fetch['lastname']; ?></b></strong></small>
                                </div>
                            </div>
                            <small style="color: gray;"><b>@<?php echo $fetch['username']; ?></b></small>
                        </div>

                        <div class="container  m-0 p-0">
                            <?php
                            $skil = $fetch['skills'];
                            if ($skil != '') {
                            ?>
                                <p style="font-size: 55%;"><strong>Skills:- <?php echo $fetch['skills']; ?></strong></p>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <?php
                $sql2 = "SELECT * FROM `follow` WHERE follower_name ='$username'";
                $sql2run = mysqli_query($conn, $sql2);
                $num2row = mysqli_num_rows($sql2run);
                $sql5 = "SELECT * FROM `follow` WHERE `user_name` ='$username'";
                $sql5run = mysqli_query($conn, $sql5);
                $num5row = mysqli_num_rows($sql5run);
                ?>
                <div class="container d-flex justify-content-center">
                    <div class="container text-center shadow rounded">
                        <div class="container" style="color: gray;"><?php echo $num5row; ?></div>
                        <div class="container ">
                            <p style="font-size: 65%;"> <b> Folowers</b></p>
                        </div>
                    </div>
                    <div class="container text-center shadow rounded">
                        <div class="container" style="color: gray;"><?php echo $num2row; ?></div>
                        <div class="container ">
                            <p style="font-size: 65%;"> <b> Following</b></p>
                        </div>
                    </div>
                </div>
                <form action="ajax" method="POST">
                    <div class="container d-flex justify-content-center mt-2  input-group">
                        <textarea name="textpost" id="textpost" class="txtarea shadow" placeholder="write your views " class="form-control" aria-label="With textarea" required></textarea>
                        <button class="btn m-0 p-0 " type="submit" name="uptext">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" style="border-radius:0 10px 10px 0; background-color:orange; padding:2px 8px 2px 4px " fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                </svg>
                        </button>
                    </div>
                </form>

                <hr>
                <div class="container text-center mb-3">
                    <a href="add"><button class="btn btn-md shadow" style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px; color:white; ">
                            <b> Upload</b></button></a>
                </div>
            </div>


        </div>
        <?php

        ?>
        <style>
            .morph {
                background: rgba(255, 255, 255, 1);
                border-radius: 15px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }

            .txtarea {
                border-radius: 10px;
                border:none;
                padding-left: 14px;
                border-bottom: 1px solid gray;
                height: 40px;
                
            }

            .scroll {
                max-height: 90vh;
                height: fit-content;
                width: auto;
                overflow-y: scroll;
                overflow-x: hidden;
                scroll-behavior: smooth;
                -ms-overflow-style: none;
                /* Internet Explorer 10+ */
                scrollbar-width: none;
                /* Firefox */
            }

            .scroll::-webkit-scrollbar {
                display: none;
                /* Safari and Chrome */
            }

            .img2 {
                width: auto;
                right: 2px;
                height: 2vh;
                margin: 5%;
            }

            #img_profile {
                height: 3.5em;
                width: 3.5em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }
            #img_profile2 {
                height: 2em;
                width: 2em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }


            .posti {
                width: 50%;
                height: 50%;
            }
            .photos{
                min-height: 170px;
            }


            @media only screen and (max-width:829px) {

                .frnd {
                    display: none;
                }

                .prof {
                    display: none;
                }

                .profbtn {
                    display: none;
                }

                .img1 {
                    height: auto;
                    width: 60%;
                    margin-top: 2%;
                    border-radius: 50%;
                }
            }
        </style>
 </div>
        <?php require 'footer/footer.php' ?>
        <script src="jquery-3.6.0.js" type="text/javascript"></script>
        <script src="custom.js"></script>
       
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