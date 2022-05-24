<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<!-- Check if logged in, if not redirect to Home page. Denied direct access without login first -->
<?php 
  // If not logged in, then redirect to home page
  if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true)) {
    // Redirect to home page 
    echo("<script>location.href = '".ROOT_URL."index.php';</script>");
  }
?>
<main>
<?php
  $post_id = $_GET['id'];
  // Check delete submittion
  if(isset($_POST['confirm'])){
    $query = "DELETE FROM sell_items
              WHERE id= '$post_id'";
    echo $query;
    if(mysqli_query($conn, $query)){
      mysqli_close($conn);
      echo("<script>location.href = '".ROOT_URL."users/user_sell_items.php';</script>");
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }
?>

<main>
  <div class="under-navbar-padding">

  </div>
  <div>
      <a class="btn" href="<?php echo ROOT_URL;?>users/user_sell_items.php">Back</a>
  </div>
  <div class="delete-confirm">
    <p>Are you sure you want to delete this item?</p>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $post_id;?>">
      <div>
        <button class="btn" type="submit" name= "confirm">Delete</button>
      </div>
    </form>
  </div>
</main>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>

