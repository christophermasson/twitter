<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['tweetID']) && !empty($_POST['tweetID'])){
        $retweetBy=h($_POST['retweetBy']);
        $tweetID=h($_POST['tweetID']);
        $status=$_POST['status'];

        echo $loadFromTweet->retweetCount($retweetBy,$tweetID,$status);

    }
}