<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
$sql3 ="SELECT * FROM `events` ";
$sql3run = mysqli_query($conn, $sql3);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Events</title>
  </head>
  <body>
      <?php include 'nav/nav.php'?>
      <h1 class="text-center"><strong>Up coming events </strong></h1>
      <div class="container">
          <?php
          if($num = mysqli_num_rows($sql3run) != 0 ){
          foreach($sql3run as $sqlfetch ){
          ?>
       <div class="container border  " >
           <h3 class="m-2 ms-4"><b><?php echo $sqlfetch['event_name'];?></b></h3>
           <div class="container-fluid d-flex m-0 p-0">
              <div class="container d-flex flex-column justify-content-center m-0 p-0"> 
                  <div class="container  d-flex justify-content-center m-0 p-0 "><p><?php echo $sqlfetch['event_message'] ?>
              <!-- <a href="">view more</a> -->
            </p></div>
        <div class="container d-flex align-items-center"><a href="evregis?e=<?php echo $sqlfetch['sno'] ?>"><b> Register for event</b></a></div>
        </div>

              <div class="container-fluid d-flex flex-column alig-items-center text-end m-0 p-0"> 
                 <div class="container-fluid m-0 p-0 ">  <span><strong>Started at </strong></span> <p><?php echo $sqlfetch['time'];?></p></div>
                 <div class="container d-flex justify-content-end m-0 p-0"> <h6>STATUS :- </h6><h6 style="color: green;"> <?php echo $sqlfetch['event_status'];?></h6></div>
                </div>

                     </div>
        </div>
        <?php
          }
    }else{
              ?>
            <div class="container">
           NO UP COMING EVENTS
        </div>
        <?php
          }
        
        ?>
      </div>
    <?php include 'footer/footer.php'?>
   
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
        width: 100%;
        height: auto;
        
    }
    </style>


  </body>
</html>