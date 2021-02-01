<?php

class Tweet{

    private $pdo;
    private $user;
    private $tweetControls;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user=new User;
        $this->tweetControls=new TweetControls;
    }

    public function tweets($user_id,$num){
        $stmt=$this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetBy`=`user_id` AND `user_id`=:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $tweets=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($tweets as $tweet){
           $controls=$this->tweetControls->createControls($tweet->tweetID,$tweet->tweetBy,$user_id);
            echo '<article role="article" data-focusable="true" tabindex="0" class="post">
            <div class="mainContentContainer">
               <a href="'.url_for($tweet->username).'" role="link" class="userImageContainer">
                 <img src="'.url_for($tweet->profileImage).'" alt="'.$tweet->firstName.' '.$tweet->lastName.'">
               </a>
               <div class="postContentContainer">
                  <div class="post-header">
                     <div class="post-header-featured-left">
                        <a href="'.url_for($tweet->username).'" class="displayName">'.$tweet->firstName.' '.$tweet->lastName.'</a>
                        <span class="username">@'.$tweet->username.'</span>
                        <span class="date">'.$this->user->timeAgo($tweet->postedOn).'</span>
                     </div>
                     <span class="dot deletePostButton" id="deletePostModal">
                     <svg class="dot-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"/></g></svg>
                     </span>
                  </div>
                  <div class="post-body">
                    <div>'.$tweet->status.'</div>
                   </div>
                  '.$controls.'
               </div>
            </div>
          </article>';
        }
    }

    public function getTrendByHash($hashtag){
       $stmt=$this->pdo->prepare("SELECT DISTINCT `hashtag` FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
       $stmt->bindValue(":hashtag",$hashtag.'%');
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMention($mention){
      $stmt=$this->pdo->prepare("SELECT * FROM `users` WHERE `username` LIKE :mention OR `firstName` LIKE :mention OR `lastName` LIKE :mention LIMIT 5");
      $stmt->bindValue(":mention",$mention.'%');
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
   }

   public function addTrend($hashtag,$tweetId,$user_id){
      preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
      if($matches){
         $result=array_values($matches[1]);
      }

      $sql="INSERT INTO `trends` (`hashtag`,`tweetID`,`user_id`,`createdOn`) VALUES (:hashtag,:tweetId,:userId,:dateOn)";
 
      foreach($result as $trend){
         if($stmt=$this->pdo->prepare($sql)){
            $stmt->execute(array(':hashtag'=>$trend,':tweetId'=>$tweetId,':userId'=>$user_id,'dateOn'=>date('Y-m-d H:i:s')));
         }
      }

   }

   public function getLikes($postId){
      $stmt=$this->pdo->prepare("SELECT count(*) as `count` FROM `likes` WHERE `likeOn`=:tweetId");
      $stmt->bindParam(":tweetId",$postId,PDO::PARAM_INT);
      $stmt->execute();
      $data=$stmt->fetch(PDO::FETCH_ASSOC);
      if($data["count"] > 0){
         return $data["count"];
      }
   }

   
  
}