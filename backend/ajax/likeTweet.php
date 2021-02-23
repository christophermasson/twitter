<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['tweetID']) && !empty($_POST['tweetID'])){
        $likeBy=h($_POST['likedBy']);
        $tweetID=h($_POST['tweetID']);
        $postedBy=h($_POST['likeOn']);

        echo $loadFromTweet->likes($likeBy,$tweetID,$postedBy);

    }
}