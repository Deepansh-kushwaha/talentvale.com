<?php
include 'dbconn/dbconn.php';
include 'session/ss.php';
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


    <title>Work with us</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
    <h1 class="text-center"><b><strong>Work With us </strong></b></h1>
    <div class="container">
        <div class="container d-flex justify-content-center ">
        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_gzl797gs.json"  background="transparent" 
         speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>

        </div>
        <div class="container col-md-6 mb-4">
            <form class="d-flex flex-column  align-items-center " action="https://formsubmit.co/workwithus@talentvale.com" method="post">
           
            <div class="container form-group ">
                <label for="email"> <b> Email </b></label>
                <input type="email" class="form-control css-input" id="email" name="email" placeholder="Email" aria-describedby="emailHelp" required>
            </div>
            <div class="container form-group ">
                <label for="username"> <b> Fullname </b></label>
                <input type="text"  class="form-control css-input" id="username" name="name" placeholder="Registerd username of talentvale" aria-describedby="emailHelp" required>
            </div>
            <div class="container form-group ">
                <label for="querry"> <b> Your Querry</b></label>
                <textarea class="form-control css-input" name="message" id="querry"  placeholder="Write your querry here."></textarea>
            </div>
            <input type="hidden" name="_template" value="table">
            <input type="hidden" name="_subject" value="New submission! for contact form">
            <input type="hidden" name="_next" value="https://talentvale.com/thanks">
            <input type="hidden" name="_autoresponse" value="Yor querry is submitted we will we reply you soon">
<br>
            <button type="submit"  style="
            background: #fc4a1a;  
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);  
            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none;  " class="btn btn-primary btn-md " >
            <b> Submit </b></button>
        </form>
        </div>
    </div>
    <?php include 'footer/footer.php'; ?>

</body>

</html>