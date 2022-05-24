<!-- Header and Navbar -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>


<!-- Check, Filter and Insert data-->
<?php 
  // Warning message
  $msg='';
  
  //When click Submit 
  if(filter_has_var(INPUT_POST, 'submit')) {
    // All field is filled, then get data submitted, htmlentities for safety 
    $full_name = htmlentities($_POST['full_name']);
    $user_name = htmlentities($_POST['user_name']);
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // Check all field is filled
    if(!empty($full_name)&& !empty($user_name) && !empty($email) && !empty($password)) {
      //Validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        //Email is not valid
        $msg = 'Please use a valid email';
        $msgClass = 'alert-danger';
        echo $msg;
      } else {
        $user_name_query = "SELECT * FROM users WHERE user_name= '$user_name';"; //Create query
        $user_name_result = mysqli_query($conn, $user_name_query);//Get results 
        $user_name_found = mysqli_num_rows($user_name_result) > 0? true: false;//Check number of rows
        mysqli_free_result($user_name_result);//Free Result;

        $email_query = "SELECT * FROM users WHERE email = '$email';";
        $email_result = mysqli_query($conn, $email_query);
        $email_found = mysqli_num_rows($email_result) > 0? true: false;
        mysqli_free_result($email_result);

        if ($user_name_found || $email_found) {
          // echo 'Exist---> Move to Login page';
          $msg="Username or email already registered <a href=".ROOT_URL."users/login.php>Login</a>";
          $msgClass='alert-danger';
        
        } else {
          // Legal ---> Insert data in to users table
          $insert_query = "INSERT INTO users (user_name, email, password, full_name)
                            VALUES ('$user_name', '$email', '$hash_password', '$full_name');" ;
          mysqli_query($conn, $insert_query);//Insert to table
          mysqli_close($conn);//Close connection 

          $msg = "Sign up success!";
  
        }
      }
    } else {
      // Need to fill all field
        $msg='Please fill in all field';
    }
  };
?>

<main class="colored-back-ground">
  <div class="under-navbar-padding">

  </div>
<!-- Sign up form -->
  <div id="sign-up">
    <div id="sign-up-form" class="full-page-form">
      <div class="form-wrap">
        <div class="form-title">
          <h3>Sign up</h3>
        </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label for="full_name">Full name</label>
            <input type="text" name="full_name" placeholder="Enter full name" value="<?php echo isset($_POST['full_name'])? $full_name:'' ?>">
          </div>
          <div class="form-group">
            <label for="user_name">Username</label>
            <input type="text" name="user_name" placeholder="Enter username" value="<?php echo isset($_POST['user_name'])? $user_name:'' ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email"  placeholder="Enter email" value="<?php echo isset($_POST['email'])? $email:'' ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" placeholder="Enter password">
          </div>
          <button type="submit" name="submit">Submit</button>
                  <!-- Pop up result for sign up -->
          <div class="status" class="<?php echo $msgClass; ?>" >
            <?php echo $msg; ?>
          </div>
        </form>
      </div>
    <div>
  </div>

</main>
<!-- Footer -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>