$(function(){
    var modal=document.querySelector(".reply-wrapper");

    $(document).on("click",".replyModal,.commented",function(e){
        e.preventDefault();
        $postId=$(this).data('post');
        $userId=$(this).data('user');
        $postedBy=$(this).data('postedby');
        $button=$(this);
        $counter=$(this).find('.replyCount');
        let wasCommented=$button.hasClass("commented");
        if(wasCommented){
            $.post("http://localhost/twitter/backend/ajax/reply.php",{delCommentOn:$postId,commentBy:$userId,tweetBy:$postedBy},function(data){
               
                let result=JSON.parse(data);
                updateRetweetValue($counter,result.delComment);
          
                if(result.delComment <0){
                   $button.removeClass('commented').addClass("replyModal");
                   $button.removeClass("replyCountColor");
                   $counter.removeClass('replyCountColor');
                }
          
              })
        }else{
            modal.style.display="block";

            $.post("http://localhost/twitter/backend/ajax/reply.php",{tweetID:$postId,tweetBy:$postedBy,userId:$userId},function(data){
                $(".reply-wrapper").html(data);
            
              })
        
        }
       
    
    })
  
    $(document).on("click",".close",function(){
        modal.style.display="none";
    });
    $(window).on("click",function(e){
        if(e.target==modal){
            modal.style.display="none";
        }
    })
  
   $(document).on("click","#replyBtn",function(e){
       e.preventDefault();
       let userId=$button.data('user');
       let postId=$button.data('post');
       let tweetBy=$button.data('postedby');
       let counter=$button.find('.replyCount');
       let textValue=$("#replyInput").val().trim();
       if(textValue != "" && textValue != null){
        $.post("http://localhost/twitter/backend/ajax/reply.php",{commentOn:postId,commentBy:userId,comment:textValue,tweetBy:tweetBy},function(data){
            
            $(".reply-wrapper").hide();
            let result=JSON.parse(data);
            updateRetweetValue(counter,result.comments);
      
            if(result.comments <0){
               $button.removeClass('commented').addClass("replyModal");
               $button.removeClass("replyCountColor");
               counter.removeClass('replyCountColor');
            }else{
                $button.addClass('commented').removeClass("replyModal");
                $button.addClass("replyCountColor");
                counter.addClass('replyCountColor');
            }
      
      
          })
       }
    
   })
    function updateRetweetValue(element,num){
        let retweetCountVal=element.text() || "0";
        element.text(parseInt(retweetCountVal) + parseInt(num));
    }

   
})