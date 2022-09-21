<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);
$username = $_SESSION['username'];
$cmid = $_GET['id'];
$sql = "SELECT * FROM `comment` WHERE pst_id = $cmid";
$sqlrun = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
   <div class="container">
       <div class="row">
           <div class="col-2">

               <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><button class="btn btn-sm  m-2 "><img src="icons/black/Backward arrow small@2x.png" alt=""></button></a>
           </div>
           <div class="col-10 p-0 pe-5">
               <h1 class="text-center">comments</h1>
           </div>
<hr>
<?php 
if ($_SESSION['cmtdel'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success</strong> Comment deleted successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
unset($_SESSION['cmtdel']);
?>
          <div class="container">
            <?php
            $num = mysqli_num_rows($sqlrun);
            if($num > 0){

            
            foreach($sqlrun as $cm){
                $uname = $cm['user_id'];
                $sql2 = "SELECT * FROM `signupinfo` WHERE `username` = '$uname' ";
                $sql2run = mysqli_query($conn, $sql2);
                $s2fetch = mysqli_fetch_assoc($sql2run);
                ?>      
                <div class="row row-cols-3 mb-3">
                    <div class="conatner col-2 ">
                    <div class="container d-flex justify-content-center align-items-center p-0 m-0 ">
                                    <a href="vprofile?id=<?php echo $product['username']; ?>"><?php
                                                                                                    if ($s2fetch['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $s2fetch['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                </div>
                    </div>
                    <div class="conatner col-7 p-0">
                        <div class="container" style="color:gray ;"><h6><b><strong><?php echo $cm['user_id'] ; ?></strong></b></h6></div>
                        <div class="container text-center p-0 "><small><b><?php echo $cm['msg'] ; ?></b></small></div>
                    </div>
                    <div class="container col-3 p-0 d-flex flex-column align-items-center">
                        <small style="color:gray ;" ><?php echo $cm['commented_on'] ; ?></small >
                        <?php
                        if($username == $uname){
                        ?>
                        <form action="ajax" method="POST">
                        <button class="btn" name="delcmt" value="<?php echo $cmid ;?>" ><i style="color:red;" class="fas fa-trash-alt"></i></button>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>


<hr>    

              <?php
            }
        }else{
            echo '<div class="container text-center "><b>no comments yet</b></div>';
        }

            ?>

          </div> 
       </div>

   </div>



<?php
include 'footer/footer.php';
?>

<style>
     #img_profile {
                height: 3.5em;
                width: 3.5em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }


</style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>