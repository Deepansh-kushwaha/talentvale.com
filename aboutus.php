<?php
include 'dbconn/dbconn.php';
include 'session/ss.php';
error_reporting(0);
$username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>About talentvale.com</title>
</head>

<body>
    <?php include 'nav/nav.php'; ?>
 <div class="container">
<center>
<h1>About us </h1>
<p> talentvale.com is a place where you can make your portfolio and share it with others. <br>
talentvale.com organises events on a regular basis so you can participate in them and after completion of the event you will get a certificate. <br>
and every week the top 10 posts excluding events having the most likes will be shown on our leaderboard.</p>
<h1> How it works</h1> 
 <p> First participate in events and then share your work to get votes. After that, the person who gets the most votes will get a certificate of appreciation and others will get a certificate of participation. We will share top 5 contestant posts on our official instagram, facebook and twitter handle.</p>
<ol>
<li> Participate in events</li>
<li> Share your post to get votes</li>
<li> Wait for the results</li>
<li> Top 5 will get certificate of appreciation</li>
<li> Rest after top 5 will get certificate of participation</li>
<li> We will share the top 5 posts from the event on our official instagram, facebook and twitter handle.</li>
</ol>

</center>
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
 
</style>

</body>

</html>