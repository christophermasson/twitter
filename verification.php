<?php 
include_once "backend/initialize.php";
include_once "backend/shared/verify_handlers.php";


$pageTitle="Verify your Account";

?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="sign-container">
      <?php require_once 'backend/shared/loginNav.php'; ?>
       <div class="form-container">
         <div class="form-content">
          <?php if(isset($_GET['verfiy']) || !empty($_GET['verify'])){
            if(isset($errors['verify'])){
              echo '<div class="header__form-content">
              <h2> '.$errors['verify'].'</h2></div>';
            }
          }else{
          ?>
          <div class="header__form-content">
              <h2>A verification email has been sent to <?php echo $user->email; ?>,please check your <?php echo $user->email; ?> to verify your account.
            </h2>
           </div>
          <?php }  ?>
           
         </div>
       </div>
    </section>
</body>
</html>