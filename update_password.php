<?php require 'session/ss.php' ?>

<?php
$showAlert = false;
$showError = false;
if (isset($_POST['updatepass'])) {
    require 'dbconn/dbconn.php';
    $email = $_GET['id'];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    // Check whether this username exists
    $existSql = "SELECT * FROM `signupinfo` WHERE  email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows = 0) {

        $showError = "No Account found";
    } else {
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `signupinfo` SET `password`='$hash' WHERE email = '$email' ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("location:login?id= 1");
            }
        } else {
            $showError = "Passwords do not match";
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Update New Password</title>
  </head>
  <body>
        

        <div class="container-fluid d-flex flex-column ">
            <h1 class="text-center"> <b> <strong> Generate New Password</strong></b></h1>
            <br>
<div class="container d-flex  justify-content-center  ">
            <form class="d-flex flex-column align-items-cneter  " action="" method="post">
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
            <button type="submit" name="updatepass" style="
            background: #fc4a1a;  
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);  
            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none;  " class="btn btn-primary btn-md rounded-pill" >
            <b> Update</b></button>
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