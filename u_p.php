<?php
 include 'dbconn/dbconn.php';
 require 'session/ssr.php';

$username = $_SESSION['username'];


$select = "SELECT * FROM `signupinfo` WHERE username = '$username'";
$result = mysqli_query($conn , $select);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Your Profile</title>
  </head>
  <body>
    <?php 
    require 'nav/nav.php';


    if(mysqli_num_rows($result) >0){
   $fetch = mysqli_fetch_assoc($result );
                  }          
    ?>
        <div class="cotainer">
          <!-- img cotainer -->
          <div class="container d-flex flex-row justify-content-center  mt-4" > 
            <?php
             if($fetch['img'] == ''){
               echo '<img  src="icons/Group 328.png" alt="img profile">';
             } else{
          echo'<img id="img_profile" src= "'.$fetch['img'].'">';
            }
            ?>
           </div>
            <!-- usrname cont -->
            <div class="container d-flex justify-content-center col-md-6 ">
              <h1>
                <?php echo $fetch['username'] ?>
            </h1>
          
            </div>

            </div> 
            <form action=""  method="POST" enctype="multipart/form-data">
            <div class="container col-md-6 mt-4  main ">
           <div class="container text-center"><h6>Date Of Birth</h6></div>
            <!-- dob container -->
            <div class="container  d-flex flex-column justify-content-center">
            <div class="css-input container d-flex justify-content-center ">
              <!-- <label for="dob">Day</label> -->
                <input type="text" name="day" id="day" value="
                <?php 
                if($fetch['day'] == '0'){
                  echo '--';
                } else{
             echo $fetch['day'];
               }
                ?>">
              
            
            </div>
            <div class="css-input container d-flex justify-content-center ">
              <!-- <label for="dob">Month</label> -->
              <input type="text" name="month" id="month" value=" 
               <?php 
                if($fetch['month'] == '0'){
                  echo '--';
                } else{
             echo $fetch['month'];
               }
                ?>">
              
            </div>
            <div class="css-input container d-flex justify-content-center ">
              <!-- <label for="dob">Year</label> -->
             <input type="text" name="year" id="year" value="  
                <?php 
                if($fetch['year'] == '0'){
                  echo '--';
                } else{
             echo $fetch['year'];
               }
                ?>">
              

            </div>
            </div>
            <!-- skills  -->
            <div class="container d-flex flex-column align-items-center ">
           <label for="skills">Skills</label>
             <div class="css-input container text-center ">
             <input type="text" name="skills" id="skills" value="    
              <?php 
                if($fetch['skills'] == '0'){
                  echo '--';
                } else{
             echo $fetch['skills'];
               }
                ?>"></div>
                <!-- education -->
           <label for="education">Education</label>
           <div class="css-input container text-center ">
            <input type="text" name="education" id="education" value="
              <?php 
                if($fetch['education'] == '0'){
                  echo '--';
                } else{
             echo $fetch['education'];
               }
                ?>"></div>
                <!-- hobbies -->
           <label for="hobbies">Your hobbies</label>   
             <div class="css-input container text-center ">
              <input type="text" name="hobbies" id="hobbies" value="   
              <?php 
                if($fetch['hobbies'] == '0'){
                  echo '--';
                } else{
             echo $fetch['hobbies'];
               }
                ?>"></div>

            </div>
            </div>

            <?php 
    if (isset($_POST['update'])){
        $id = $_GET['id'];
       
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $skills = $_POST['skills'];
        $education = $_POST['education'];
        $hobbies = $_POST['hobbies'];
        $up = "UPDATE signupinfo SET day = $day , month = $month , year = $year, skills ='$skills',hobbies = '$hobbies',  education ='$education'  WHERE sno = $id";
        $uprun = mysqli_query($conn ,$up);
        // header('location:upadate_profile.php');
}
if($uprun){
 echo "<script>('data inserted')</script>";
}
else{
    echo "not done";
}
      ?>

            <!-- button grp -->
            <div class="container d-flex flex-row justify-content-center col-md-6">
              <!-- <a class="btn btn-primary m-2" href="update_profile.php" >Update</a> -->
              <button type="submit" name="update" style="background-color: #F6A62D; border:none; " class="btn btn-primary btn-md " >Update</button>
              <!-- <a class="btn btn-danger m-2" href="logout.php" >Logout</a> -->
            </div>
            </form>
            </div>


<?php
require 'footer/footer.php';
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
      .css-input {
  
     padding: 5px;
     font-size: 20px;
     border-width: 2px;
     border-color: #ec9541;
     background-color: #ffffff;
     color: #0e0e0d;
     border-style: solid;
     border-radius: 19px;
     box-shadow: 1px 2px 6px rgba(66,66,66,.75);
     text-shadow: -32px 0px 26px rgba(66,66,66,.75);
}
 .css-input:focus {
     outline:none;
}

  #img_profile{
    height: 200px;
    width: 200px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 20px auto;
    display: block;
    border: 8px solid #F6A62D;
    border-style: double;

}
    </style>
  
  </body>
</html>