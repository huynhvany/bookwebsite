<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<?php
$query = "SELECT * 
          FROM sell_items
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
    <h2>Buy used books at the best price</h2>
  </div>
  <div class="list-items">
    <?php foreach($posts as $post): ?>
      <div class="list-item">
        <h3>
          <?php echo $post['title']; ?>
        </h3>
        <p>
          Author: <?php echo $post['author']; ?> <br>
          Genre: <?php echo $post['genre']; ?> <br>       
          Posted at: <?php echo $post['created_at']; ?> <br>
          Price: &dollar;<?php echo $post['price']; ?> <br>
          Contact: <?php echo $post['contact']; ?> <br>
          Location: <?php echo $post['location']; ?> <br>
          Completed: <?php echo $post['completed']; ?> <br>
        </p>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>
