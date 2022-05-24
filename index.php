<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<main>
  <div class="under-navbar-padding">

  </div>
  <session>
    <div id="home-page-intro">
      <div class="content-intro">
        <h1>Buy, Sale, Donate Books</h1>
        <p>Give your books a second life</p>
      </div>
    </div>
    <div class="flex-options" >
      <div class="flex-option">
        <div class="option-title">
          Used books      
        </div>
        <div class="option-icon">
          <a href="sell_items.php"><i class="fa-solid fa-cart-shopping fa-3x"></i></a>
        </div>
      </div>
      <div class="flex-option">      
        <div class="option-title">
          Books other people need
        </div>
        <div class="option-icon">
          <a href="needed_items.php"><i class="fa-solid fa-circle-dollar-to-slot fa-3x"></i></a>
        </div>
      </div>
      <div class="flex-option">
        <div class="option-title">
          Free books
        </div>
        <div class="option-icon">
          <a href="donate_items.php"><i class="fa-solid fa-hand-holding-heart fa-3x"></i></a>
        </div>
      </div>
    </div>
  </session>

  <?php
    // Check for submit
    if(isset($_POST['submit'])){
      // Get data from form
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);


      $query = "INSERT INTO support(title, name, email, message)
                VALUES ('$title', '$name', '$email', '$message')";
      
      if(mysqli_query($conn, $query)){
        mysqli_close($conn);//Close connection 
        echo("<script>location.href = '".ROOT_URL."index.php';</script>");
      } else {
        echo 'ERROR: '. mysqli_error($conn);
      }
    }
  ?>
  <session id="about-contact">
    <div class="flex-items">
      <div class="flex-item">
        <div>
          <h3>About Us</h3>
        </div>
        <div>
          <p>This online site allows you to sell your used books and tell others what book you need. If you want to donate your book, just leave the infomation and a charity will contact your soon. You can tell your story about anything related to books on the blog site.</p>
        </div>
      </div>
      <div class="flex-item">
        <div>
          <h3>Our Team</h3>
        </div>
        <div>
          <p>We’re hiring! Join us and build impactful product.</p>
        </div>       
      </div>
      <div  class="flex-item">
        <div>
          <h3>Contact</h3>
        </div>
        <div id="contact-form" class="form-wrap">
          <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" placeholder="Enter Title">
            </div>
            <div  class="form-group">
              <label for="message">Message</label>
              <textarea name="message" rows="5"  style="overflow:auto" value=""></textarea>
            </div>
            <button type="submit" class ="btn" name="submit">Send</button>
            </div>
          </form>       
        </div>
      </div>
    </div>
  </session>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>
