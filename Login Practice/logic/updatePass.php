<?php require_once '../config/init.php' ?>
<?php require_once '../config/functions.php' ?>
<?php include '../config/database.php';?>



<?php 
    if( ! checkIfUserIsLoggedIn()){
        redirect('../sign_up.php');
        exit;
    }

    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $sql = "SELECT Email FROM user_account WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    $dbEmail = mysqli_fetch_assoc($result);

    if ($dbEmail === null || count($dbEmail) == 0) {
        redirect('../sign_up.php?message=user_does_not_exists');
        exit;
    }

    $sql = "SELECT Password FROM user_account WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    $dbPass = mysqli_fetch_assoc($result)['Password'];

    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if(! password_verify($dbPass, $password)){
        redirect('../sign_up.php?message=user_does_not_exists!');
    }

    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

    if($new_password !== $confirm_password){
        redirect("../update.php?message=new_and_confirm_password_don't_match");
        exit;
    }

    $password = password_hash($new_password, PASSWORD_BCRYPT);

    $sql = "UPDATE user_account SET Password = '$password' WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        redirect("../index.php?message=password_updated_successfully");
    }
?>