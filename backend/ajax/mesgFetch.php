<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['loadUserid']) && !empty($_POST['loadUserid'])){
        $userid=h((int)$_POST['loadUserid']);
        $otherid=h($_POST['otheruserid']);

        $allusersmsg=$loadFromMessage->recentMessages($userid);
        foreach($allusersmsg as $users){
            echo "Hi";
        }
        // $limit=(int)trim($_POST['fetchTweets']);
        // echo $limit;

        // $loadFromTweet->tweets($userid,$limit);
    }
}