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
          FROM sell_items 
          WHERE id = $post_id"; //Create query
  $result = mysqli_query($conn, $get_query);//Get results 
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC);//Fetch data
  mysqli_free_result($result);
?>

<?php
  // Check for submit edit
  if(isset($_POST['edit'])){
    // Get data from form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $completed = mysqli_real_escape_string($conn, $_POST['completed']);
    // Edit 
    $up_query = "UPDATE sell_items SET
              title = '$title',
              genre = '$genre',
              author = '$author',
              price = '$price',
              contact = '$contact',
              location = '$location',
              completed = '$completed'
              WHERE id = '$post_id'";
    if(mysqli_query($conn, $up_query)){
      echo("<script>location.href = '".ROOT_URL."users/user_sell_items.php';</script>");
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }
?>

<main class="colored-back-ground">
  <div class="under-navbar-padding">

  </div>
  <div>
    <a class="btn" href="<?php echo ROOT_URL;?>users/user_sell_items.php">Back</a>
  </div>
  <div class="form-wrap full-page-option">
    <div class="form-title">
      <h2>
        Edit sell post
      </h2>
    </div>
      <!-- Action having input to feed blog_id from _GET  -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $post_id;?>">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo $post[0]['title'];?>">
      </div>

      <div class="form-group">
        <label for="genre">Genre</label>
        <input type="text" name="genre" value="<?php echo $post[0]['genre'];?>" >
      </div>
      <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author"  value="<?php echo $post[0]['author'];?>">
      </div>
      <div class="form-group">
        <label for="price">Price (&dollar;)</label>
        <input type="number" step="0.1" name="price" value="<?php echo $post[0]['price'];?>" >
      </div>
      <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" name="contact" value="<?php echo $post[0]['contact'];?>">
      </div>
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" value="<?php echo $post[0]['location'];?>">
      </div>
      <div class="form-group">
        <label for="completed">Completed</label>
        <select name="completed">
          <option value="No">No</option>
          <option value="Yes">Yes</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" name= "edit">Edit</button>
      </div>
    </form>
  </div>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>

