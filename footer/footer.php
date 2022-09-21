<?php
include 'dbconn/dbconn.php';
error_reporting(0);
$username = $_SESSION['username'];
$querry6 ="SELECT * FROM `notifications` WHERE username = '$username' ORDER bY `sno` DESC ";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/21a4a21a84.js" crossorigin="anonymous"></script>
    <meta name="keywords" content="talent ,vaale ,vale, talentvale login ,talentvale signup, build ,portfolio,join talentvale.com, join , talentvale.com,talentvaale, wale, talent waale, talentvalue, show login
 ,chat, chat with your friends,">
  <meta name="author" content="Deepansh kushwaha">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid mt-auto d-none d-lg-block  footer">
        <div class="container d-flex justify-content-center my-2 ">
            <div class="container pt-2  ">
                <h6 class="cont"> <b><strong> <u>Support</u></strong></b></h6>
                <div class="container d-flex flex-column  justify-content-center ml-2">

                    <a id="f-l" href="mailto:contact@talentvale.com">contact@talentvale.com</a>
                    <a id="f-l" href="wwu">Work with us </a>
                    <a id="f-l" href="contactus">Contact us</a>

                </div>
            </div>
            <div class="container pt-2  ">
                <h6 class="cont2"> <b><strong> <u> Information </u></strong></b></h6>
                <div class="row row-cols-2 d-flex flex-column align-items-center">
                    <div class="container d-flex flex-column justify-content-end">
                    <a id="f-l" href="aboutus">About us</a>
                    <a id="f-l" href="founders">Founders</a>
                    <a id="f-l" href="t&c">Terms & Condition</a>
                    <a id="f-l" href="privacyp">Privacy Policy</a>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-end ">
                <a href="index"><i class="fas fa-home m-1 " style="color: white; "></i></a>
                <a href="https://twitter.com/ValeTalent" target="_blank"><img src="footer/Twitter@2x.png" alt="twitter"></a>
                <a href="https://www.facebook.com/Talent-Vale-105729315492389" target="_blank"><img src="footer/Facebook-1@2x.png" alt="facebook"></a>
                <a href="https://www.instagram.com/talentvale/" target="_blank"><img src="footer/Instagram@2x.png" alt="isntagram"></a>
            </div>

        </div>
        <div class="container text-center pt-2">
            <h6> Copyright &#169; 2022 | Talentvale.com | <strong><a
                        href="mailto:deepanshkushwaha9@gmail.com">Developer Contact</a></strong></h6>
        </div>
    </div>
    <!-------------------------- mobile view  ----------------------------------------------------------->
    <footer class=" d-lg-none mt-auto footer ">
        <div class="container-fluid d-flex flex-row justify-content-center mt-1 ">
            <div class="nav-item container d-flex justify-content-center"><a href="index"><i
                        class="fas fa-home m-1 " style="color:black;"></i></a></div>
            <div class="nav-item container d-flex justify-content-center"><a href="search"><img
                        src="footer/Search@2x.png" alt="search"></a></div>
            <div class="nav-item container d-flex justify-content-center" data-bs-toggle="modal"
                data-bs-target="#exampleModal2"><a class=" position-reletive" href="#"><img src="footer/Alert@2x.png"
                        alt="noti">
                    <?php  if(isset($_SESSION['unseen']) && $_SESSION['unseen']==true){
            echo ' <span style="color:black;" class="position-absolute bottom-6  translate-middle badge rounded-pill bg-light">
                    !
                    <span class="visually-hidden">unread messages</span>
                </span>';
          } ?></a></div>
            <!-- Modal -->
            <div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2"><b><strong>Notification</strong></b></h5>
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
                            <div class="container border  m-0 " style="background-color:aquamarine ;">
                                <span><strong>DATE & TIME</strong></span>
                                <p><?php echo $fetch6['time'];?></p>
                                <h4><?php echo ($new_string . "\n"); ?><br><a href="noti?id=<?php echo $nsn ?>">view
                                        more</a></h4>
                            </div>
                            <?php
              }else{
                 ?>
                            <div class="container border  m-0 ">
                                <span><strong>DATE & TIME</strong></span>
                                <p><?php echo $fetch6['time'];?></p>
                                <h4><?php echo ($new_string . "\n"); ?><br><a href="noti?id=<?php echo $nsn ?>">view
                                        more</a></h4>
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
            <div class="nav-item container d-flex justify-content-center"><a href="settings"><i class="fa fa-gear"
                        style="color:black;"></i></a></div>
        </div>
        <hr class="m-0 mt-1 p-0 ">
        <div class="d-flex flex-row justify-content-center " style="font-size: 2vh ;">
            <p class="m-0 p-0 text-center d-flex  align-items-center">Follow us on social media</p>
            <span><a class="nav-item m-0 m-auto p-0 " href="https://www.facebook.com/Talent-Vale-105729315492389" target="_blank"><img style="width: 5vw; height:auto;"
                        src="footer/facebook2.webp" alt=""></a></span>
            <span><a class="nav-item m-0 m-auto p-0 " href="https://www.instagram.com/talentvale/"><img style="width: 5vw; height:auto;"
                        src="footer/insta2.webp" alt=""></a></span>
            <span><a class="nav-item m-0 m-auto p-0 " href="https://twitter.com/ValeTalent" target="_blank"><img style="width: 5vw; height:auto;"
                        src="footer/twiiter2.webp" alt=""></a></span>
        </div>
        <span style="font-size: 1.2vh ;">
            <div class="text-center"> Copyright &#169; 2022 | Talentvale.com | <strong><a
                        href="mailto:deepanshkushwaha9@gmail.com">Developer Contact</a></strong></div>
        </span>
    </footer>

    <style>
    .footer {
        background: #fc4a1a;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #f7b733, #fc4a1a);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    #f-l {
        color: white;
        font-weight: bold;
    }

    #f-l:link {
        background-color: transparent;
        text-decoration: none;
        font-size: 0.9rem;
    }

    #f-l:hover {
        color: red;
        background-color: transparent;
        text-decoration: underline;
    }

    .cont {
        transform-origin: top right;
        transform: rotate(270deg);
        position: absolute;
        left: -10px;
        color: white;
        margin-right: 10px;
        font-weight: bolder;
    }
    .cont2 {
        transform-origin: top right;
        transform: rotate(270deg);
        position: absolute;
        left: 420px;
        color: white;
        margin-right: 10px;
        font-weight: bolder;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>