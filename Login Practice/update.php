<?php require_once 'config/init.php' ?>
<?php include 'config/database.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-sm">
        <h2 class="mt-4">Change Your Email</h2>
        <form action="logic/updateEmail.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">New Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <input type="hidden" name="old_email" value="<?php echo $_SESSION['email']; ?>">
            <button type="submit" name="submit" class="btn btn-dark mb-5">Submit</button>
        </form>

        <hr>

        <h2>Change Your Password</h2>
        <form action="logic/updatePass.php" method="POST">
            <div class="mb-3">
                <label for="old_pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="old_pass" name="password">
            </div>
            <div class="mb-3">
                <label for="new_pass" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_pass" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_pass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_pass" name="confirm_password">
            </div>
            <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
            <button type="submit" name="submit" class="btn btn-dark mb-5">Submit</button>
        </form>
    </div>
</body>
</html>