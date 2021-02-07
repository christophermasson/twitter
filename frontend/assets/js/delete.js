$(function(){
    var modal=document.querySelector(".d-wrapper-container");
    var deleteModal=document.querySelector(".del-post-wrapper-container");

   
  
    $(document).on("click","#deletePostModal",function(){
        $postId=$(this).data('tweet');
        $tweetBy=$(this).data('tweetby');
        $userId=$(this).data('user');
        modal.style.display="block";
    });
    $(window).on("click",function(e){
        if(e.target==modal){
            modal.style.display="none";
        }
    })

    $(document).on("click","#del-content",function(){
        
        deleteModal.style.display="block";
    })

    $(document).on("click","#cancel",function(){
        
        deleteModal.style.display="none";
        modal.style.display="none";
    })

    $(document).on("click","#delete-post-btn",function(){
        
        $.post('http://localhost/twitter/backend/ajax/deletePost.php',{postId:$postId,userId:$userId,tweetBy:$tweetBy},function(data){
           
            deleteModal.style.display="none";
            modal.style.display="none";
            $(".postContainer").html(data);
            // alert(data);
            // location.reload(true);
            // })
    })
    })
  

    $(window).on("click",function(e){
        if(e.target==deleteModal){
            deleteModal.style.display="none";
        }
    })
  
//    $(document).on("click","#replyBtn",function(e){
//        e.preventDefault();
//        let userId=$button.data('user');
//        let postId=$button.data('post');
//        let counter=$button.find('.replyCount');
//        let textValue=$("#replyInput").val().trim();
//        if(textValue != "" && textValue != null){
//         $.post("http://localhost/twitter/backend/ajax/reply.php",{commentOn:postId,commentBy:userId,comment:textValue},function(data){
            
//             $(".reply-wrapper").hide();
//             let result=JSON.parse(data);
//             updateRetweetValue(counter,result.comments);
      
//             if(result.comments <0){
//                $button.removeClass('commented').addClass("replyModal");
//                $button.removeClass("replyCountColor");
//                counter.removeClass('replyCountColor');
//             }else{
//                 $button.addClass('commented').removeClass("replyModal");
//                 $button.addClass("replyCountColor");
//                 counter.addClass('replyCountColor');
//             }
      
      
//           })
//        }
    
//    })
    

   
})