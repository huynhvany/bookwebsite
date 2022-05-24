<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<?php
$query = "SELECT * 
          FROM blog_posts 
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
    <h2>Blog</h2>
  </div >
  <div id="blog-posts-home" class="list-items">
    <?php foreach($posts as $post): ?>
      <div class="list-item">
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
    <?php endforeach; ?>
  </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>

