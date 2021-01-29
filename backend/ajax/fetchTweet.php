<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['fetchTweets']) && !empty($_POST['fetchTweets'])){
        $userid=h($_POST['userId']);
        $limit=(int)trim($_POST['fetchTweets']);
        // echo $limit;

        $loadFromTweet->tweets($userid,$limit);
    }
}