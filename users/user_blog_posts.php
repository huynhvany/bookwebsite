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

<!-- Lists of blog posts -->
<?php
  $user_id = $_SESSION['user'][0]['id'];
  $query = "SELECT * 
            FROM blog_posts 
            WHERE user_id = '$user_id'
            ORDER BY created_at DESC ;" ; //Create query
  $result = mysqli_query($conn, $query);//Get results 
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);//Fetch data
  mysqli_free_result($result);//Free Result;
  mysqli_close($conn);//Close connection 
?>

<main>
  <div class="under-navbar-padding">

  </div>

  <div class="list-title">
    <h3>Your Blog Posts</h3>
    <div>
          <a class="btn" href="<?php echo ROOT_URL;?>users/create_blog.php">Create new post</a>
    </div>
  </div>

  <div id="blog-posts-user" class="list-items">
  <?php foreach($posts as $post): ?>
    <div class="list-item">
      <div>
        <h3>
          <?php echo $post['title']; ?>
        </h3>
        <small>
            Created on <?php echo $post['created_at']?> by <?php echo $post['author']; ?> 
        </small>
        <p>
          <?php echo $post['body']?>
        </p>
      </div>
      <div class="list-item-options">
        <div>
          <a class="btn" href="<?php echo ROOT_URL; ?>users/edit_blog.php?id=<?php echo $post['id'];?>">Edit</a>
        </div>
        <div>
          <a class="btn" href="<?php echo ROOT_URL; ?>users/delete_blog.php?id=<?php echo $post['id'];?>" >Delete</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>


