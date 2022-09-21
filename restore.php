<?php
require 'dbconn/dbconn.php';

if (isset($_POST['recover'])) {
    $templatefile ="mailtem2.php";
    $email = $_POST["email"];
    $sql = "SELECT email FROM `signupinfo` WHERE email = '$email'";
    $sqlrun = mysqli_query($conn , $sql);
    if(mysqli_num_rows($sqlrun)>0){
    $swap_var = array(
        "{to_name}" =>"$email",
        "{coustom_url}" => "https://talentvale.com/update_password?id=$email"
    );

    $subject = "Recover your passord";
    if(file_exists($templatefile)){
    $body = file_get_contents($templatefile);
    }else{
        die("unable to locate email temp file");
    }
    foreach(array_keys($swap_var) as $key){
        if(strlen($key)>2 && trim($key) != ""){
            $body= str_replace($key, $swap_var[$key], $body);
        }
    }
    $headers = "From:talentvale.help@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if (mail($email, $subject, $body, $headers)) {
        echo "Email successfully sent to $email...";
        $_SESSION['mailsent'] = true;
        header('Refresh: 5; URL=http://localhost/talentvale.com/login');
    } else {
        echo "Email sending failed...";
    }
}else{
    echo "enter a valid email..";
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lost password of talentvale , no worries ,we got you">
    <meta name=”robots” content=”index, follow”>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Recover your password </title>
</head>

<body>


    <div class="container">
        <div class="container-fluid d-flex align-items-center flex-column ">
            <img class="mt-2" src="nav/talent vale logo.png" style="height:80px; width:350px;" alt="">
            <br>

            <form class="d-flex flex-column  align-items-center" action="" method="POST">
                <div class="form-group text-center ">
                    <label for="username" ><b>Email</b></label>
                    <input type="email" class="form-control css-input" id="email" name="email" placeholder="Enter your registerd email" required>
                </div>
                <br>
                <button type="submit" name="recover" class="btn btn-md " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); ">
                    <b> Send Mail </b>
                </button>
            </form>
            <hr>
            <h5 class="text-center p-1"> IF NOT registered <strong><a href="signup"> Kindely signup</a></strong>
            </h5>
        </div>
    </div>
    <?php
    require 'footer/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

<style>
    body {
        background-image: url("icons/wave (1).svg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .css-input {
        border-radius: 18px;
    }
</style>

</html>