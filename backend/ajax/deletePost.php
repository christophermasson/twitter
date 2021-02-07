<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['postId']) && !empty($_POST['postId'])){
        $postId=h($_POST['postId']);
        $userId=h($_POST['userId']);
        $postedBy=h($_POST['tweetBy']);

        if($userId==$postedBy){
            $loadFromUser->delete("tweets",["tweetBy"=>$userId,"tweetID"=>$postId]);
        }

      $loadFromTweet->tweets($userId,10);

    }
}