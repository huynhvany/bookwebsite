<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>


<?php
$query = "SELECT * 
          FROM donate_items
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
    <h2>Give and get free books</h2>
  </div>
  <div class="list-items">
    <?php foreach($posts as $post): ?>
      <div class="list-item">
        <h3>
          <?php echo $post['title']; ?>
        </h3>
        <p>
          Author: <?php echo $post['author'];?> <br>
          Genre: <?php echo $post['genre']?> <br> 
          Posted at: <?php echo $post['created_at']?> <br>
          Contact: <?php echo $post['contact']?> <br>   
          Location: <?php echo $post['location']?>
        </p>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>