$(function(){
    const retweetBtn=document.querySelector(".retweet");
    const retweetModal=document.querySelector(".retweet-container");
    retweetBtn.addEventListener("click",function(e){
        e.preventDefault();
        
        retweetModal.style.display="block";
        $postId=$(this).data('post');
        $uid=$(this).data('user');
        $counter=$(this).find('.retweetsCount');
        $button=$(this);
    
        
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
                   $button.removeClass("retweeted-icon");
                   retweetModal.style.display="none";
                }else{
                    $(".retweet-it .retweet-text span").text("Undo Retweet");
                    $button.addClass("retweeted-icon");
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