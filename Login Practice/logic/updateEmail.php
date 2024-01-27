<?php require_once '../config/init.php' ?>
<?php require_once '../config/functions.php' ?>
<?php include '../config/database.php';?>

<?php 
    if( ! checkIfUserIsLoggedIn()){
        redirect('../sign_up.php');
        exit;
    }

    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $old_email = isset($_POST['old_email']) && ! empty($_POST['old_email']) ? $_POST['old_email'] : null;

    if ( is_null($old_email) || is_null($email) )
    {
        redirect('../update.php?message=email_required');
        exit;
    }

    $sql = "SELECT Email FROM user_account WHERE Email = '$old_email'";
    $result = mysqli_query($conn, $sql);
    $dbEmail = mysqli_fetch_assoc($result);

    if ($dbEmail === null || count($dbEmail) == 0) {
        redirect('../sign_up.php?message=user_does_not_exists');
        exit;
    }

    $sql = "UPDATE user_account SET Email = '$email' WHERE Email = '$old_email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if ( logoutUser() )
        {
            redirect('../login.php?message=update_email_success');
        }
        exit;
    }

?>