$(function(){
    const retweetBtn=document.querySelector(".retweet");
    const retweetModal=document.querySelector(".retweet-container");
    retweetBtn.addEventListener("click",function(e){
        e.preventDefault();
        
        retweetModal.style.display="block";
        $posId=$(this).data('post');
        $uid=$(this).data('user');
        $counter=$(this).find('retweetsCount');
        $button=$(this);
        
    })
    window.onclick=function(event){
        if(event.target==retweetModal)
        retweetModal.style.display="none";
    }

    $(document).on("click",".retweet-it",function(){
        let post_id=$button.data('post');
        let userId=$button.data('user');
        let retweetText="";
        // console.log(post_id,userId);
        // alert("Retweet button was pressed!");
        $.post("http://localhost/twitter/backend/ajax/retweet.php",{tweetID:post_id,userId:userId,status:retweetText},function(data){
            // alert(data);
            console.log(data);
            // let likeButton=$(button);
            // likeButton.addClass("like-active");
            // let result=JSON.parse(data);
            // updateLikesValue(likeButton.find(".likesCounter"),result.likes);

            // if(result.likes <0){
            //     likeButton.removeClass("like-active");
            //     likeButton.find(".fa-heart").addClass("fa-heart-o");
            //     likeButton.find(".fa-heart-o").removeClass("fa-heart");
            // }else{
            //     likeButton.addClass("like-active");
            //     likeButton.find(".fa-heart-o").addClass("fa-heart");
            //     likeButton.find(".fa-heart").removeClass("fa-heart-o");
            // }


            //   console.log(result);
            })
    })
})