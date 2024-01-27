<?php include 'config/database.php';?>
<?php include 'config/functions.php';?>

<?php 
    $firstName = $lastName = $email = $password = '';

    if (isset($_POST['submit'])) {
        // Initialize error variables
        $firstnameErr = $lastnameErr = $emailErr = $passwordErr = '';
    
        // Validate and sanitize FirstName
        if (empty($_POST['FirstName'])) {
            $firstnameErr = 'Enter your FirstName';
        } else {
            $firstName = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_SPECIAL_CHARS);
        }
    
        // Validate and sanitize LastName
        if (empty($_POST['LastName'])) {
            $lastnameErr = 'Enter your LastName';
        } else {
            $lastName = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_SPECIAL_CHARS);
        }

    
        // Validate and sanitize Email
        if (empty($_POST['Email'])) {
            $emailErr = 'Enter your Email';
        } else {
            $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_SPECIAL_CHARS);
        }
    
        // Validate and hash Password
        if (empty($_POST['Password'])) {
            $passwordErr = 'Enter your Password';
        } else {
            $password = $_POST['Password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    
        // Check for any errors before proceeding
        if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($passwordErr)) {
            // Perform further actions (e.g., store data in the database)
            $sql = "INSERT INTO user_account (FirstName, LastName, Email, Password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword' )";
  
            if(mysqli_query($conn, $sql)) {

                // Loggin In the newly created user
                if ( loginUser($firstName, $email) )
                {

                    header('Location: index.php');

                }
                else
                {
                    echo 'Error';
                }

            } else {
                echo 'Error' . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="container">
        <h1 class="mb-5">Sign Up</h1>
        <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <div class="sign-up">
            <div class="sign-up-text">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">FirstName</label>
                    <input type="text" class="form-control <?php echo $firstnameErr ? 'is-invalid' : null; ?>" id="exampleFormControlInput1" name="FirstName" placeholder="FirstName">
                    <div class="invalid-feedback"> 
                        <?php echo $firstnameErr; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">LastName</label>
                    <input type="text" class="form-control <?php echo $lastnameErr ? 'is-invalid' : null; ?>" id="exampleFormControlInput1" name="LastName" placeholder="LastName">
                    <div class="invalid-feedback"> 
                        <?php echo $lastnameErr; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="exampleFormControlInput1" name="Email" placeholder="name@example.com">
                    <div class="invalid-feedback"> 
                        <?php echo $emailErr; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null; ?>" name="Password" id="exampleFormControlInput1">
                    <div class="invalid-feedback"> 
                        <?php echo $passwordErr; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark mb-5" name="submit">Submit</button>
                <p>Already have an account? <span><a href="login.php">Login</a></span></p>
            </div>
            <div>
                <img src="https://placehold.co/400" alt="main-image">
            </div>
        </div>
        </form>
    </main>
</body>
</html>

<?php  $firstName = $lastName = $email = $password = '';
 ?>