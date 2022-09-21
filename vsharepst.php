<?php
include 'dbconn/dbconn.php';
error_reporting(0);
$pname = $_GET['id'];
$row ="SELECT * FROM `posts` WHERE sno = '$pname'  ";
$rowfire = mysqli_query($conn, $row);
$product = mysqli_fetch_assoc($rowfire);
$numrow = mysqli_num_rows($rowfire);
$cname = $product['username'];

$querry10 = "SELECT * FROM `signupinfo` WHERE username = '$cname'";
$querry10fire = mysqli_query($conn, $querry10);
$profile = mysqli_fetch_assoc($querry10fire);

   $sdet = $product['description'];
   $simt = $product['postimg'];         
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://talentvale.com/vsharepst?id=<?php echo $pname ; ?>&cid=<?php echo $cname ?>"/>
    <meta property="og:title" content="Welcome to talentvale.com"/>
    <meta property="og:description" content="<?php echo $sdet ;?>"/>
    <meta property="og:image" content="https://talentvale.com/<?php echo $simt;?>"/>
    <meta property="og:image:secure url" content="https://talentvale.com/<?php echo $simt;?>"/>
    <link rel="img src" href="https://talentvale.com/<?php echo $simt;?>" type="image/x-icon">
    <meta property="og:site_name" content="talentvale.com"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta property="fb:app_id" content="618785932454978"/>
    <meta name="twitter:image" content="https://talentvale.com/<?php echo $simt;?>"/>
    <meta name="twitter:title" content="Welcome to talentvale.com"/>
    <meta name="twitter:description" content="<?php echo $sdet ;?>"/>
    <meta name="twitter:site" content=""/>
    <!-- Bootstrap CSS -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $cname ?></title>
  </head>
  <script>
    window.onload = function() {
        document.getElementById('loader').style.display = "none";
        document.getElementById('content').style.display = "block";
    };
</script>
<style>
    #content {
        display: none;
    }

    #loader img {
        width: 300px;

    }
</style>
  <body>
      <?php include 'nav/nav.php'?>
      <div id="loader">
        <div class="d-flex justify-content-center m-auto">
            <img src="eb7e7769321565.5ba1db95aab9f.gif" alt="loader">
        </div>
    </div>
<span id="content">
 <div class="container morph mt-2 mb-2 col-md-6">
 <div class=" d-flex      row row-cols-3">
                                <div class="container d-flex justify-content-center align-items-center p-0 m-0 ">
                                    <a href="login"><?php
                                                                                                    if ($profile['img'] == '') {
                                                                                                        echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile" src= "' . $profile['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                </div>
                                <div class="container d-flex flex-column  justify-content-center align-items-center text-center m-0 p-0">
                                    <div class="d-flex">
                                        <div class="container m-0 p-0"><small class="m-0"><strong><b><?php echo $profile['firstname']; ?></b></strong></small>
                                        </div>
                                        <div class="container m-0 ms-1 p-0"><small class="m-0"><strong><b><?php echo $profile['lastname']; ?></b></strong></small>
                                        </div>
                                    </div>
                                    <small style="color:gray ;"><b>@<?php echo $product['username']; ?></b></small>
                                </div>
                                <?php
                                if ($product['username'] == $username) {
                                ?>
                                    <div class="container d-flex justify-content-center align-items-center m-0 p-0">
                                        <div class="dropdown me-1">
                                            <div type="button" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                                                <img src="icons/black/Options@2x.png " alt="">
                                            </div>
                                            <ul class="dropdown-menu rounded-pill m-0 p-0" aria-labelledby="dropdownMenuOffset">
                                                <form action="ajax" method="POST">
                                                    <input type="hidden" name="posd" id="posd" value="<?php echo $product['sno']; ?>">
                                                    <input type="hidden" name="delimg" id="delimg" value="<?php echo $product['postimg']; ?>">
                                                    <button type="submit" id="demo" name="delpos" class="dropdown-item text-center rounded-pill" onclick="myFunction()" style="color:white;background-color:#fc4a1a">
                                                    <b> DELETE POST</b>
                                                </button>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <hr class="m-0 mt-1">
                            <!-- posts in mains  -->
                            <div class="conainer photos d-flex justify-content-center ">

                                <?php
                                if ($product['postimg'] == '') {
                                    echo '<div class="container"> <p class="text-center" style="word-wrap: break-word;">' . $product['text'] . '</p></div>';
                                } else {
                                    echo '<img class="posti" src="' . $product['postimg'] . '" alt="">';
                                }
                                ?>



                            </div>

                            <div class="container description mt-2">
                                <h6><strong><?php echo $product['description']; ?></strong></h>
                            </div>

                            <hr class="m-0 mt-1">
                            <span>
                         
                                <span class="  dropend">
  <button  style="border:none; background-color:white; font-size:x-large;" class="" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="far fa-paper-plane"></i>
  </button>
  <span class="dropdown-menu m-0 p-0" style="border:none;">
  <ul class=" list-group list-group-horizontal  rounded-circle ">
    <!-- Dropdown menu links -->
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://api.whatsapp.com/send?phone=&text=<?php echo urlencode($sdet)?>http://talentvale.com/vsharepst?id=<?php echo $ssnot ; ?>" target="_blank"><i style="color:limegreen; " class="fab fa-whatsapp"></i> Whatsapp</a> </li>
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://twitter.com/share?text=<?php echo $sdet ;?>&url=https://talentvale.com/vsharepst?id=<?php echo $ssnot;?>&hashtags=#PHP" target="_blank"><i style="color: skyblue; " class="fab fa-twitter"></i> Twitter</a> </li>
    <li class="list-group-item m-0 ms-1 me-1 rounded-pill shadow-lg" ><a style="color:black; text-decoration:none; "href="https://facebook.com/sharer?u=https://talentvale.com/vsharepst?id=<?php echo $ssnot ; ?>" target="_blank"><i style="color: blue; " class="fab fa-facebook"></i> Facebook</a> </li>
  </ul>
  </span>
                            </span>
                            </span>
 </div>


</span> 
    <?php include 'footer/footer.php'?>
<script src="custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
   #img_profile {
                height: 4em;
                width: 4em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }


            .posti {
                width: 50%;
                height: 50%;
            }
            .morph {
                background: rgba(255, 255, 255, 1);
                border-radius: 15px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }

    </style>


  </body>
</html>