<?php

// use LDAP\Result;

include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);

$username = $_SESSION['username'];

?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


  <title>Search</title>
</head>

<body>
  <?php include 'nav/nav.php'; ?>
  <h1 class="text-center"><b><strong>Search Here</strong></b></h1>
  <div class="container-fluid m-0 p-0 ">
    <div class="container">
      <form action="" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                  } ?>" class="form-control" placeholder="search here">
          <button class="btn btn-primary">Search</button>
        </div>
      </form>
    </div>
    <div class="container-fluid p-0 m-0">
      <table class="table table-hover table-primary table-sm">
        <thead>
          <tr>
            <th class="m-0 p-0 text-center" scope="col">Profile</th>
            <th class="m-0 p-0 text-center" scope="col">username</th>
            <th class="m-0 p-0 text-center" scope="col">firstname</th>
            <th class="m-0 p-0 text-center" scope="col">lastname</th>
            <th class="m-0 p-0 text-center" scope="col">follow</th>

          </tr>
        </thead>
        <?php
        if (isset($_GET['search']) && ($_GET['search'] !== '')) {
          $filtervalues = $_GET['search'];
          $querry5 = "SELECT * FROM `signupinfo`WHERE CONCAT(firstname,lastname, username,email) LIKE '%$filtervalues%' && `username` != '$username' ";
          $querry5fire = mysqli_query($conn, $querry5);
          $num = mysqli_num_rows($querry5fire);

          if ($num > 0) {
            foreach ($querry5fire as $items) {
              $u_n = $items['username'];
              $querry12 = "SELECT * FROM `follow` WHERE  `follower_name` = '$username' && `user_name`= '$u_n'";
              $querry12fire = mysqli_query($conn, $querry12);
              $num12 = mysqli_num_rows($querry12fire);
        ?>
              <tr>
                <td class="m-0 p-0 d-flex justify-content-center"><a href="vprofile?id=<?php echo $items['username']; ?>"><?php
                                                                                                                              if ($items['img'] == '') {
                                                                                                                                echo '<img class="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                                                                              } else {
                                                                                                                                echo '<img class="img_profile" src= "' . $items['img'] . '">';
                                                                                                                              }
                                                                                                                              ?>
                  </a>
                </td>
                <td class="m-0 p-0 text-center"> <?= $items['username'] ?></td>
                <td class="m-0 p-0 text-center"><?= $items['firstname'] ?></td>
                <td class="m-0 p-0 text-center"><?= $items['lastname'] ?></td>
                <?php
                if ($num12 != 1) {
                ?>
                  <td class="text-center"><button class="btn btn-sm btn-success followbtn" data-user-id='<?php echo $u_n ?>'>Follow</button></td>
                <?php
                } else {
                ?>
                  <td class="text-center"><button class="btn btn-sm btn-danger unfollowbtn" data-unfollow-id='<?php echo $u_n ?>'>Unfollow</button></td>

                <?php
                }
                ?>
              </tr>

            <?php
            }
          } else {
            ?>
            <tr>

              <td class="text-center" colspan="5">NO RECORDS FOUND</td>

            </tr>
        <?php
          }
        }
        ?>




      </table>
    </div>
  </div>
  <?php include 'footer/footer.php'; ?>
  <script src="jquery-3.6.0.min.js"></script>
  <script src="custom.js"></script>
  <style>
    .img_profile {
      height: 4em;
      width: 4em;
      object-fit: scale-down;
      background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
      border-radius: 50%;
      /* margin: 0 auto 20px auto; */
      display: block;
      border: 4px solid #F6A62D;
      border-style: solid;

    }
  </style>

</body>

</html>