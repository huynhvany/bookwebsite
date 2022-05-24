<!-- Header and Navbar -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/navbar.php'; ?>

<?php 
// Destroy the session 
session_destroy();
// Need some effect for log out successful

// // Redirect to home page 
echo("<script>location.href = '".ROOT_URL."index.php';</script>");
?>


<?php include $_SERVER['DOCUMENT_ROOT'].'/bookwebsite/inc/footer.php'; ?>


