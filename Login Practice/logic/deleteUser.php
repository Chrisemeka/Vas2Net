<?php require_once '../config/init.php' ?>
<?php include '../config/database.php';?>

<?php 
  if( isset($_POST['email']) ) {
    $email = $_POST['email'];

    $sql = "DELETE FROM user_account WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
  }

  header("Location: ../admin.php?message=deleted");
?>