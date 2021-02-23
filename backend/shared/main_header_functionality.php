<?php
include 'backend/initialize.php';

if(isset($_SESSION['userLoggedIn'])){
   $user_id=$_SESSION['userLoggedIn'];
   $verify->authOnly($user_id);
}else if(Login::isLoggedIn()){
   $user_id=Login::isLoggedIn();
}else{
   redirect_to(url_for('index'));
}

if(is_get_request()){
    if(isset($_GET['username']) && !empty($_GET['username'])){
       $username=FormSanitizer::formSanitizerString($_GET['username']);
       $profileId=$loadFromUser->userIdByUsername($username);
       if(!$profileId){
        redirect_to(url_for('home'));
       }
    }else{
        $profileId=$user_id;
    }
}
$user=$loadFromUser->userData($user_id);
$profileData=$loadFromUser->userData($profileId);
$notificationCount=$loadFromMessage->notificationCount($user_id);

?>