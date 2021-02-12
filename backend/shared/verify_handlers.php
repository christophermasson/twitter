<?php
$user_id=$_SESSION['userLoggedIn'];
if(isset($_SESSION['userLoggedIn'])){
  $verify->authOnly($user_id);

}
if(Login::isLoggedIn()){
    redirect_to(url_for('home'));
}

  
  $errors=array();
  
  if(isset($_SESSION['userLoggedIn'])){
      $user_id=(int)($_SESSION['userLoggedIn']);
      $user=$loadFromUser->userData($user_id);
      $link=$verify->generateLink();
      $message="{$user->firstName},Your account has been created,Please visit this link to verify your email <a href='http://localhost/twitter/verification/$link'>Verify Link</a>";
      $subject="[TWITTER] PLease verify your account";
      $verify->sendToMail($user->email,$message,$subject); 
      $loadFromUser->create("verification",["user_id"=>$user_id,"code"=>$link]);
  }else{
      redirect_to(url_for("index"));
  }
  
  
  if(is_get_request()){
    $user_id=(int)($_SESSION['userLoggedIn']);
    if(isset($_GET['verify'])){
      $code=FormSanitizer::formSanitizerString($_GET['verify']);
      $verifyCode=$verify->verifyCode(["*"],$code);
  
      if($verifyCode){
        if(date('Y-m-d',strtotime($verifyCode->createdAt)) < date('Y-m-d')){
          $errors['verify']="Your verification link has been expired.";
        }else{
          $loadFromUser->update("verification",$user_id,array("code"=>$code,"status"=>1));
          if(isset($_SESSION['rememberMe'])){
            $tstrong=true;
            $token=bin2hex(openssl_random_pseudo_bytes(64,$tstrong));
            $loadFromUser->create("token",["user_id"=> $user_id,"token"=>sha1($token)]);
            setcookie('FBID',$token, time() + 60*60*24*7, "/",NULL,NULL,true);
           
          }
           redirect_to(url_for("home"));
        }
      }else{
        $errors['verify']="Invalid verification Link";
      }
    }
  }
  
?>  