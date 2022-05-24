<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/config/config.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/config/db.php'; ?>



<div class="navbar" id="navbar">
  <div class="logo"> 
    <a href="<?php echo ROOT_URL; ?>index.php"><i class="fa-solid fa-book-open"></i><span class="text-primary"> Ex</span>book</a>
  </div>
  <div>
    <nav>
      <ul>
        <li><a href="<?php echo ROOT_URL; ?>blog_posts.php">Blog</a>
        </li>
        <!-- If already login -->
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true): ?>
          <li><a href="<?php echo ROOT_URL;?>users/user.php"><?php echo $_SESSION['user'][0]['full_name']; ?></a></li>
          <li><a href="<?php echo ROOT_URL;?>users/logout.php">Log out</a></li>
        <?php else: ?>
        <!-- Not loggedin yet -> Login option -->
          <li><a href="<?php echo ROOT_URL;?>users/sign_up.php">Sign up</a></li>
          <li><a href="<?php echo ROOT_URL;?>users/login.php">Log In</a> </li>
        <?php endif;?>
      </ul>
    </nav>
  </div>
</div>

