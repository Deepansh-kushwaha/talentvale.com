<?php
include 'dbconn/dbconn.php';

$pname = $_GET['id'];
$querry10 = "SELECT * FROM `signupinfo` WHERE username = '$pname'";
$querry10fire = mysqli_query($conn, $querry10);
$profile = mysqli_fetch_assoc($querry10fire);
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
    <script src="jquery-3.6.0.js" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $pname ?></title>
  </head>
  <script>
    window.onload=function(){
    document.getElementById('loader').style.display="none";
    document.getElementById('content').style.display="block";
    };
</script>
<style>
    #content{
        display: none;
    }
    #loader img{
        width: 300px;
       
    }
</style>
  <body>
      <?php include 'nav/nav.php';
      $username = $_SESSION['username'];
      ?>
      <div id="loader" >
        <div class="d-flex justify-content-center m-auto">
        <img src="eb7e7769321565.5ba1db95aab9f.gif" alt="loader">
        </div>
    </div>
      <span id="content">
    <div class="container mt-3 ">
        <div class="row align-items-md-stretch  ">
            <!-- profile img -->
            <div class="container d-flex  align-items-center col-md-6">
            <?php
      if ($profile['img'] == '') {
        echo '<img  class="shadow"  src="icons/Group 328.png" id="img_profile">' ;
      } else {
        echo '<img class="shadow" id="img_profile" src= "' . $profile['img'] . '">';
      }
  ?>
            </div>

            <div class="container d-flex flex-column justify-content-center align-items-center col-md-6">
                <div class="container d-flex  align-items-center">
            <div class="container text-center shadow-sm rounded-3">
                <h3 style="color:gray ;"> <?php echo "$numrow" ?></h3>
                <h6> <strong> Posts</strong></h6>
            </div>
            <?php
            $sql2 = "SELECT * FROM `follow` WHERE follower_name ='$username'";
            $sql2run = mysqli_query($conn, $sql2);
            $num2row = mysqli_num_rows($sql2run);
            $sql3 = "SELECT * FROM `follow` WHERE `user_name` ='$username'";
            $sql3run = mysqli_query($conn, $sql3);
            $num3row = mysqli_num_rows($sql3run);
            ?>
            <div class="container text-center shadow-sm rounded-3">
                <h3  style="color:gray ;"> <?php echo $num3row;?></h3>
                <h6> <strong> Followers</strong></h6>
            </div>
            <div class="container text-center shadow-sm rounded-3">
                <h3  style="color:gray ;"> <?php echo $num2row;?></h3>
                <h6> <strong> Following</strong></h6>
            </div>
            </div>
            <div class="contianer d-flex mt-4 align-items-center ">
            <div class="row  ">
              <div class="d-flex justify-content-center">
                                <div class="container m-0 p-0"><h2 class=" text-end m-0"><strong><b><?php echo $profile['firstname']; ?></b></strong></h2>
                                </div>
                                <div class="container m-0 ms-1 p-0"><h2 class="m-0"><strong><b><?php echo $profile['lastname']; ?></b></strong></h2>
                                </div>
                                </div>   
            <h6 class="text-center" style="color:gray ;"><b><strong><?php echo $profile['username'];?></strong></b></h6>
            </div>
            <?php
            $querry12 = "SELECT * FROM `follow` WHERE  `follower_name` = '$username' && `user_name`= '$pname'";
            $querry12fire = mysqli_query($conn ,$querry12);
            $num12 = mysqli_num_rows($querry12fire); 
            ?>
 
<?php
 if($pname != $_SESSION['username']){
  ?>
  <a href="chat?u=<?php echo $pname;?>"><button   style=" background: #fc4a1a; 
  background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

  background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px"
   class="btn btn-md ms-4"><strong> Message</strong></button> </a>
   <?php
      if($num12 != 1){
        
        ?>
        <button   style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px"
             class="btn btn-md ms-4 followbtn" data-user-id ='<?php echo $pname ?>'><strong> Follow</strong></button> 
      <?php
      }else{
        ?>
        <button   style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px"
             class="btn btn-md ms-1 unfollowbtn" data-unfollow-id ='<?php echo $pname?>'><strong> Unfollow</strong></button> 

        <?php
      }
    }else{
      '';
    }
    
    $querry15 ="SELECT * FROM `category` WHERE `user_name` = '$pname'";
    $querry15run = mysqli_query($conn, $querry15);
    $fetch15 = mysqli_fetch_assoc($querry15run);
      ?>
            
            </div>
            </div>
            
        </div>
        <hr>
        <div class="container d-flex">
         
