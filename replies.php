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
if(is_get_request()){
    if(isset($_GET['username']) && !empty($_GET['username'])){
       $username=FormSanitizer::formSanitizerString($_GET['username']);
       $profileId=$loadFromUser->userIdByUsername($username);
       if(!$profileId){
        redirect_to(url_for('home'));
       }
    }else{
        $profileId=$user_id;
    }
}
$user=$loadFromUser->userData($user_id);
$profileData=$loadFromUser->userData($profileId);
$date_joined=strtotime($profileData->signUpDate);

$pageTitle='Tweets with replies by '.$profileData->firstName.' '.$profileData->lastName.'(@'.$profileData->username.') / Twitter';

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u-p-id" data-uid="<?php echo $user_id; ?>" data-pid="<?php echo $profileId; ?>"></div>
<section class="wrapper">
   <?php  require_once 'backend/shared/nav_header.php'; ?>
   <main role="main">
     <section class="mainSectionContainer">
        <div class="header-top">
          <div class="go-back-arrow" id="go-back-home" aria-label="Back" role="button" data-focusable="true" tabindex="0">
             <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
          </div>
          <div class="header-top-pro">
              <h4><?php echo $profileData->firstName.' '.$profileData->lastName; ?></h4>
              <?php if(!empty($loadFromTweet->tweetCounts($profileId))){ ?>
              <div class="tweet-no"><?php echo $loadFromTweet->tweetCounts($profileId); ?> Tweets</div>
              <?php } ?>
          </div>
        </div>
        <section class="profileHeaderContainer">
           <div class="coverPhotoContainer">
              <img src="<?php echo url_for($profileData->profileCover); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" aria-label="Profile Cover Image" class="cover-photo-user-me">
              <div class="userImageContainer">
                 <img src="<?php echo url_for($profileData->profileImage); ?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" aria-label="Profile Pic Image" class="profile-pic-me">
              </div>
           </div>
           <div class="profileButtonContainer">
              <button class="edit-profile-btn" role="button">Set up Profile</button>
           </div>
           <div class="userDetailsContainer">
              <span class="displayName"><?php echo $profileData->firstName.' '.$profileData->lastName; ?></span>
              <span class="username">@<?php echo $profileData->username; ?></span>
              <span class="description">
                  <svg viewBox="0 0 24 24" class=""><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                  <span class="join">
                    Joined
                  </span>
                  <span class="description__date"><?php echo date("F Y",$date_joined); ?></span>
              </span>
              <div class="followersContainer">
                 <a href="<?php echo url_for($profileData->username.'/following'); ?>">
                    <span class="value count-following">0</span>
                    <span>Following</span>
                 </a>
                 <a href="<?php echo url_for($profileData->username.'/followers'); ?>">
                    <span class="value count-followers">0</span>
                    <span>Followers</span>
                 </a>
              </div>
           </div>
        </section>
        <div class="tabsContainer">
          <?php echo $loadFromTweet->createTab('Posts',url_for($profileData->username),false); ?>
          <?php echo $loadFromTweet->createTab('Replies',url_for($profileData->username.'/replies'),true); ?>
         
        </div>
        
        <section aria-label="Timeline:Your Profile Replies Timeline" class="repliesPostsContainer">
          <?php $loadFromTweet->repliesTweet($profileId,10); ?>
        </section>
        <div class="reply-wrapper">
         
        </div>
        <div class="d-wrapper-container">
           <div class="d-wrapper">
              <div class="d-content" id="del-content">
                 <div class="d-image">
                    <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                 </div>
                 <span class="d-text" style="color:rgb(224,36,94);">
                    Delete
                 </span>
              </div>
              <div class="d-content" id="pin-content">
                 <div class="d-image">
                 <svg viewBox="0 0 24 24" class="pin-icon"><g><path d="M20.472 14.738c-.388-1.808-2.24-3.517-3.908-4.246l-.474-4.307 1.344-2.016c.258-.387.28-.88.062-1.286-.218-.406-.64-.66-1.102-.66H7.54c-.46 0-.884.254-1.1.66-.22.407-.197.9.06 1.284l1.35 2.025-.42 4.3c-1.667.732-3.515 2.44-3.896 4.222-.066.267-.043.672.222 1.01.14.178.46.474 1.06.474h3.858l2.638 6.1c.12.273.39.45.688.45s.57-.177.688-.45l2.638-6.1h3.86c.6 0 .92-.297 1.058-.474.265-.34.288-.745.228-.988zM12 20.11l-1.692-3.912h3.384L12 20.11zm-6.896-5.413c.456-1.166 1.904-2.506 3.265-2.96l.46-.153.566-5.777-1.39-2.082h7.922l-1.39 2.08.637 5.78.456.153c1.355.45 2.796 1.78 3.264 2.96H5.104z"></path></g></svg>
                 </div>
                 <span class="d-text">
                    Pin to your profile
                 </span>
              </div>
           </div>
        </div>
        <div class="del-post-wrapper-container">
           <div class="del-post-wrapper">
              <div class="del-post-content">
                 <h2 class="del-post-content-header">Delete Tweet?</h2>
                 <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow you, and from Twitter search results.</p>
                 <div class="del-btn-wrapper">
                    <button class="del-btn" id="cancel" type="button">Cancel</button>
                    <button class="del-btn" id="delete-post-btn" type="button">Delete</button>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/delete.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/reply.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/retweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/likeTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/hashtag.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>