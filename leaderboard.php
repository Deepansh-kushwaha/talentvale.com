<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);

$username = $_SESSION['username'];

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <title>Daily leaderboard</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
    <h1 class="text-center"><b><strong>DAILY LEADERBOAR</strong></b></h1>
    <div class="container text-center"><h4>Today's Top rankers by likes<span> <button type="button" class="btn"
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip"
        title="This ranking is based on no of like on post,
        which user posted today,
        The top ranker of the day will get some gift
        ">
        <i class="far fa-question-circle"></i>
</button>
</span>
</h4>
</div>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<?php
  $filtervalues= date("Y-m-d");
  $querry5 ="SELECT * FROM `posts`WHERE  CONCAT(date) LIKE '%$filtervalues%'  ORDER BY likes DESC ";
  $querry5fire =mysqli_query($conn, $querry5);
  $num = mysqli_num_rows($querry5fire);

?>

<div class="container">
    <?php
    if($num == 0){
        echo '<div class="container text-center">No One Participated Today, Be the one a post now</div>';
    }
    
    $no = 1;
  foreach($querry5fire as $row){
    $uname = $row['username'];
    // $row_id = $row['sno'];

// for user info
    $sql = "SELECT * FROM `signupinfo` WHERE username = '$uname'";
    $sqlrun = mysqli_query($conn , $sql);
    $product = mysqli_fetch_assoc($sqlrun)
    
    ?>
    <div class="container p-0 ">
    <div class=" d-flex    border shadow justify-content-center m-0 p-0" style="border-radius: 10px;">
        <div class="container col-1 d-flex justify-content-center align-items-center m-0 p-0"><?php 
        if($no == 1){
            ?>
            <i class="fas fa-trophy" style="color:gold;"></i>
            <?php
        }elseif($no == 2){
            ?>
            <i class="fas fa-trophy" style="color:silver;"></i>
            <?php
        }elseif($no == 3){
            ?>
            <i class="fas fa-trophy" style="color:grey;"></i>
            <?php
        }
        else{
            echo $no ;
        }
            ?>
    
    </div>
                                <div class="container d-flex justify-content-center align-items-center p-0 m-2 ">
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
                                        <div class="container m-0 p-0"><small class="m-0"><strong><b><?php echo $product['firstname']; ?> </b></strong></small>
                                        </div>
                                        <div class="container m-0 ps-1 p-0"><small class="m-0"><strong><b><?php echo $product['lastname']; ?></b></strong></small>
                                        </div>
                                    </div>
                                    <small style="color:gray ;"><b>@<?php echo $product['username']; ?></b></small>
                                </div>
                               <div class="container p-0 d-flex justify-content-center align-items-center">
                                  <img src="<?php echo $row['postimg']; ?>" id="img_profile" alt="">
                               </div>
                            </div>
    </div>
    <?php
    $no++ ;
    }
    ?>
</div>
    
    <?php include 'footer/footer.php'; ?>
<?php

?>
    <style>
            #img_profile {
                height: 4em;
                width: 4em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }
    </style>
</body>

</html>