<?php

require_once "../initialize.php";

if(is_post_request()){
    if(isset($_FILES['croppedImage']) && !empty($_FILES['croppedImage'])){
      $file=$_FILES['croppedImage'];
      $userId=h($_POST['userId']);
      $folder=$loadFromUser->cropProfileImageUpload($_FILES['croppedImage'],$userId);
      $loadFromUser->update("users",$userId,array('profileImage'=>$folder));      

    }

    if(isset($_FILES['croppedCoverImage']) && !empty($_FILES['croppedCoverImage'])){
        $file=$_FILES['croppedCoverImage'];
        $userId=h($_POST['userId']);
        $folder=$loadFromUser->cropCoverImageUpload($_FILES['croppedCoverImage'],$userId);
        $loadFromUser->update("users",$userId,array('profileCover'=>$folder,'profileEdit'=>1));      
  
      }
}