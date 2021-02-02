<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['tweetID']) && !empty($_POST['tweetID'])){

        $tweetID=h($_POST['tweetID']);
        $userId=h($_POST['userId']);
        $status=$_POST['status'];
      

        echo $loadFromTweet->retweetCount($userId,$tweetID,$status);

    }
}