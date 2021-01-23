<?php

if(!isset($pageTitle)){
    $pageTitle="Twitter.It's what's happening / Twitter";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo url_for('frontend/assets/favicon/twitter.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/master.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('frontend/assets/css/font-awesome/css/font-awesome.css'); ?>">
    <script src="<?php echo url_for('frontend/assets/js/jquery.min.js')  ?>"></script>

</head>
<body>

