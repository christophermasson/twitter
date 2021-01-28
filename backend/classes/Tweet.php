<?php

class Tweet{

    private $pdo;
    private $user;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user=new User;
    }

    public function tweets($user_id){
        $stmt=$this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetBy`=`user_id` AND `user_id`=:userId ORDER BY postedOn DESC");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $tweets=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($tweets as $tweet){
            echo '<article role="article" data-focusable="true" tabindex="0" class="post">
            <div class="mainContentContainer">
               <div class="userImageContainer">
                 <img src="'.url_for($tweet->profileImage).'" alt="'.$tweet->firstName.' '.$tweet->lastName.'">
               </div>
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
                  <div class="post-footer">
                    <div class="postButtonContainer">
                       <button class="replyModal">
                           <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"/></g></svg>
                           <span class="replyCount"></span>
                       </button>
                    </div>
                    <div class="postButtonContainer">
                       <button class="retweet">
                           <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"/></g></svg>
                           <span class="retweetsCount"></span>
                       </button>
                    </div>
                    <div class="postButtonContainer">
                       <button class="like-btn">
                          <i class="fa fa-heart-o"></i>
                          <span class="likesCounter"></span>
                       </button>

                    </div>
                  </div>
               </div>
            </div>
          </article>';
        }
    }
}