<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['onlyStatusText']) && !empty($_POST['onlyStatusText'])){
        $userid=h($_POST['userid']);
        $allowed_tags='<div><li><h2><h3><h1><ul><p><em><strong><br>';
        $statusText=strip_tags($_POST['onlyStatusText'],$allowed_tags);
        $lastId=$loadFromUser->create("tweets",array("status"=>$statusText,"tweetBy"=>$userid,"postedOn"=>date('Y-m-d H:i:s')));
        preg_match_all("/#+([a-zA-Z0-9_]+)/i",$statusText,$hashtag);
        if(!empty($hashtag)){
            $loadFromTweet->addTrend($statusText,$lastId,$userid);
        }
        $loadFromTweet->tweets($userid,10);
    }
}