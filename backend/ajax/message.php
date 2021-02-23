<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_POST['useridForAjax']) && !empty($_POST['useridForAjax'])){
        $userid=h($_POST['useridForAjax']);
        $otherid=h($_POST['otheridForAjax']);
        $msg=$_POST['msg'];
        $lastMsgId=$loadFromUser->create("messages",array("message"=>$msg,"messageFrom"=>$userid,"messageTo"=>$otherid,"messageOn"=>date('Y-m-d H:i:s')));


        if($otherid != $userid){
            $loadFromUser->create('notification',array('notificationFor'=>$otherid,'notificationFrom'=>$userid,"type"=>"message","target"=>$lastMsgId,"status"=>"0","notificationCount"=>"0",'notificationOn'=>date('Y-m-d H:i:s')));
        }
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

    if(isset($_POST['showmsg']) && !empty($_POST['showmsg'])){
        $userid=h($_POST['yourid']);
        $otherid=h($_POST['showmsg']);

       
        
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
