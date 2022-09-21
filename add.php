<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);
$username = $_SESSION['username'];
if(isset($_POST['submit'])){
    $name = $username; 
    $desc = $_POST['description'];  
    $tags = $_POST['tags'];
    $cat = $_POST['category'];
    $tmem = $_POST['teammember'];
    $filename = $_FILES["userfile"]["name"];
    $tempname = $_FILES["userfile"]["tmp_name"];
    $folder = "postimg/" .time().basename($filename);
    if ($name != "" && $filename != "") {
        move_uploaded_file($tempname, $folder);
        if(file_exists($folder)){
        $Query ="INSERT INTO `posts`( `username`, `postimg`, `description`, `tags`, `category`, `teammembers`) VALUES ('$name','$folder','$desc','$tags','$cat','$tmem')";
        $Queryfire = mysqli_query($conn,$Query);
        if($Queryfire){
            $added = true;
            $_SESSION['added']=true;
           
            header("location:index?id=");
        }else{
            header("location:index?id=failed");
        }
        
    }else{
        echo"not ok";
     }
     
}
}
if(isset($_POST['uptext'])){
    $name = $username; 
    $tags = $_POST['tags'];
    $cat = $_POST['category'];
    $tmem = $_POST['teammember'];
    $tex = $_POST['textpost'];
     $Query2 ="INSERT INTO `posts`( `username`, `text`, `tags`, `category`, `teammembers`) VALUES ('$name','$tex','$tags','$cat','$tmem')";
        $Query2fire = mysqli_query($conn,$Query2);
        if($Query2fire){
            $added = true;
            $_SESSION['added']=true;
           
            header("location:index?id=");
        }else{
            header("location:index?id=failed");
        }
        
    }
    
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Add New Post</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
<div class="container">    <button class="btn btn-sm btn-success m-2 " onclick="history.back()"> Go Back</button></div>
    <h1 class="text-center">Add New Post</h1>
    <div class="container mb-4">
    <div class="d-flex justify-content-center row row-cols-2 ">
        <button class="btn col-5 btn-md btn-warning me-2" id="bt1"> <b> Image Upload</b></button>
        <button class="btn col-5 btn-md btn-warning ms-2" id="bt2"> <b> Text Upload</b></button>
    </div>
    </div>
    <div id="bo1"> 
    <div class="container d-flex justify-content-center align-items-center mb-2" >                                            
        <form action="" method="POST" enctype="multipart/form-data">
        <?php

?>
            <div class="mb-3">
                <input class="form-control" type="file" name="userfile" id="file"  accept="image/png, image/jpeg"  required>
            </div>
            <input class="form-control" type="hidden" name="name" value="<?php echo $username;?>">
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="floatingTextarea2"></textarea>
                <label for="floatingTextarea2">Write Your Work Description</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control" name="category" id="floatingInput" >
                <label for="floatingInput">Category</label>
            </div>
            <div class="form-floating ">
                <input type="text" class="form-control" name="tags" id="floatingInput1">
                <label for="floatingInput1">Tags</label>
            </div>
            <p class="text-center m-0" style="color:red; font-size:smaller;">* TAGS - type tag with a '#' for ex :- #swaag , #anothertag </p>
            <div class="form-floating mt-3 mb-3">
                <input type="text" class="form-control" name="teammember" id="floatingInput2" >
                <label for="floatingInput2">Team Member</label>
            </div>

<button type="submit" name="submit" class="btn btn-md " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px; color:white;" ><b> Upload</b></button>



</form>

    </div>
</div>
    <div id="bo2">
    <div class="container d-flex justify-content-center align-items-center mb-2" >                                            
        <form action="" method="POST" enctype="multipart/form-data">
        <?php

?>
            <div class="mb-3">
                <input class="form-control" type="text" name="textpost" id="textpost"  placeholder="Write Your Views"  required>
            </div>
            <input class="form-control" type="hidden" name="name" value="<?php echo $username;?>">
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control" name="category" id="floatingInput" >
                <label for="floatingInput">Category</label>
            </div>
            <div class="form-floating ">
                <input type="text" class="form-control" name="tags" id="floatingInput1">
                <label for="floatingInput1">Tags</label>
            </div>
            <p class="text-center m-0" style="color:red; font-size:smaller;">* TAGS - type tag with a '#' for ex :- #swaag , #anothertag </p>
            <div class="form-floating mt-3 mb-3">
                <input type="text" class="form-control" name="teammember" id="floatingInput2" >
                <label for="floatingInput2">Team Member</label>
            </div>

<button type="submit" name="uptext" class="btn btn-md " style=" background: #fc4a1a; 
            background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 

            background: linear-gradient(to right, #f7b733, #fc4a1a); border:none; border-radius:10px; color:white;" ><b> Upload</b></button>



</form>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
<?php

?>
    <?php include 'footer/footer.php'; ?>
<style>
    /* #bo1{
        display: none;
    } */
    #bo2{
        display: none;
    }
</style>
    <Script type="text/javascript">
        // $(document).ready(function(){

            if (document.getElementById("bo1").style.display = "block") {
            document.getElementById("bt1").style.color = "black";
            document.getElementById("bt2").style.color = "white";
        }
            document.getElementById("bt1").onclick = function() {
            if (document.getElementById("bo1").style.display = "none") {
                document.getElementById("bo1").style.display = "block";
                document.getElementById("bo2").style.display = "none";
                document.getElementById("bt1").style.color = "black";
                document.getElementById("bt2").style.color = "white";
            }
        }
            document.getElementById("bt2").onclick = function() {
            if (document.getElementById("bo2").style.display = "none") {
                document.getElementById("bo2").style.display = "block";
                document.getElementById("bo1").style.display = "none";
                document.getElementById("bt2").style.color = "black";
                document.getElementById("bt1").style.color = "white";
            }
        }

        // });
    </Script>
</body>

</html>