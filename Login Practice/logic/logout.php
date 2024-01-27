<?php require_once '../config/init.php' ?>
<?php require_once '../config/functions.php' ?>

<?php

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )
    {
        echo "INCORRECT METHOD";
        exit;
    }

    if ( ! logoutUser() )
    {
        echo "LOGOUT WAS NOT SUCCESSFULLY DONE";
        exit;
    }

    redirect('../index.php');