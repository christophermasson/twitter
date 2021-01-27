<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['onlyStatusText']) && !empty($_POST['onlyStatusText'])){
        $userid=h($_POST['userid']);
        $allowed_tags='<div><li><h2><h3><h1><ul><p><em><strong><br>';
        $statusText=strip_tags($_POST['onlyStatusText'],$allowed_tags);
        $lastId=$loadFromUser->create("tweets",array("status"=>$statusText,"tweetBy"=>$userid));
        echo $lastId;
    }
}