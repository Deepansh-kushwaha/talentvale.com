<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);
if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $d = $_POST['day'];
  $m = $_POST['month'];
  $y = $_POST['year'];
  $sk = $_POST['skills'];
  $ho = $_POST['hobbies'];
  $ed = $_POST['education'];

  $up = "UPDATE `signupinfo` SET `day` = '$d', `month` = '$m', `year` = '$y', `skills` = '$sk', `hobbies` = '$ho', `education` = '$ed' WHERE `signupinfo`.`sno` = $id";
  $uprun = mysqli_query($conn, $up);
  header("location:profile");
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

  <title>update profile</title>
</head>

<body>

  <?php require 'nav/nav.php'; ?>
  <div class="container d-flex flex-column justify-content-center ">
    <h1 class="text-center">Update Profile</h1>
    <div class="container col-lg-6  m-auto">
      <form class="d-flex flex-column  " action="" method="POST">
        <label for="day">Day</label>
        <input type="text" name="day" id="day" class="form-control" placeholder="(current)   <?php echo $_GET['d']; ?> " required>
        <label for="month">Month</label>
        <input type="text" name="month" id="month" class="form-control" placeholder="(current)   <?php echo $_GET['m']; ?> " required>
        <label for="year">Year</label>
        <input type="text" name="year" id="year" class="form-control" placeholder="(current)   <?php echo $_GET['y']; ?> " required>
        <label for="skills">Skills</label>
        <input type="text" name="skills" id="skills" class="form-control" placeholder="(current)   <?php echo $_GET['sk']; ?> " required>
        <label for="hobbies">Hobbies</label>
        <input type="text" name="hobbies" id="hobbies" class="form-control" placeholder="(current)   <?php echo $_GET['ho']; ?> " required>
        <label for="education">Education</label>
        <input type="text" name="education" id="education" class="form-control" placeholder="(current)   <?php echo $_GET['ed']; ?> " required>

        <button type="submit" name="update" id="update" class="btn btn-success m-2">Update</button>
        <button class="btn btn-primary m-2"> <a href="profile" style="text-decoration: none; color:white;">GO Back</a></button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <?php require 'footer/footer.php'; ?>
</body>

</html>