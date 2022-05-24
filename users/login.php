<!-- Header and Navbar -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<!-- Check, Filter and Insert data-->
<?php 
  // Warning message
  $msg='';
  
  //When click Submit 
  if(filter_has_var(INPUT_POST, 'login')) {
    // All field is filled, then get data submitted, htmlentities for safety 
    $user_name_email = htmlentities($_POST['user_name_email']);
    $password = htmlentities($_POST['password']);
    $password_query = "SELECT password FROM users 
                  WHERE ((user_name= '$user_name_email' OR email='$user_name_email'));"; //Create query
    $password_result = mysqli_query($conn, $password_query);//Get results
    $password_found = mysqli_num_rows($password_result) == 1? true: false;//Check number of rows
    if($password_found) {
        // Store user data to session 
        $hashed_password_result = mysqli_fetch_all($password_result, MYSQLI_ASSOC);
        $hashed_password = $hashed_password_result[0]['password'];
        if(password_verify($password, $hashed_password)) {
          $login_query ="SELECT * FROM users 
                  WHERE ((user_name= '$user_name_email' OR email='$user_name_email'));";
          $login_result = mysqli_query($conn, $login_query);
          $user = mysqli_fetch_all($login_result, MYSQLI_ASSOC);//Fetch data to get 2 dimensional array
          //Start a session to store login status
          $_SESSION['loggedin'] = true;
          $_SESSION['user'] = $user;    
  
          mysqli_free_result($login_result);//Free Result;
          mysqli_close($conn);//Close connection  

          // Login successful or Redirect to welcome page. Need some waiting effect for succeful login
          echo("<script>location.href = '".ROOT_URL."index.php';</script>");
        } else{
          $msg='Invalid username, email or password';
        }

    } else {
        // Need to fill all field
        $msg='Invalid username, email or password';
    };
  }
?>
<main class="colored-back-ground">
  <div class="under-navbar-padding">

  </div>
  <div id="login">
    <div id="login-form" class="full-page-form">
      <div class="form-wrap">
        <div class="form-title">
          <h3>Login </h3>
        </div>
        <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label for="user_name_email">Username or Email</label>
            <input type="text" name="user_name_email" placeholder="Username or email" value="<?php echo isset($_POST['user_name_email'])? $user_name_email:'' ;?>" >
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" >
          </div class="form-group">
            <button type="submit" name="login">Login</button>
          <div class="status">
            <!-- Forgot password -> Move to contact page -->
            <a href="<?php echo ROOT_URL?>index.php#about-contact">Forgotten password?</a>
          </div>
          <div class="status">
            <!-- Sign up an account -->
            <a href="<?php echo ROOT_URL?>users/sign_up.php">Create New Account</a>
          </div>
          <!-- Pop up result for login -->
          <?php if($msg!=''): ?>
            <div class="status">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>
        </form>
      </div>
  </div>
</main>
  
 
<!-- Footer -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>