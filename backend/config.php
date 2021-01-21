<?php

define("DB_HOST", "localhost");
define("DB_NAME", "twirrer");
define("DB_USER", "twitter");
define("DB_PASS", "password");
// define("BASE_URL", "http://localhost/twirrer");
$public_end=strpos($_SERVER['SCRIPT_NAME'],"/frontend")+9;
$doc_root=substr($_SERVER['SCRIPT_NAME'],0,$public_end);
define("WWW_ROOT",$doc_root);


// SMTP
define("M_HOST","smtp.gmail.com");
define("M_USERNAME","christopherglikpoqwesi@gmail.com");
define("M_PASSWORD","cfdaqbknmhuqkiau");
define("M_STMPSECURE","tls");
define("M_PORT",587);