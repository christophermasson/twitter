<?php
if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for('home'));
  }else if(Login::isLoggedIn()){
    redirect_to(url_for('home'));
  }
  
  if(is_post_request()){
    if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
    $fname=FormSanitizer::formSanitizerName($_POST['firstName']);
    $lname=FormSanitizer::formSanitizerName($_POST['lastName']);
    $email=FormSanitizer::formSanitizerString($_POST['email']);
    $pass=FormSanitizer::formSanitizerString($_POST['password']);
    $pass2=FormSanitizer::formSanitizerString($_POST['password2']);
    $username=$account->generateUsername($fname,$lname);
  
    $wasSuccessful=$account->register($fname,$lname,$username,$email,$pass,$pass2);
    if($wasSuccessful){
      $_SESSION['userLoggedIn']=$wasSuccessful;
      if(isset($_POST['remember'])){
          $_SESSION['rememberMe']=$_POST['remember'];
      }
      redirect_to(url_for("verification"));
    }
      
    }
  }



?>