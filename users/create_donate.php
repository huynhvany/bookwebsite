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
    // Get from data 
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $query = "INSERT INTO donate_items(user_id, title, genre, author,  contact, location)
              VALUES ('$user_id','$title', '$genre', '$author','$contact', '$location');";
    
    if(mysqli_query($conn, $query)){
      mysqli_close($conn); //Close connection 
      echo("<script>location.href = '".ROOT_URL."users/user_donate_items.php';</script>");
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }

?>
<main class="colored-back-ground">
  <div class="under-navbar-padding">

  </div>
  <div>
      <a class="btn" href="<?php echo ROOT_URL;?>users/user_donate_items.php">Back</a>
  </div>

  <div class="form-wrap full-page-option">
    <div class="list-title">
      <h3>Create new post</h3>
    </div>
    <form method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?>>
      <div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title">
        </div>
        <div class="form-group">
          <label for="genre">Genre</label>
          <input type="text" name="genre" >
        </div>
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" name="author" >
        </div>
        <div class="form-group">
          <label for="contact">Contact</label>
          <input type="text" name="contact">
        </div>
        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" name="location" >
        </div>
        <div class="form-group">
          <button type="submit" name= "create">Create</button>
        </div>
      </div>
    </form>
  </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>
