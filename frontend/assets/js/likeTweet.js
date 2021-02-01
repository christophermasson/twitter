function likeTweet(button,postId,likedBy,postedBy){
    $.post("http://localhost/twitter/backend/ajax/likeTweet.php",{tweetID:postId,likedBy:likedBy,likeOn:postedBy},function(data){
      let likeButton=$(button);
      likeButton.addClass("like-active");
      let result=JSON.parse(data);
      updateLikesValue(likeButton.find(".likesCounter"),result.likes);

      if(result.likes <0){
          likeButton.removeClass("like-active");
          likeButton.find(".fa-heart").addClass("fa-heart-o");
          likeButton.find(".fa-heart-o").removeClass("fa-heart");
      }else{
        likeButton.addClass("like-active");
        likeButton.find(".fa-heart-o").addClass("fa-heart");
        likeButton.find(".fa-heart").removeClass("fa-heart-o");
      }


    //   console.log(result);
    })
}

function updateLikesValue(element,num){
    let likesCountVal=element.text() || "0";
    element.text(parseInt(likesCountVal) + parseInt(num));
}