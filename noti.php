<?php
include 'dbconn/dbconn.php';
include 'session/ss.php';
$username = $_SESSION['username'];
$id_noti = $_GET['id'];
$querry9 ="SELECT * FROM `notifications` WHERE sno = '$id_noti' ";
$querry9fire = mysqli_query($conn, $querry9);
// $num6 = mysqli_num_rows($querry6fire);
$fetch9 = mysqli_fetch_assoc($querry9fire);

?>

<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Notifications </title>
  </head>
  <body>
  <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><b><strong>Notifications For <u style="color: green;"><?php echo $username ?></u></strong></b></h1>
        <p class="col-md-8 fs-4"><?php echo $fetch9['message'];?></p>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
$querry8 ="UPDATE `notifications` SET `status` = 'seen' WHERE sno = '$id_noti' ";
$querry8fire = mysqli_query($conn, $querry8);
if($querry8fire){
    echo "message seen";
}
?>    
  </body>
</html>