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
  $user = $_SESSION['user'][0];
  $user_id = $user['id'];
  // Check for submit
  if(isset($_POST['create'])){
    // Get data from form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "INSERT INTO blog_posts(title, user_id, author, body)
              VALUES ('$title', '$user_id', '$author', '$body')";
    
    if(mysqli_query($conn, $query)){
      mysqli_close($conn);//Close connection 
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
  
  <div class="form-wrap full-page-option" >
    <div class="list-title">
      <h3>Create new post</h3>
    </div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title">
      </div>
      <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" value="<?php echo $user['full_name'];?>">
      </div>
      <div class="form-group">
        <label for="">Body</label>
        <textarea name="body" rows="15" ></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name= "create">Create</button>
      </div>
    </form>
  </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>
