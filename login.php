<?php 
include_once "backend/initialize.php";
include_once "backend/shared/login_handlers.php";


$pageTitle="Login on Twitter | Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="sign-container">
      <?php require_once 'backend/shared/loginNav.php'; ?>
       <div class="form-container">
         <div class="form-content">
          <div class="header__form-content">
              <h2>Log in to Twitter</h2>
           </div>
           <form  class="formField" action="<?php echo h($_SERVER["PHP_SELF"]);?>" method="POST">
             <div class="form-group">
                 <?php echo $account->getError(Constant::$loginPasswordFailed); ?>
                  <label for="username">Username or Email</label>
                  <input type="text" name="username" id="username" value="<?php getInputValue('username'); ?>" autocomplete="off" required>    
            </div>
             <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" name="password" id="password" required>
             </div>
             <div class="s-password">
               <input type="checkbox" class="form-checkbox" id="s-password" onclick="showLoginPassword()">
               <label for="s-password">Show Password</label>
             </div>
             <div class="form-btn-wrapper">
               <button type="submit" class="btn-form">Log In</button>
               <input type="checkbox" class="form-checkbox" id="check" name="remember">
               <label for="check">Remember me</label>
             </div>
           </form>
         </div>
         <footer class="form-footer">
           <p>New to Twitter? <a href="signUp">Signup for Twitter</a></p>
         </footer>
       </div>
    </section>

  <script src="frontend/assets/js/showPassword.js"></script> 
</body>
</html>