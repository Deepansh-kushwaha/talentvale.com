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


    <title>Settings</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
    <h1 class="text-center"><b><strong>Settings</strong></b></h1>
    <div class="container">
        <div class="container d-flex justify-content-center ">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_EHugAD.json" background="transparent"
                speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        </div>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="aboutus">
                <h4><strong>About us</strong></h4>
            </a>
        </div>
        <hr>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="founders">
                <h4><strong>Founders</strong></h4>
            </a>
        </div>
        <hr>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="t&c">
                <h4><strong>Terms and condition </strong></h4>
            </a>
        </div>
        <hr>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="wwu">
                <h4><strong>Work with us </strong></h4>
            </a>
        </div>
        <hr>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="contactus">
                <h4><strong>Contact us </strong></h4>
            </a>
        </div>
        <hr>
        <div class="container d-flex  m-2  ">
            <img class="m-2" src="icons/black/Quote@2x.png" alt="">
            <a href="privacyp">
                <h4><strong>Privacy policy </strong></h4>
            </a>
        </div>
        <hr>
    </div>
    <?php include 'footer/footer.php'; ?>

</body>

</html>