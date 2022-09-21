<?php require 'session/ss.php' ?>

<?php
$showAlert = false;
$showError = false;
if (isset($_POST['signup'])) {
    require 'dbconn/dbconn.php';
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $username = strtolower($_POST["username"]);
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
$checkpass = strtolower($_POST["password"]);

    // Check whether this username exists
    $existSql = "SELECT * FROM `signupinfo` WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {

        $showError = "Username or email Already Exists kindly login";
      
    } else {
        if($username == $checkpass){
            $showError = "*Username or Password can't be same*";
        }else{
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signupinfo` (`username`, `firstname`, `lastname`, `email`, `phone`, `password`, `date`)  VALUES ('$username','$firstname','$lastname','$email','$phone','$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                $templatefile ="mailtem2.php";
                $swap_var = array(
                    "{to_name}" =>"$email",
                    "{coustom_url}" => "",
                );
            
                $subject = "WELCOME TO TALENTVALE.COM";
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
                    header('Refresh:2; URL=http://talentvale.com/login');
                } 
            
                header("location:login?id= 1");
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
    }
}

?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="If you are a talented person just signup to talentvale and see the magic in your life">
    <meta name=”robots” content=”index, follow”>
    <meta name="keywords" content="talent ,vaale ,vale, talentvale login ,talentvale signup, build ,portfolio,join talentvale.com, join , talentvale.com,talentvaale, wale, talent waale, talentvalue, show login
 ,chat, chat with your friends,deepansh kushwaha ,kushwaha , deepansh, kushwaha deepansh">
  <meta name="author" content="Deepansh kushwaha">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign up to Talentvale.com </title>
  </head>
  <body>
        

        <div class="container-fluid d-flex flex-column">
            <h1 class="text-center"> <b> <strong> Create Your Account </strong></b></h1>
            <br>
<div class="container col-md-6  ">
            <form class="d-flex flex-column  align-items-center " action="signup" method="post">
                <div class="container form-group  d-flex  ">
               
                <input type="text" maxlength="11" class="form-control css-input " id="firstname" name="firstname" placeholder="Firstname" aria-describedby="emailHelp" required>
                
                <input type="text" maxlength="11" class="form-control css-input " id="lastname" name="lastname" placeholder="Lastname" aria-describedby="emailHelp" required>
             
            </div>
                <div class="container form-group ">
                <label for="username"> <b> Username </b></label>
                <input type="text" maxlength="11" class="form-control css-input" id="username" name="username" placeholder="Remember username for login" aria-describedby="emailHelp" required>
            </div>
            <div class="container form-group ">
                <label for="email"> <b> email </b></label>
                <input type="email" class="form-control css-input" id="email" name="email" placeholder="Email" aria-describedby="emailHelp" required>
            </div>
            <div class="container form-group ">
                <label for="phone"> <b> Phone Number </b></label>
                <input type="text" maxlength="12" class="form-control css-input" id="phone" name="phone" placeholder="Phone no" aria-describedby="emailHelp">
            </div>
            <div class="container form-group ">
                <label for="password"> <b> Password </b></label>
                <input type="password" minlength="6" maxlength="11" class="form-control css-input" id="password" name="password" placeholder="password" required>
            </div>
            <div class="container form-group ">
                <label for="cpassword"> <b> Confirm Password </b></label>
                <input type="password" class="form-control css-input" id="cpassword" name="cpassword" placeholder="Be sure to type the same password" required>
            </div>
            <?php 
             if($showError){
                echo '<strong  style="color: red"> '. $showError .'</strong>';
             }
            ?>
<br>
            <button type="submit" name="signup" style="
            background: #fc4a1a;  
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);  
            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none;  " class="btn btn-primary btn-md " >
            <b> SignUp </b></button>
        </form>
        </div>
<hr>
        <h2 class="text-center p-1"> IF Already registered <strong><a href="login"> login</a></strong> </h2>
    </div>
        </div>

<?php
  require 'footer/footer.php';
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <style>
  body{
       background-image: url("icons/wave.svg")   ;
       background-repeat: no-repeat;  
       background-size: cover; 
       background-position: center; 
     } 
.css-input {

padding: 5px;
padding-left: 10px;
font-size: 18px;
margin-top: 2px;
border-radius: 14px;

}

.css-input:focus {
outline: none;
}
    </style>

  </body>
</html>