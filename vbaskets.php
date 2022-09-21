<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
$pname = $_GET['id'];
$cname = $_GET['cid'];
// $querry10 = "SELECT * FROM `signupinfo` WHERE username = '$pname'";
// $querry10fire = mysqli_query($conn, $querry10);
// $profile = mysqli_fetch_assoc($querry10fire);
$row ="SELECT * FROM `posts` WHERE username = '$pname' ORDER BY `sno` DESC ";
            $rowfire = mysqli_query($conn, $row);
            $numrow = mysqli_num_rows($rowfire);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $pname ?></title>
  </head>
  <body>
      <?php include 'nav/nav.php'?>
      <h1 class="text-center"><strong>Category for <?php echo $cname; ?></strong></h1>

      <?php
       $filtervalues= $_GET['cid'];
       $querry17 ="SELECT * FROM `posts` WHERE CONCAT(category) LIKE '%$filtervalues%' && `username` = '$pname' ";
       $querry17fire =mysqli_query($conn, $querry17);
       $num17 =mysqli_num_rows($querry17fire);

      ?>
    <div class="container mt-3 ">
    <div  class="container mt-4 mb-4">
            <div class="container col-md-10 col-lg-8 ">      
                <?php 
             if($num17 > 0){
                 ?>
                 <div class="row row-cols-3 row-cols-sm-4 row-cols-md-4 ">
                     <?php
         while($post1 = mysqli_fetch_assoc($querry17fire)){

         ?> 
        <div class=" d-flex justify-content-center m-0 p-0" data-bs-toggle="modal" data-bs-target="#vpimg<?php echo $post1['sno'] ?>">
  
                <img style="height: 100px;" class="post_img rounded border shadow-lg " src="<?php echo $post1['postimg']; ?>" alt="">
       
        </div>
         <!-- Modal for view post -->
<div class="modal fade" id="vpimg<?php echo $post1['sno'] ?>" tabindex="-1" aria-labelledby="vimg" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
          <div class="container">
            <?php
             
             ?>
            <div class="container">
              <img class="post_img rounded border" src="<?php echo $post1['postimg']; ?>" alt="">
            </div>
            <div class="container" >
                    <?php
                     $sql3 = "SELECT * FROM `likes` WHERE `post_no` = $po_no ";
                     $sql3run = mysqli_query($conn, $sql3);
                     $num3row = mysqli_num_rows($sql3run);
                    ?>    
                    <small  data-toggle="modal" data-target="#like<?php echo $row_id ?>" ><b> Likes</b></small> <strong> <?php echo $num3row ?></strong>
                </div>
            <div class="container">comments</div> 
          </div>
      </div>
    </div>
  </div>
</div>
        <?php
         }
        ?>
        </div>
        <?php
        
          }else{
              echo '<div class="container-fluid text-center "><h3 ><i> No Post Yet</i></h3></div>';
            }
        ?>
     
            </div>
        </div>

    </div>

    <?php include 'footer/footer.php'?>
<script src="custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
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
        width: 10px;
        height: auto;
        
    }
    </style>


  </body>
</html>