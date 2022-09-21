<?php
include 'dbconn/dbconn.php';

$filtervalues= date("Y-m-d");
$querry5 ="SELECT * FROM `posts`WHERE  CONCAT(date) LIKE '%$filtervalues%'  ORDER BY likes DESC LIMIT 10 ";
$querry5fire =mysqli_query($conn, $querry5);
$num = mysqli_num_rows($querry5fire);
if($num >0){
foreach($querry5fire as $row){
    $uname = $row['username'];
    // $row_id = $row['sno'];

// for user info
    $sql = "SELECT * FROM `signupinfo` WHERE username = '$uname'";
    $sqlrun = mysqli_query($conn , $sql);
    $product = mysqli_fetch_assoc($sqlrun);
    
    
    $templatefile ="mailtemp3.php";
    $email = $product["email"];

    $swap_var = array(
        "{to_name}" =>"$email",
        "{coustom_url}" => "https://talentvale.com/update_password?id=$email"
    );

    $subject = "Congratulations you are todays top ranker";
    if(file_exists($templatefile)){
    $body = file_get_contents($templatefile);
    }else{
        die("unable to locate email temp file");
    }
    foreach(array_keys($swap_var) as $key){
        if(strlen($key)>2 && trim($key) != ""){
            $body= str_replace($key, $swap_var[$key], $body);
        }
    }
    $headers = "From:talentvale.help@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if (mail($email, $subject, $body, $headers)) {
        echo "Email successfully sent to $email...";
        $_SESSION['mailsent'] = true;
        header('Refresh: 5; URL=http://localhost/talentvale.com/login');
    } else {
        echo "Email sending failed...";
    }

    // add notification
    $notitext= "Congratulations you are todays top ranker";
    $querry5 = "INSERT INTO `notifications`(`username`, `message`) VALUES ('$uname','$notitext')";
    $querry5fire = mysqli_query($conn, $querry5);
    if($querry5fire){
        echo "notification and mail sended";
    }
}
}else{
echo 'no mail found';
}
?>

