<?php
error_reporting(0);
include 'dbconn/dbconn.php';
include 'session/ssr.php';
$username = $_SESSION['username'];
$event_id = $_GET['e'];
$sql6 ="SELECT * FROM `signupinfo` WHERE `username` = '$username' ";
$sql6run = mysqli_query($conn, $sql6);
$fetch6sql= mysqli_fetch_assoc($sql6run);
$mail = $fetch6sql['email'];
$sql3 ="SELECT * FROM `events` WHERE sno = $event_id ";
$sql3run = mysqli_query($conn, $sql3);
$fetch3sql= mysqli_fetch_assoc($sql3run);
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Events Registration</title>
  </head>
  <body>
      <?php include 'nav/nav.php'?>
      <?php
       $deleted = $_GET['id'];
       if ($deleted == "notuser") {
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>User Account Not Detected</strong>.
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
       }
      ?>
      <!-- <h1 class="text-center"><strong>Register for this event</strong></h1> -->
      <div class="container">
      <h1 class="container text-center"><b> Registration period ends in</b></h1>
      <h1 class="container text-center" style="color:#f7b733;" id="demo">  </h1>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $fetch3sql['st_time'] ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "ENDED";
    document.getElementById("regis").style.display = "none";
    document.getElementById("txt").style.display = "block";
  }
}, 1000);
</script>
<?php
$sql5 ="SELECT * FROM `user_eve_regis` WHERE `user_mail` = '$mail' ";
$sql5run = mysqli_query($conn, $sql5);
$fetch5sql= mysqli_fetch_assoc($sql5run);
if(mysqli_num_rows($sql5run) != 1){
?>
<!-- for registration -->
 <div class="containter mt-4" id="regis">
 <form class="d-flex flex-column  align-items-center"  action="deluser?id=<?php echo $event_id ?>" method="POST">
               
            <div class="container form-group col-md-6 text-center">
                <label for="email" > <b> email </b></label>
                <input type="email"  class="form-control css-input" id="email" name="email" placeholder="Email" required>
                <input type="hidden"  class="form-control css-input" id="evename" name="evename" value="<?php echo $fetch3sql['sno'] ?>" required>
            </div>         
<br>
            <button type="submit" name="regisuser" style="
            background: #fc4a1a;  
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a);  
            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none;  " class="btn btn-primary btn-md " >
            <b> Register </b></button>
  </form>
 </div>
 <div class="container text-center" id="txt">
   Resistration period is over for this event
 </div>
 <?php
}else{
  echo '<div class="containter text-center"><h3>Already registered for this event</h3></div>';
}
 ?>
 <div class="containter text-center mt-4">
   <h2><b><strong>About This Event</strong></b></h2>
   <center><?php echo $fetch3sql['event_message']?></center>
 </div>
      </div>
    <?php include 'footer/footer.php'?>
   
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
      #txt{
        display: none;
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
    .post_img{
        object-fit: scale-down;
        width: 100%;
        height: auto;
        
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