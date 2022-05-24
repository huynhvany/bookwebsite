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

<?php
  // Get blog id from input $_GET.
  $post_id = $_GET['id'];
 
  $get_query = "SELECT * 
          FROM blog_posts 
          WHERE id = '$post_id'"; //Create query
  $result = mysqli_query($conn, $get_query);//Get results 
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC);//Fetch data
  mysqli_free_result($result);
?>


<?php
  // Check for submit edit
  if(isset($_POST['edit'])){
    // Get data from form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    // Edit 
    $up_query = "UPDATE blog_posts SET
              title = '$title',
              author = '$author',
              body = '$body'
              WHERE id = '$post_id'";
    if(mysqli_query($conn, $up_query)){
      mysqli_close($conn);
      echo("<script>location.href = '".ROOT_URL."users/user_blog_posts.php';</script>");
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }
?>


<main class="colored-back-ground">
  <div class="under-navbar-padding">

  </div>
  <div>
    <a class="btn" href="<?php echo ROOT_URL;?>users/user_blog_posts.php">Back</a>
  </div>
  <div class="form-wrap full-page-option">
    <div class="form-title">
      <h2>
        Edit blog post
      </h2>
    </div>
  <!-- Action having input to feed blog_id from _GET  -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $post_id;?>">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $post[0]['title'];?>">
      </div>
      <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author"  value="<?php echo $post[0]['author'];?>">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" rows="15"><?php echo $post[0]['body']; ?></textarea>
      <div class="form-group">
        <button type="submit" name= "edit">Edit</button>
      </div>
    </form>
  </div>
</main>




<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>



