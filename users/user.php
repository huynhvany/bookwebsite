<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<!-- Check if logged in, if not redirect to Home page. Denied direct access without login first -->
<?php 
  // If not logged in, then redirect to home page
  if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true)) {
    echo("<script>location.href = '".ROOT_URL."index.php';</script>");
  }
?>
<main>
  <div class="under-navbar-padding">

  </div>
  <div id="user-options" class="flex-options">
    <div class="flex-option">
      <div class="option-title">
        Book that you sell
      </div>
      <div class="option-icon">
        <a href="<?php echo ROOT_URL; ?>users/user_sell_items.php"><i class="fa-solid fa-circle-dollar-to-slot fa-3x"></i></a>
      </div>
    </div>
    <div class="flex-option">
      <div class="option-title">
        Books that you need
      </div>
      <div class="option-icon">
        <a href="<?php echo ROOT_URL; ?>users/user_need_items.php"><i class="fa-solid fa-cart-shopping fa-3x"></i></a>
      </div>
    </div>
    <div class="flex-option">
      <div class="option-title">
        Your donated books
      </div>
      <div class="option-icon">
      <a href="<?php echo ROOT_URL;?>users/user_donate_items.php">  <i class="fa-solid fa-hand-holding-heart fa-3x"></i></a>
      </div>
    </div>
    <div class="flex-option">
      <div class="option-title">
        Your blog posts
      </div>
      <div class="option-icon">
        <a href="<?php echo ROOT_URL; ?>users/user_blog_posts.php"><i class="fas fa-blog fa-3x"></i></a>
      </div>
    </div>
  </div>
</main>
<!-- Footer -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>