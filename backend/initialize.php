<?php

ob_start();
date_default_timezone_set("Africa/Accra");

require_once "config.php";
include "classes/Exception.php";
include "classes/PHPMailer.php";
include "classes/SMTP.php";

session_start();



// include "classes/Database.php";
// include "classes/FormSanitizer.php";
spl_autoload_register(function($class){
    require_once "classes/$class.php";
});





$account=new Account;
$tweetControls=new TweetControls;
$loadFromUser=new User;
$verify=new Verify;
$loadFromTweet=new Tweet;
$loadFromFollow=new Follow;
$loadFromMessage=new Message;

include "functions.php";



?>

