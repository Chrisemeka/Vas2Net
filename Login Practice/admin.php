<?php require_once 'config/init.php' ?>
<?php include 'config/database.php';?>
<?php include 'config/functions.php';?>



<?php 
  if ( ! checkIfUserIsLoggedIn() )
  {
    header('location: login.php');
  }

   if(checkIfUserIsLoggedIn()){
    $sql = "SELECT FirstName, LastName FROM user_account WHERE Role = 'admin'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $firstName = $user['FirstName'];
    $lastName = $user['LastName'];
  }
?>

<?php 
  $sql = "SELECT FirstName, LastName, Email, Role FROM user_account WHERE Role = 'user'";
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $count = count($users);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="styles.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="adminNav mb-3">
            <h1>Welcome <?php echo $firstName . ' ' . $lastName ?></h1>
            <form action="logic/logout.php" method="post">
              <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
        <div class="card adminHeader">
            <div class="card-body">
              <h2>Dashboard OverView</h2>
              <p>Shows all registerd users</p>
            </div>
        </div>

        <?php if( $count === 0 ) : ?>
          <center><h1>NO USER</h1></center>
        <?php else: ?>

          <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">Id  </th>
                <th scope="col">FirstName</th>
                <th scope="col">LastName</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $key => $person) :?>
              <tr>
                <th scope="row"><?php echo $key + 1 ?></th>
                <td><?php echo $person['FirstName']; ?></td>
                <td><?php echo $person['LastName']; ?></td>
                <td><?php echo $person['Email']; ?></td>
                <td><?php echo $person['Role']; ?></td>
                <td>
                  <form action="logic/deleteUser.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo $person['Email']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        <?php endif; ?>
        
    </div>
</body>
</html>