<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['loadUserid']) && !empty($_POST['loadUserid'])){
        $userid=h($_POST['loadUserid']);
        $otherid=h($_POST['otheruserid']);

        $allusersmsg=$loadFromMessage->recentMessages($userid);
        foreach($allusersmsg as $user){
            $activeclass=($user->user_id==$otherid) ? "activeClass" : "";
            echo '<li class="msg-user-name-wrap '.$activeclass.'" data-profileid="'.$user->user_id.'">
            <div class="msg-user-name-wrap">
                <div class="msg-user-photo">
                    <img src="'.url_for($user->profileImage).'" alt="'.$user->firstName.' '.$user->lastName.'">
                </div>
                <div class="msg-user-name-text">
                    <div class="msg-user-new">
                        <div class="msg-user-name">
                            <h3>'.$user->firstName.' '.$user->lastName.'</h3>
                            <span class="msg-username">@'.$user->username.'</span>
                        </div>
                        <div class="msg-user-text">
                            <div class="msg-previ">
                            '.$user->message.'
                            </div>
                        </div>
                    </div>
                    <div class="msg-date-wrapper">
                        <div class="msg-date">'.$loadFromUser->timeAgo($user->messageOn).'</div>
                    </div>
                </div>
            </div>
        </li>';
        }
        // $limit=(int)trim($_POST['fetchTweets']);
        // echo $limit;

        // $loadFromTweet->tweets($userid,$limit);
    }

    if(isset($_POST['otherpersonid']) && !empty($_POST['otherpersonid'])){
        $userid=h($_POST['userId']);
        $otherid=h($_POST['otherpersonid']);
        $messageData=$loadFromMessage->messageData($otherid,$userid);
        if(!empty($messageData)){
            echo '<div class="past-data-count" datacount="'.count($messageData).'"></div>';
            foreach($messageData as $message){
                if($message->messageFrom ==$userid){
                    echo '<div class="right-sender-msg">
                    <div class="right-sender-text-time">
                        <div class="right-sender-text-wrapper">
                            <div class="s-text">
                                <div class="s-msg-text">
                                    '.$message->message.'
                                </div>
                            </div>
                        </div>
                        <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                    </div>
               </div>';
                }else{
                    echo '<div class="left-receiver-msg">
                    <a href="'.url_for(h(u($message->username))).'" class="receiver-img">
                      <img src="'.url_for($message->profileImage).'" alt="'.$message->firstName.' '.$message->lastName.'">
                   </a>
                   <div class="receiver-text-time">
                        <div class="left-receiver-text-wrapper">
                                    <div class="r-text">
                                        <div class="r-msg-text">
                                        '.$message->message.'
                                        </div>
                                    </div>
                        </div>
                    <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                    </div>
                </div>';
                }
            }
        }
    }
}
