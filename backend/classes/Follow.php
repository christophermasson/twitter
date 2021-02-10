<?php
 class Follow{
     private $pdo,$user;

     public function __construct(){
         $this->pdo=Database::instance();
         $this->user=new User;
     }

     public function checkFollow($followID,$user_id){
         $stmt=$this->pdo->prepare("SELECT * FROM `follow` WHERE `sender`=:userId AND `receiver`=:followID");
         $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
         $stmt->bindParam(":followID",$followID,PDO::PARAM_INT);
         $stmt->execute();
         return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     public function profileBtn($profileId,$userId){
         $data=$this->checkFollow($profileId,$userId);
         $userData=$this->user->userData($userId);
         if($profileId != $userId){
             if(!empty($data['receiver'])===$profileId){
                 echo '<button class="p-btn" aria-label="Message" data-focusable="true" tabindex="0" role="button">
                     <svg xmlns="http://www.w3.org/2000/svg" class="p-btn-icon" viewBox="0 0 24 24"><g><path d="M19.25 3.018H4.75C3.233 3.018 2 4.252 2 5.77v12.495c0 1.518 1.233 2.753 2.75 2.753h14.5c1.517 0 2.75-1.235 2.75-2.753V5.77c0-1.518-1.233-2.752-2.75-2.752zm-14.5 1.5h14.5c.69 0 1.25.56 1.25 1.25v.714l-8.05 5.367c-.273.18-.626.182-.9-.002L3.5 6.482v-.714c0-.69.56-1.25 1.25-1.25zm14.5 14.998H4.75c-.69 0-1.25-.56-1.25-1.25V8.24l7.24 4.83c.383.256.822.384 1.26.384.44 0 .877-.128 1.26-.383l7.24-4.83v10.022c0 .69-.56 1.25-1.25 1.25z"/></g></svg>
                 </button>
                 <button class="f-btn p-btn unfollow-btn" data-follow="'.$profileId.'">Following</button>
                 ';
             }else{
                echo '<button class="p-btn" aria-label="Message" data-focusable="true" tabindex="0" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="p-btn-icon" viewBox="0 0 24 24"><g><path d="M19.25 3.018H4.75C3.233 3.018 2 4.252 2 5.77v12.495c0 1.518 1.233 2.753 2.75 2.753h14.5c1.517 0 2.75-1.235 2.75-2.753V5.77c0-1.518-1.233-2.752-2.75-2.752zm-14.5 1.5h14.5c.69 0 1.25.56 1.25 1.25v.714l-8.05 5.367c-.273.18-.626.182-.9-.002L3.5 6.482v-.714c0-.69.56-1.25 1.25-1.25zm14.5 14.998H4.75c-.69 0-1.25-.56-1.25-1.25V8.24l7.24 4.83c.383.256.822.384 1.26.384.44 0 .877-.128 1.26-.383l7.24-4.83v10.022c0 .69-.56 1.25-1.25 1.25z"/></g></svg>
            </button>
            <button class="f-btn p-btn follow-btn" data-follow="'.$profileId.'">Follow</button>
            ';
             }
         }else{
             if($userData->profileEdit==1){
                echo '<button class="p-edit-btn" role="button">Edit Profile</button>';
             }else{
                echo '<button class="edit-profile-btn" role="button">Set up Profile</button>';
             }
            
         }
     }
 }

?>