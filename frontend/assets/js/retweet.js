$(function(){
    const retweetBtn=document.querySelector(".retweet");
    const retweetModal=document.querySelector(".retweet-container");

    $(document).on("click",".retweet,.retweeted-icon",function(e){
        e.preventDefault();
        $postId=$(this).data('post');
        $uid=$(this).data('user');
        $counter=$(this).find('.retweetsCount');
        $button=$(this);
        let wasRetweeted=$(this).hasClass("retweeted-icon");
        if(wasRetweeted){
            
            $.post("http://localhost/twitter/backend/ajax/retweet.php",{retweetId:$postId,retweetBy:$uid},function(data){
                retweetModal.style.display="block";
                $(".retweet-container").html(data);
            
            
            })
        }else{
            $.post("http://localhost/twitter/backend/ajax/retweet.php",{retweetId:$postId,retweetBy:$uid},function(data){
                retweetModal.style.display="block";
                $(".retweet-container").html(data);
            
            
            })
        }
    
    })
    window.onclick=function(event){
        if(event.target==retweetModal)
        retweetModal.style.display="none";
    }

    $(document).on("click",".retweet-it",function(){
        let postId=$button.data('post');
        let userId=$button.data('user');
        let retweetText="";
        // console.log(postId,userId);
        // alert("Retweet button was pressed!");
            $.post("http://localhost/twitter/backend/ajax/retweet.php",{tweetID:postId,retweetBy:userId,status:retweetText},function(data){
            //  console.log(data);    
            // let likeButton=$(button);
                // likeButton.addClass("like-active");
                let result=JSON.parse(data);
                updateRetweetValue($counter,result.retweets);
        
                if(result.retweets <0){
                   $(".retweet-it .retweet-text span").text("Retweet");
                   $button.removeClass("retweeted-icon").addClass("retweet");
                   retweetModal.style.display="none";
                }else{
                    $(".retweet-it .retweet-text span").text("Undo Retweet");
                    $button.addClass("retweeted-icon").removeClass('retweet');
                    retweetModal.style.display="none";
                }
        
        
            //   console.log(result);
            })
    })

    function updateRetweetValue(element,num){
        let retweetCountVal=element.text() || "0";
        element.text(parseInt(retweetCountVal) + parseInt(num));
    }

})