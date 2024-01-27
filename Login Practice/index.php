<?php require_once 'config/init.php' ?>
<?php require_once 'config/functions.php' ?>
<?php include 'config/database.php';?>


<?php 
  if ( ! checkIfUserIsLoggedIn() )
  {
    header('location: login.php');
  }
  if(checkIfUserIsLoggedIn()){
    $sql = "SELECT FirstName, LastName FROM user_account WHERE FirstName = '{$_SESSION['firstName']}'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $firstName = $user['FirstName'];
    $lastName = $user['LastName'];
    // var_dump($user);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg  custNav">
            <div class="logo">
                <img src="https://placehold.co/50" alt="image">
                <a href="#" class="navbar-brand">Emeka</a>
            </div>
            <div>
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                  </li>
                  <?php if(! checkIfUserIsLoggedIn()): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="sign_up.php">Sign Up</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                  </li>
                  <?php else: ?>
                  <li class="nav-item">
                    <p class="nav-link""><?php echo $firstName . ' ' . $lastName ?></p>
                    <form action="logic/logout.php" method="post">
                      <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <a href="update.php" class="btn btn-success">Edit Profile</a>
                    <!-- <a class="nav-link" href="logout.php">Logout</a> -->
                  </li>
                  <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

     <main id="index_main">
        <h1>Welcome User</h1>
        <p>You are Logged In</p>
     </main>
</body>
</html>

