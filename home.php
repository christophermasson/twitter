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
     </section>
     <aside role="complementary">
        Aside
     </aside>
   </main>
</section>
<script src="<?php echo url_for("frontend/assets/js/fetchTweet.js"); ?>"></script>
<script src="<?php echo url_for("frontend/assets/js/common.js"); ?>"></script>