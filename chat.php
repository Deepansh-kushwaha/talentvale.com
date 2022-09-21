<?php
include 'dbconn/dbconn.php';
include 'session/ssr.php';
error_reporting(0);

$username = $_SESSION['username'];
$user_id = $_GET['u'];
$querry2 = "SELECT * FROM `signupinfo` WHERE  username = '$user_id'";
$querry2fire = mysqli_query($conn, $querry2);
$fetch3 = mysqli_fetch_assoc($querry2fire);
// echo $user_id;
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/2.0.2/timeago.min.js" integrity="sha512-sl01o/gVwybF1FNzqO4NDRDNPJDupfN0o2+tMm4K2/nr35FjGlxlvXZ6kK6faa9zhXbnfLIXioHnExuwJdlTMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>chats</title>
</head>
<script>
    window.onload=function(){
    document.getElementById('loader').style.display="none";
    document.getElementById('content').style.display="block";
    };
</script>
<body>
    <?php include 'nav/nav.php'; ?>
    <div id="loader" >
        <div class="d-flex justify-content-center m-auto">
        <img src="eb7e7769321565.5ba1db95aab9f.gif" alt="loader">
        </div>
    </div>
    <div id="content">
    <div class="  row row-cols-2 mt-2">
    <div class="col-3 btn" onclick="history.back()"><i class="fas fa-angle-left"></i></div>
        <div class="container d-flex justify-content-center align-items-center p-0 m-0 ">
            <a href="vprofile.php?id=<?php echo $fetch3['username']; ?>"><?php
                                                                            if ($fetch3['img'] == '') {
                                                                                echo '<img id="img_profile"  src="icons/Group 328.png" alt="img profile">';
                                                                            } else {
                                                                                echo '<img id="img_profile" src= "' . $fetch3['img'] . '">';
                                                                            }
                                                                            ?>
            </a>
       
                                <div class="container d-flex flex-column align-items-start m-0 p-0">
                                    <div class="d-flex ">
                                        <div class="container m-0 p-0"><small class="m-0"><strong><b><?php echo $fetch3['firstname']; ?></b></strong></small>
                                        </div>
                                        <div class="container m-0 ms-1 p-0"><small class="m-0"><strong><b><?php echo $fetch3['lastname']; ?></b></strong></small>
                                        </div>
                                    </div>
                                    <small style="color:gray ;"><b>@<?php echo $fetch3['username']; ?></b></small>
                                </div>  
                                </div>
                            </div>
    <hr class="mt-1 mb-1" >
<div class="container col-md-6  ">
<div class="container  d-flex flex-column-reverse gap-2 scroll"  id="chatlist">

</div>
<!-- <hr> -->
                    <div class="container navbar-bottom d-flex justify-content-center input-group mb-2"  >
                        <textarea class="form-control txtarea shadow" name="textpost" id="textpost" placeholder="Say something" required></textarea>
                        <button class="btn m-0 p-0 sendmsg " type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" style="border-radius:0 50px 50px 0; background-color:orange; padding:2px 8px 2px 4px " fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                </svg>
                        </button>
                    </div>
        </div>
        </div>
<?php include 'footer/footer.php'; ?>
<script src="jquery-3.6.0.js" ></script>
    <script src="custom.js" ></script>
    <script>
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var c = url.searchParams.get("u");
            // console.log(c);
function synmsg() {
$.ajax({
    url: 'ajax.php?getmessages',
    method: 'POST',
    dataType: 'json',
    data: { chatter_id: c },   
    success: function (response) {
        // console.log(response);
        $("#chatlist").html(response.chat.msgs);
        // if (response.newmsgcount == 0) {
        //     $("#msgcounter").hide();
        // } else {
        //     $("#msgcounter").show();
        //     $("#msgcounter").html("<small>" + response.newmsgcount + "</small>");


        // }
        // if (response.blocked) {
        //     $("#msgsender").hide();
        //     $("#blerror").show();

        // } else {
        //     $("#msgsender").show();
        //     $("#blerror").hide();
        // }

        // if (chatting_user_id != 0) {
        //     $("#user_chat").html(response.chat.msgs);

        //     $("#chatter_username").text(response.chat.userdata.username);
        //     $("#cplink").attr('href', '?u=' + response.chat.userdata.username);

        //     $("#chatter_name").text(response.chat.userdata.first_name + ' ' + response.chat.userdata.last_name);
        //     $("#chatter_pic").attr('src', 'assets/images/profile/' + response.chat.userdata.profile_pic);
        // }



    }
});
}

synmsg();

setInterval(() => {
synmsg();

}, 1000);

$(".sendmsg").click(function() {
    // var textmsg = document.getElementById('textpost').value;
    var button = this;

var textmsg = $(button).siblings('.txtarea').val();


if (textmsg == '') {
    if($.trim(textmsg).length == 0){
       $(button).siblings('.textarea').attr('placeholder', '*Please type something*');

                }

    return 0;
}
    $(button).attr('disabled', true);
  $(button).siblings('.txtarea').attr('disabled', true);
$.ajax({
    url: 'ajax.php?sendmessages',
    method: 'POST',
    dataType: 'json',
    data: { user_id: c ,text: textmsg  },   
    success: function (response) {
    // console.log(response);
    if (response.status) {

$(button).attr('disabled', false);
$(button).siblings('.txtarea').attr('disabled', false);
$(button).siblings('.txtarea').val('');
} else {
$(button).attr('disabled', false);
$(button).siblings('.txtarea').attr('disabled', false);

alert('something is wrong,try again after some time');
}
    }
});

});

    </script>
<style>
    #content{
        display: none;
    }
        .scroll {
                max-height:70vh;
                min-height: 60vh;
                height: fit-content;
                /* width: auto; */
                overflow-y: scroll;
                overflow-x: hidden;
                scroll-behavior: smooth;
                -ms-overflow-style: none;
                /* Internet Explorer 10+ */
                scrollbar-width: none;
                /* Firefox */
            }

            .scroll::-webkit-scrollbar {
                display: none;
                /* Safari and Chrome */
            }
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
   
            #img_profile {
                height: 3em;
                width: 3em;
                object-fit: scale-down;
                background-image: radial-gradient(circle, rgba(229, 228, 247, 1) 0%, rgba(222, 222, 241, 1) 11%, rgba(214, 237, 242, 1) 82%);
                border-radius: 50%;
                display: block;
                border: 4px solid #F6A62D;
                border-style: solid;

            }
            
            .txtarea {
                border-radius: 50px;
                border:none;
                padding-left: 14px;
                border-bottom: 1px solid gray;
                height: 40px;
                
            }

</style>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        </body>

</html>