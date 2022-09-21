$(".followbtn").click(function(){
  var user_id_v = $(this).data('userId');
  var button=this;
  $(button).attr('disabled', true);
  $.ajax({
     url: 'ajax?follow',
     method: 'post',
     dataType: 'json',
     data:{user_id: user_id_v },
      success: function (response) {
         console.log(response);
         if (response.status){
           $(button).data('userId', 0);
           $(button).text('Followed'); 
         }else{
          $(button).attr('disabled', false);
           alert('something went wrong');
         }
  
         }
        });
      });
  
$(".unfollowbtn").click(function(){
  var user_id_v_v = $(this).data('unfollowId');
  var button= this;
  $(button).attr('disabled', true);
  $.ajax({
     url: 'ajax?unfollow',
     method: 'post',
     dataType: 'json',
     data:{user_id_U: user_id_v_v },
      success: function (response) {
         console.log(response);
         if (response.status){
             $(button).data('unfollowId', 0);
             $(button).text('Unfollowed');    
         }else{
          $(button).attr('disabled', false);
           alert('something went wrong');
         }
  
         }
        });
      });

      $(".likebtn").click(function() {
        var user_id_dl = $(this).data('postId');
        var button = this;
        console.log(user_id_dl);

        $.ajax({
            url: 'ajax?liked',
            method: 'post',
            dataType: 'json',
            data: {
                user_id_l: user_id_dl
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    //             $(button).attr('class','unlikebtn'); 
                    // $(button).html('<i style="color:red;" class="fas fa-heart"></i>'); 
                    $(button).attr('disabled', false);
                    $(button).hide()
                    $(button).siblings('.unlikebtn').show();

                } else {
                    $(button).attr('disabled', false);
                    alert('something went wrong');
                }
            }

        });
        // location.reload();   
    });
    $(".unlikebtn").click(function() {
        var user_id_dl = $(this).data('postId');
        var button = this;
        console.log(user_id_dl);

        $.ajax({
            url: 'ajax?unliked',
            method: 'post',
            dataType: 'json',
            data: {
                user_id_l: user_id_dl
            },
            success: function(response) {
                console.log(response);
                if (response.status) { 
                    $(button).attr('disabled', false);
                    $(button).hide()
                    $(button).siblings('.likebtn').show();

                } else {
                    $(button).attr('disabled', false);
                    alert('something went wrong');
                }
            }
        });
        console.log(user_id_dl);
                             
    });

    $(".votebtn").click(function() {
        var user_id_vo = $(this).data('postId');
        var button = this;
        console.log(user_id_vo);

        $.ajax({
            url: 'ajax?vote',
            method: 'post',
            dataType: 'json',
            data: {
                user_id_v: user_id_vo
            },
            success: function(response) {
                console.log(response);
                if (response.status) { 
                    $(button).attr('disabled', false);
                    $(button).hide()
                    $(button).siblings('.unvotebtn').show();

                } else {
                    $(button).attr('disabled', false);
                    alert('something went wrong');
                }
            }
        });
        console.log(user_id_vo);
                         
    });
    $(".unvotebtn").click(function() {
        var user_id_vo = $(this).data('postId');
        var button = this;
        console.log(user_id_vo);

        $.ajax({
            url: 'ajax?unvote',
            method: 'post',
            dataType: 'json',
            data: {
                user_id_v: user_id_vo
            },
            success: function(response) {
                console.log(response);
                if (response.status) { 
                    $(button).attr('disabled', false);
                    $(button).hide()
                    $(button).siblings('.votebtn').show();

                } else {
                    $(button).attr('disabled', false);
                    alert('something went wrong');
                }
            }
        });
        console.log(user_id_vo);
                         
    });
//for adding comment
$(".add-comment").click(function () {
  var button = this;

  var comment_v = $(button).siblings('.comment-input').val();


  if (comment_v == '') {
      if($.trim(comment_v).length == 0){
         $(button).siblings('.comment-input').attr('placeholder', '*Please type something*');

                  }

      return 0;
  }
  var post_id_v = $(this).data('cmId');
  var cs = $(this).data('cs');
  $(button).attr('disabled', true);
  $(button).siblings('.comment-input').attr('disabled', true);
  $.ajax({
      url: 'ajax?addcomment',
      method: 'post',
      dataType: 'json',
      data: { post_id: post_id_v, comment: comment_v },
      success: function (response) {
          console.log(response);
          if (response.status) {

              $(button).attr('disabled', false);
              $(button).siblings('.comment-input').attr('disabled', false);
              $(button).siblings('.comment-input').val('');
              $("#" + cs).prepend(response.comment);

              // $('.nce').hide();
          } else {
              $(button).attr('disabled', false);
              $(button).siblings('.comment-input').attr('disabled', false);

              alert('something is wrong,try again after some time');
          }
      }
  });





  
  
});
  