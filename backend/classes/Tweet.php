<?php

class Tweet{

    private $pdo;
    private $user;
   //  private $tweetControls;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user=new User;
      //   $this->tweetControls=new TweetControls;
    }

    public function tweets($user_id,$num){
        $stmt=$this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetBy`=`user_id` AND `user_id`=:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $tweets=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($tweets as $tweet){
           $tweetControls=new TweetControls;
           $controls=$tweetControls->createControls($tweet->tweetID,$tweet->tweetBy,$user_id);
           $retweet=$this->checkRetweet($user_id,$tweet->tweetID);
           if(!empty($retweet)){
              $retweetUserData=$this->user->userData($retweet->retweetBy);
           }
            echo '<article role="article" data-focusable="true" tabindex="0" class="post">
            '.(((!empty($retweet->retweetBy))==$user_id) ? '<div class="retweet-header">
                <div class="retweet-image">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"/></g></svg></div>
                <div class="retweet-user-link">
                   <a href="'.url_for(h($retweetUserData->username)).'" role="link" data-focusable="true" class="retweet-link">
                      <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.'</span>
                   </a>
                </div>
            </div>
            ' : '').'
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

   public function likes($user_id,$postId){
      if($this->wasLikedBy($user_id,$postId)){
         //User has already liked
         $this->user->delete('likes',array('likeBy'=>$user_id,'likeOn'=>$postId));
         $result=array("likes"=>-1);
         return json_encode($result);
      }else{
         //User has notliked
          $this->user->create('likes',array('likeBy'=>$user_id,'likeOn'=>$postId));
          $result=array("likes"=>1);
          return json_encode($result);
      }
   }

   public function wasLikedBy($user_id,$postId){
      $stmt=$this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy`=:userId AND likeOn=:postId");
      $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
      $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount() > 0;
   }

   public function getRetweet($postId){
      $stmt=$this->pdo->prepare("SELECT count(*) as `count` FROM `retweet` WHERE `retweetFrom`=:tweetId");
      $stmt->bindParam(":tweetId",$postId,PDO::PARAM_INT);
      $stmt->execute();
      $data=$stmt->fetch(PDO::FETCH_ASSOC);
      if($data["count"] > 0){
         return $data["count"];
      }
   }
   public function retweetCount($retweetBy,$tweetID,$status){
      if($this->wasRetweetBy($retweetBy,$tweetID)){
         //User has already liked
         $this->user->delete('retweet',array('retweetBy'=>$retweetBy,'retweetFrom'=>$tweetID));
         $result=array("retweets"=>-1);
         return json_encode($result);
      }else{
         //User has notliked
          $this->user->create('retweet',array('retweetBy'=>$retweetBy,'retweetFrom'=>$tweetID,'status'=>$status,'tweetOn'=>date('Y-m-d H:i:s')));
          $result=array("retweets"=>1);
          return json_encode($result);
      }
   }

   public function wasRetweetBy($retweetBy,$tweetID){
      $stmt=$this->pdo->prepare("SELECT * FROM `retweet` WHERE `retweetBy`=:userId AND retweetFrom=:postId");
      $stmt->bindParam(":userId",$retweetBy,PDO::PARAM_INT);
      $stmt->bindParam(":postId",$tweetID,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount() > 0;
   }

  public function checkRetweet($user_id,$tweetID){
   return $this->user->get("retweet",["*"],array("retweetBy"=>$user_id,"retweetFrom"=>$tweetID));
  }

  public function getModalTweetData($tweetID,$tweetBy){
   $stmt=$this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON users.user_id=tweets.tweetBy WHERE `tweetBy`=:tweetBy AND tweetID=:tweetID");
   $stmt->bindParam(":tweetBy",$tweetBy,PDO::PARAM_INT);
   $stmt->bindParam(":tweetID",$tweetID,PDO::PARAM_INT);
   $stmt->execute();
   return $stmt->fetch(PDO::FETCH_OBJ);
}
  public function getComments($postId){
      $stmt=$this->pdo->prepare("SELECT count(*) as `count` FROM `comment` WHERE `commentOn`=:tweetId");
      $stmt->bindParam(":tweetId",$postId,PDO::PARAM_INT);
      $stmt->execute();
      $data=$stmt->fetch(PDO::FETCH_ASSOC);
      if($data["count"] > 0){
         return $data["count"];
      }
  }

  public function comment($commentBy,$commentOn,$comment){
      if($this->wasCommentBy($commentBy,$commentOn)){
         //User has already liked
         $this->user->delete('comment',array('commentBy'=>$commentBy,'commentOn'=>$commentOn));
         $result=array("comments"=>-1);
         return json_encode($result);
      }else{
         //User has notliked
         $this->user->create('comment',array('commentBy'=>$commentBy,'commentOn'=>$commentOn,'comment'=>$comment,'commentAt'=>date('Y-m-d H:i:s')));
         $result=array("comments"=>1);
         return json_encode($result);
      }
  }

  public function wasCommentBy($commentBy,$commentOn){
   $stmt=$this->pdo->prepare("SELECT * FROM `comment` WHERE `commentBy`=:userId AND commentOn=:postId");
   $stmt->bindParam(":userId",$commentBy,PDO::PARAM_INT);
   $stmt->bindParam(":postId",$commentOn,PDO::PARAM_INT);
   $stmt->execute();
   return $stmt->rowCount() > 0;
  }

  public function delComment($commentBy,$commentOn){
      if($this->wasCommentBy($commentBy,$commentOn)){
         //User has already liked
         $this->user->delete('comment',array('commentBy'=>$commentBy,'commentOn'=>$commentOn));
         $result=array("delComment"=>-1);
         return json_encode($result);
      }
  }
  
}