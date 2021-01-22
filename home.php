<?php
include 'backend/initialize.php';
$user_id=$_SESSION['userLoggedIn'];

$status=$verify->getVerifyStatus(["status"],$user_id);
if(isset($_SESSION['userLoggedIn']) && $status->status=='1'){
   $user_id=$_SESSION['userLoggedIn'];
}else if(Login::isLoggedIn()){
   $user_id=Login::isLoggedIn();
}else{
    redirect_to(url_for('index'));
}

?>