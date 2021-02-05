$(function(){
    var modal=document.querySelector(".reply-wrapper");

    $(document).on("click",".replyModal",function(e){
        e.preventDefault();
        $postId=$(this).data('post');
        $userId=$(this).data('user');
        $postedBy=$(this).data('postedby');
        $button=$(this);
        $counter=$(this).find('.replyCount');
        // alert($postedBy);
        modal.style.display="block";

        $.post("http://localhost/twitter/backend/ajax/reply.php",{tweetID:$postId,tweetBy:$postedBy,userId:$userId},function(data){
            $(".reply-wrapper").html(data);
        // alert(data);
      
          //   console.log(result);
          })
    
    
    })
    // window.onclick=function(event){
    //     if(event.target==modal)
    //     modal.style.display="none";
    // }

    $(document).on("click",".close",function(){
        modal.style.display="none";
    });
    $(window).on("click",function(e){
        if(e.target==modal){
            modal.style.display="none";
        }
    })
  

    // function updateRetweetValue(element,num){
    //     let retweetCountVal=element.text() || "0";
    //     element.text(parseInt(retweetCountVal) + parseInt(num));
    // }

   
})