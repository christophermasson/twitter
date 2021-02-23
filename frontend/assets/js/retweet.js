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

    $(document).on("click",".retweet-it,.retweeted-it",function(){
        let postId=$button.data('post');
        let userId=$button.data('user');
        let postedby=$button.data('postedby');
        let retweetText="";
        let wasRetweeted=$(this).hasClass("retweeted-it");
        if(wasRetweeted){
            $.post("http://localhost/twitter/backend/ajax/retweet.php",{tweetID:postId,retweetBy:userId,status:retweetText,tweetby:postedby},function(data){
                let result=JSON.parse(data);
                updateRetweetValue($counter,result.retweets);
        
                if(result.retweets <0){
                   $(".menuItem .retweet-text .retweet-no-quote").text("Retweet");
                   $button.removeClass("retweeted-icon").addClass("retweet");
                   $(".retweet-it").removeClass("retweeted-it");
                   retweetModal.style.display="none";
                }
        
        
            })
        }else{
            $.post("http://localhost/twitter/backend/ajax/retweet.php",{tweetID:postId,retweetBy:userId,status:retweetText,tweetby:postedby},function(data){
                    let result=JSON.parse(data);
                    updateRetweetValue($counter,result.retweets);
            
                    if(result.retweets >0){
                        $(".menuItem .retweet-text .retweet-no-quote").text("Undo Retweet");
                        $button.addClass("retweeted-icon").removeClass('retweet');
                        $(".retweet-it").addClass("retweeted-it").removeClass("retweet-it");
                        retweetModal.style.display="none";
                    }
            
                })
        }
        
    })

    function updateRetweetValue(element,num){
        let retweetCountVal=element.text() || "0";
        element.text(parseInt(retweetCountVal) + parseInt(num));
    }

    $(document).on("click",".retweet-it",function(){
        $.post("http://localhost/twitter/backend/ajax/retweet.php",{retweetPostId:$postId,retweetBy:$uid},function(data){
            $(".postContainer").html(data);
        })
    })
})