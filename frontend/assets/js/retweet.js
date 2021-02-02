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
            // console.log(data);
            // let likeButton=$(button);
            // likeButton.addClass("like-active");
            let result=JSON.parse(data);
            updateRetweetValue($counter,result.retweets);

            if(result.retweets <0){
               let text=$("#retweet-it retweet-text span").text("Retweet");
               $("#retweet-it").removeClass("retweeted-it").addClass("retweet-it");
               retweetModal.style.display="none";

            }else{
                console.log("ONe");
                let text=$("#retweet-it retweet-text span").text("Undo Retweet");
                $("#retweet-it").removeClass("retweet-it").addClass("retweeted-it");
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