<div class="btn-group dropdown">
<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <b>
    Category
  </b>
  </button>
  <ul class="dropdown-menu">
    <?php 
    if(mysqli_num_rows($querry15run)!=0){
 foreach($querry15run as $fetch15){
    ?>
    <li><a class="dropdown-item shadow-sm" href="vbaskets?id=<?php echo $pname;?>&cid=<?php echo $fetch15['cat'];?>"><?php echo $fetch15['cat'];?></a></li>
    <?php
    }
   
} else{
       echo '<li> <a class="dropdown-item shadow-sm" href="#">No Category Found</a></li>';
}
if($pname == $username){
  echo '<li><a class="dropdown-item shadow-sm"  data-bs-toggle="modal" data-bs-target="#create"><b><strong> Create New Category</strong></b></a></li>';
}
  
    ?>
    
    </ul>
</div>

        </div>

        <div  class="container mt-4 mb-4">
            <div class="container col-md-10 col-lg-8 ">      
             <?php
              if($numrow >0){
                ?>
            <div class="row row-cols-3 row-cols-sm-4 row-cols-md-4 ">
            
            <?php 
            
         while($post1 = mysqli_fetch_assoc($rowfire)){
          $po_no = $post1['sno'];
          if ($post1['postimg'] != '') {
         ?> 
         <div class="container m-0 p-0">
    
         <div class=" d-flex justify-content-center m-0 p-0" data-bs-toggle="modal" data-bs-target="#vpimg<?php echo $post1['sno'] ?>">
                           <?php
                                
                                  echo '<img class="post_img rounded border shadow-lg" src="' . $post1['postimg'] . '" alt="">';
                               
                                // else {
                                //   // echo '<div class="container"> <p class="text-center post_img rounded border shadow-lg" style="word-wrap: break-word;">' . $post1['text'] . '</p></div>';
                                // }
                                ?>


               
       
        </div>
        <?php
         } 
        ?>
        <!-- Modal for view post -->
<div class="modal fade " id="vpimg<?php echo $post1['sno'] ?>" tabindex="-1" aria-labelledby="vimg" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header d-flex flex-column">
        <?php 
        $pusername = $post1['username'];
        if($username == $pusername){
          ?>
          <form action="ajax" method="POST">
                                                    <input type="hidden" name="posd" id="posd" value="<?php echo $post1['sno']; ?>">
                                                    <input type="hidden" name="delimg" id="delimg" value="<?php echo $post1['postimg']; ?>">
                                                    <button type="submit" id="demo" name="delpos" class="dropdown-item text-center rounded-pill" onclick="myFunction()" style="color:white;background-color:#fc4a1a">
                                                    <b> DELETE POST</b>
                                                </button>
                                                </form>
        
        <!-- <button id="edfob"  type="button" class="edfob btn btn-warning  ms-2 rounded-pill"><b><strong>Edit</strong></b></button> -->
        <div class="container">
        <form id="edfo" action="deluser" method="POST">
            <input class="form-control" type="hidden" name="name" value="<?php echo $post1['sno']; ?>">
            <div class="form-floating mb-3 m-3 mt-0">
                <textarea class="form-control" name="description" id="floatingTextarea2" value="<?php echo $post1['description']?>"></textarea>
                <label for="floatingTextarea2">Write Your Work Description</label>
            </div>
            <div class="form-floating mb-3  m-3 mt-0">
                <input type="text" class="form-control" name="category" id="floatingInput" value="<?php echo $post1['category']?>" >
                <label for="floatingInput">Category</label>
            </div>
            <div class="form-floating  m-3 mt-0">
                <input type="text" class="form-control" name="tags" id="floatingInput1" value="<?php echo $post1['tags']?>">
                <label for="floatingInput1">Tags</label>
            </div>
            <p class="text-center m-0" style="color:red; font-size:smaller;">* TAGS - type tag with a '#' for ex :- #swaag , #anothertag </p>
            <div class="form-floating mt-3 mb-3 m-3 mt-0">
                <input type="text" class="form-control" name="teammember" id="floatingInput2"  value="<?php echo $post1['teammembers']?>">
                <label for="floatingInput2">Team Member</label>
            </div>

<button type="submit" name="edpst" class="btn btn-md " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px; color:white;" ><b> Update</b></button>



</form>
</div>
        <?php
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
      <div class="modal-body">
         
          <div class="container">
            <?php
             
             ?>
            <div class="container">
              <img class="post_img rounded border" src="<?php echo $post1['postimg']; ?>" alt="">
            </div>
            <div class="container">
            <p class="m-0 p-0" style="color:blue;"><?php echo $post1['tags']; ?></p><hr class="m-0 p-0">
            <p class="m-0 p-0"><?php echo $post1['category']; ?></p><hr class="m-0 p-0">
            <p class="m-0 p-0"><?php echo $post1['description']; ?></p>
            </div>
            <div class="container" >
                    <?php
                     $sql3 = "SELECT * FROM `likes` WHERE `post_no` = $po_no ";
                     $sql3run = mysqli_query($conn, $sql3);
                     $num3row = mysqli_num_rows($sql3run);
                     $sql8 = "SELECT * FROM `comment` WHERE `pst_id` = $po_no ";
                     $sql8run = mysqli_query($conn, $sql8);
                     $num8row = mysqli_num_rows($sql8run);
                    ?>    
                    <small  data-toggle="modal" data-target="#like<?php echo $po_no ?>" ><b> Likes</b></small> <strong> <?php echo $num3row ?></strong>
                    <small  data-toggle="modal" data-target="#comment<?php echo $po_no ?>" ><b>Comments</b></small> <strong> <?php echo $num8row ?></strong>
                </div>
                <div class="container">Comments</div>
                <div class="container">
            <?php
            $sql = "SELECT * FROM `comment` WHERE pst_id = $po_no";
            $sqlrun = mysqli_query($conn, $sql);
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
                                                                                                        echo '<img id="img_profile2"  src="icons/Group 328.png" alt="img profile">';
                                                                                                    } else {
                                                                                                        echo '<img id="img_profile2" src= "' . $s2fetch['img'] . '">';
                                                                                                    }
                                                                                                    ?>
                                    </a>
                                </div>
                    </div>
                    <div class="conatner col-7 p-0">
                        <div class="container" style="color:gray ;"><h6><b><strong><?php echo $cm['user_id'] ; ?></strong></b></h6></div>
                        <div class="container text-center p-0 "><small><b><?php echo $cm['msg'] ; ?></b></small></div>
                    </div>
                    <div class="container col-3 p-0 d-flex align-items-center">
                        <small style="color:gray ;" ><?php echo $cm['commented_on'] ; ?></small >
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
            echo "<h3>No Post Yet</h3>";
          }
        ?>
            </div>
        </div>


    </div>


<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createbasket" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createbasket"><b><strong> Create New Baskets</strong></b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="container">
            <form action="" method="POST">
              <?php
              if(isset($_POST['createcat'])){
              $cat = $_POST['category'];
              if($fetch15['cat']!= $cat){
              $querry16 = "INSERT INTO `category`(`user_name`, `cat`) VALUES ('$username','$cat')";
              $querry16run = mysqli_query($conn, $querry16);
              }else{
                $_SESSION['err'] = "Catagory Already exists";
              }

            }
              ?>
              <input type="text" name="category" placeholder="Basket name">
              <button type="submit" name="createcat" class="btn btn-warning">create</button>
            </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</span>

<?php include 'footer/footer.php'?>

<script src="custom.js"></script>
<script>
                                    function myFunction() {

                                        var x;

                                        var r = confirm("Are you sure you want to delete this Post");

                                        if (r == true) {

                                            x = "You pressed OK!";

                                        } else {

                                            x = "You pressed Cancel!";
                                            return false;
                                        }

                                        document.getElementById("demo").innerHTML = x;

                                    }
                                </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>  
    <!-- <script type="text/javascript">
 
 document.getElementById("edfob").onclick = function() {
     console.log("hello world");
     if( document.getElementById("edfo").style.display = "none"){
       document.getElementById("edfo").style.display = "block";
     }
     if(document.getElementById("edfo").style.display = "block"){
       document.getElementById("edfo").style.display = "none";
     }
   }
 </script>  -->
    <style>
    #img_profile {
        background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
        height: 200px;
        width: 200px;
        object-fit: scale-down;
        border-radius: 50%;
        margin: 0 auto 20px auto;
        display: block;
   

    }
    /* #edfo{
      display: none;
    } */
    #img_profile2 {
                height: 2em;
                width: 2em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }
    .post_img{
        object-fit: scale-down;
        width: 100%;
        height: auto;
        
    }
    .checkbtn{
      display: none;
    }
 
    </style>
  </body>
</html>