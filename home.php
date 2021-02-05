<?php
include 'backend/initialize.php';

if(isset($_SESSION['userLoggedIn'])){
   $user_id=$_SESSION['userLoggedIn'];
}else if(Login::isLoggedIn()){
   $user_id=Login::isLoggedIn();
}
$status=$verify->getVerifyStatus(["status"],$user_id);
if(!$status->status=='1'){
   redirect_to(url_for('index'));
}

$user=$loadFromUser->userData($user_id);

$pageTitle="Home / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u-p-id" data-uid="<?php echo $user_id; ?>"></div>
<section class="wrapper">
   <?php  require_once 'backend/shared/nav_header.php'; ?>
   <main role="main">
     <section class="mainSectionContainer">
        <div class="header-top">
           <h4>Home</h4>
           <img src="<?php echo url_for("frontend/assets/images/star.svg"); ?>" width="40px" height="40px" alt="">
        </div>
        <div class="header-post">
           <a href="<?php echo url_for($user->username); ?>" role="link" class="userImageContainer" aria-label="<?php echo $user->firstName.' '.$user->lastName; ?>">
              <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php echo $user->firstName.' '.$user->lastName; ?>">
           </a>
           <form class="textareaContainer">
              <textarea  id="postTextarea" placeholder="What's happening?" aria-label="What's happening?"></textarea>
              <div class="hash-box-wrapper">
                 <div class="hash-box" role="listbox" aria-multiselectable="false">
                    <ul>
                    </ul>
                 </div>
              </div>
              <div class="buttonsContainer">
                 <input type="submit" id="submitPostButton" disabled="true" role="button" value="POST">
                 <div class="w-count-wrapper">
                     <div id="count">200</div>
                     <div class="vertical-pipe"></div>
                 </div>
              </div>
           </form>
        </div>
        <section aria-label="Timeline:Your Home Timeline" class="postContainer">
          <?php $loadFromTweet->tweets($user_id,10); ?>
        </section>
        <div class="reply-wrapper">
          <div class="reply-modal-content">
            <div class="reply-modal-header">
               <span class="close" aria-label="Close" data-focusable="true" role="button" tabindex="0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="close-icon" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" class="mercado-match" width="16" height="16" focusable="false">
                     <path d="M14 3.41L9.41 8 14 12.59 12.59 14 8 9.41 3.41 14 2 12.59 6.59 8 2 3.41 3.41 2 8 6.59 12.59 2z"/>
                  </svg>
               </span>
            </div>
            <div class="reply-modal-body">
               <div class="reply-container">
                  <div class="reply-wrapper-image">
                     <img  src="<?php echo url_for('frontend/assets/images/defaultProfilePic.png'); ?>" alt="">
                  </div>
                  <div class="reply-content-wrapper">
                     <div class="reply-content-desc">
                        <div class="reply-user-fullName">
                            Daniel Brown
                        </div>
                        <div class="reply-username">
                          @brown
                        </div>
                        <div class="reply-date">
                          <span class="reply-date-time">.</span>1h
                        </div>
                        
                     </div>
                     <div class="reply-desc-text">
                          Hello
                     </div>
                     <div class="reply-to-desc">
                       <span class="reply-to">Reply to</span><a href="#" class="reply-username-link">@brown</a>
                     </div>
                  </div>
               </div>
               <div class="vertical-pip"></div>
               <div class="reply-user-msg">
                 <div class="reply-wrapper-image">
                    <img  src="<?php echo url_for('frontend/assets/images/profilePic.jpeg'); ?>" alt="">
                 </div>
                 <textarea id="replyInput" placeholder="Tweet your reply" autofocus></textarea>
               </div>
            </div>
            <div class="reply-modal-footer">
               <button class="reply-btn" id="replyBtn" role="button" data-focusable="true" tabindex="0" disabled="true">
                  Reply
               </button>
            </div>
          </div>
        </div>
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/retweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/likeTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/hashtag.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>