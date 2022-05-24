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
            FROM  sell_items
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
    <h3>Your selling books</h3>
    <div>
          <a class="btn" href="<?php echo ROOT_URL;?>users/create_sell.php">Create new post</a>
    </div>
  </div>

  <div class="list-items">
    <?php foreach($posts as $post): ?>
    <div class="list-item">
      <div>
        <h3>
          <?php echo $post['title']; ?>
        </h3>
        <p>
          Author: <?php echo $post['author'];?> <br>
          Genre: <?php echo $post['genre']?> <br>       
          Posted at: <?php echo $post['created_at']?> <br>
          Price: &dollar;<?php echo $post['price']?> <br>
          Contact: <?php echo $post['contact']?> <br>
          Location: <?php echo $post['location']?> <br>
          Completed: <?php echo $post['completed']; ?> <br>
        </p>
      </div>
      <div class="list-item-options">
        <div>
          <a class="btn" href="<?php echo ROOT_URL; ?>users/edit_sell.php?id=<?php echo $post['id'];?>">Edit</a>
        </div>
        <div>
          <a class="btn" href="<?php echo ROOT_URL; ?>users/delete_sell.php?id=<?php echo $post['id'];?>" >Delete</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>
