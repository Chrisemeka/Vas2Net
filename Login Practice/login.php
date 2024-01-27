<?php require_once 'config/init.php' ?>
<?php include 'config/database.php';?>
<?php include 'config/functions.php';?>

<?php 
  if (  checkIfUserIsLoggedIn() )
  {
    header('location: index.php');
  }
?>
<?php 

    $email = $password = '';
    $emailErr = $passwordErr = '';

    if (isset($_POST['submit'])) {
        // Initialize error variables
        $emailErr = $passwordErr = '';
 
        // Validate and sanitize Email
        if (empty($_POST['email'])) {
            $emailErr = 'Enter your Email';
        } else {
            $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_SPECIAL_CHARS);
        }
    
        // Validate and hash Password
        if (empty($_POST['password'])) {
            $passwordErr = 'Enter your Password';
        } else {
            $password = $_POST['password'];
        }
    
        // Check for any errors before proceeding
        if (empty($emailErr) && empty($passwordErr)) {
            // Perform further actions (e.g., store data in the database)
            // $hashedPassword = password_verify($password, $pwdFromDB);

            $email = $_POST['email'];
  
            $sql = "SELECT Email FROM user_account WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);
            $dbEmail = mysqli_fetch_assoc($result);

            if ($dbEmail === null || count($dbEmail) == 0) {
                echo "user does not exists";
                exit;
            }

            // var_dump($dbEmail);
            $sql = "SELECT Password FROM user_account WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);
            $dbPassword = mysqli_fetch_assoc($result)['Password'];

            if( ! password_verify($password, $dbPassword) ) {
                echo "password not matched";
                exit;
            }

            $sql = "SELECT * FROM user_account WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);
            $userInfo = mysqli_fetch_assoc($result);

            loginUser($userInfo['FirstName'], $userInfo['Email']);

            if( $userInfo['Role'] == 'admin' ) {
                redirect('admin.php');
                exit;
            }

            redirect('index.php');
            exit;

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="container footer-main">
        <h1 class="mb-5">Login</h1>
        <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <div class="sign-up">
                <div class="sign-up-text">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleFormControlInput1">
                    </div>
                    <button type="submit" name="submit" class="btn btn-dark mb-5">Submit</button>
                    <p>Don't have an account? <span><a href="sign_up.php">Sign Up</a></span></p>
                </div>
                <div>
                    <img src="https://placehold.co/400" alt="main-image">
                </div>
            </div>
        </form>
    </main>
</body>
</html>