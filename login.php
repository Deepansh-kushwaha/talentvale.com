<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'dbconn/dbconn.php';
    $username = strtolower($_POST["username"]);
    // $email = $_POST["email"];
    $password = $_POST["password"]; 
     
    $sql =  "SELECT * FROM `signupinfo` WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row= mysqli_fetch_assoc($result)){
            if($row['userstat'] == 'active'){
            if (password_verify($password, $row['password'])){ 
               
                session_start();
                session_regenerate_id(true);
                $sql2 =  "SELECT * FROM `signupinfo` WHERE username = '$username' OR email = '$username'";
                $result2 = mysqli_query($conn, $sql2);
                $fetch = mysqli_fetch_assoc($result2);
                $login = true;
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['ROLE']= $row>'role';
                if($row['role']==1){
                    $_SESSION['ROLE'] = true ;
                }
                else{
                    $_SESSION['ROLE'] = false ;
                }

               $redirect_link=$_REQUEST['page_url'];
               if($redirect_link==""){
                   header("location: .$redirect_link ");

               }
            } 
            else{
                $showError = "*Invalid Credentials*";
            }
        }
        else{
            $showError = "*You are blocked by admin*";
            header("location:blocked");
        }
        }
        
    } 
    else{
        $showError = "*Invalid Credentials*";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Start your journey to talentvale and see the magic in your life">
    <meta name=”robots” content=”index, follow”>
    <meta name="keywords" content="talent ,vaale ,vale, talentvale login ,talentvale signup, build ,portfolio,join talentvale.com, join , talentvale.com,talentvaale, wale, talent waale, talentvalue, show login
 ,chat, chat with your friends,deepansh kushwaha ,kushwaha , deepansh, kushwaha deepansh">
  <meta name="author" content="Deepansh kushwaha">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <title>login to Talentvale.com </title>
</head>

<body>

    <?php
    error_reporting(0);
$alert =$_GET['id'];
?>
    <div  class="d-flex flex-column justify-content-center "  > 
         <img  src="nav/talent-vale-logo.webp" style="width:300px; margin:8px 0 0 8px"  alt="">
         <div class="container">
<div class="row row-cols-2 mt-4 fiscnt" >
 <div class="conatainer  col-6 m-0 p-0">
  <div class="container col-10 ">
      <div class="container">
      <h1 class="text-center"><b><strong>Show Your Talent</strong></b></h1>
      <div class="container">
          <h4 style="color:#F5A200;">Why to go anywhere</h4>
          <p><b> If you ara a person having some skills and want to show it just join talentvale.com and show your amazing here </b></p>
          </div>
    </div>
  </div>
 </div>
    <div class="container  ">
        <div class="container d-flex flex-column align-items-center  p-0">
            
      <?php  if($_SESSION['mailsent']== true){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong>Success</strong> We have sent you a mail on your registerd mail address to rest your password.
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
 }
     unset($_SESSION['mailsent']);
 ?>
   
   <button  class="btn btn-md col-md-6 " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 
            background: linear-gradient(to right, #f7b733, #fc4a1a); border-radius:50px; ">
                    <b><a href="signup" style=" text-decoration:none; color:white;"> Create account</a></b>
                </button>
   <form class="d-flex flex-column  col-md-6 " action="login" method="post">
                <div class="form-group col-md-12 mb-2 mt-2 ">
                    <!-- <label for="username"><b>Username</b></label> -->
                    <input type="text"  class="form-control css-input" id="username" name="username"
                        placeholder="Username / Email" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group col-md-12 mb-2 mt-2">
                    <!-- <label for="password"> <b> Password</b></label> -->
                    <input type="password" minlength="4" maxlength="23" class="form-control css-input" id="password"
                        name="password" placeholder="Password" required>
                </div>

                <?php 
             if($showError){
                echo '<strong  class="text-center" style="color: red"> '. $showError .'</strong>';
             }
            ?>
                
                    <button type="submit" class="btn btn-md col-md-12" style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border-radius:50px; color:white;  ">
                    <b> Let's Do It </b>
                </button>
            </form>

            <?php
         if($alert == 1){
             echo '<strong class="text-center"  style="color: red;">Your Account Is Created <br> You Can Login Now</strong>';
         }
        ?>
        <h6 class="text-center col-6 ">Forgot password  <strong><a href="restore">Click Here</a></strong></h6>
           
        
            
        </div>
    </div>
    </div>
    <!--second  container  -->
<div class="row  mt-4 sndcnt" >
 <div class="conatainer  m-0 p-0">
  <div class="container col-12 ">
      <div class="container">
      <h1 class="text-center"><b><strong>Show Your Talent</strong></b></h1>
      <div class="container">
          <h4 style="color:#F5A200;">Why to go anywhere</h4>
          <p><b> If you ara a person having some skills and want to show it just join talentvale.com and show your amazing here </b></p>
          </div>
    </div>
  </div>
 </div>
    <div class="container  ">
        <div class="container d-flex flex-column align-items-center  p-0">
            
      <?php  if($_SESSION['mailsent']== true){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong>Success</strong> We have sent you a mail on your registerd mail address to rest your password.
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
 }
     unset($_SESSION['mailsent']);
 ?>
   
   <button  class="btn btn-md col-8 mt-2 " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 
            background: linear-gradient(to right, #f7b733, #fc4a1a); border-radius:50px; ">
                    <b><a href="signup" style=" text-decoration:none; color:white;"> Create account</a></b>
                </button>
   <form class="d-flex flex-column  col-8 " action="login" method="post">
                <div class="form-group col-md-12 mb-2 mt-2 ">
                    <!-- <label for="username"><b>Username</b></label> -->
                    <input type="text" class="form-control css-input" id="username" name="username"
                        placeholder="Username / Email" required>
                </div>
                <div class="form-group col-md-12 mb-2 mt-2">
                    <!-- <label for="password"> <b> Password</b></label> -->
                    <input type="password" minlength="4" maxlength="23" class="form-control css-input" id="password"
                        name="password" placeholder="Password" required>
                </div>

                <?php 
             if($showError){
                echo '<strong  style="color: red"> '. $showError .'</strong>';
             }
            ?>
                
                    <button type="submit" class="btn btn-md col-md-12" style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border-radius:50px; color:white;  ">
                    <b> Let's Do It </b>
                </button>
            </form>

            <?php
         if($alert == 1){
             echo '<strong class="text-start"  style="color: red;">Your Account Is Created <br> You Can Login Now</strong>';
         }
        ?>
        <h6 class="text-center col-6 ">Forgot password<strong><a href="restore">Click Here</a></strong></h6>
           
        
            
        </div>
    </div>
    </div>
    </div>
    <div class="cotainer">
        <div class="container mt-5">
            <h2 class="text-center" style="color:#F5A200 ;">Why Choose Us</h2>
            <div class="container mt-4 mb-4">
                <div class="row row-cols-3">
                    <div class="container text-center d-flex flex-column justify-content-center">
                        <div class="container">
                            <img src="icons/upload.webp" style="height:60px;" alt="">
                        </div>
                        <h5 style="color:#F5A200 ;">Create Portfolio</h5>
                        <p>Just create your amazing portfolio and share it with others</p>
                    </div>
                    <div class="container text-center d-flex flex-column justify-content-center">
                        <div class="container">
                            <img src="icons/volunteer.webp" style="height:60px;" alt="">
                        </div>
                        <h5 style="color:#F5A200 ;">Participate in events</h5>
                        <p>Participate in events and compete with skillfull peoples around you </p>
                    </div>
                    <div class="container text-center d-flex flex-column justify-content-start">
                        <div class="container">
                            <img src="icons/cret_1.webp" style="height:60px;" alt="">
                        </div>
                        <h5 style="color:#F5A200 ;">Get certificate</h5>
                        <p>At the end of the event you will be certified</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
  require 'footer/footer.php';
  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

<style>


.css-input {
    border-radius: 18px;
}

.sndcnt{
    display: none;
}
@media only screen and (max-width:829px) {
   
    .sndcnt{
    display: block;
}
    .fiscnt{
        display: none;
    }
    
}
</style>

</html>