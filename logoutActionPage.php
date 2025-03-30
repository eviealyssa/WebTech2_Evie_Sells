

<?php

    session_start();

    // unsets values
    $_SESSION["logged"] = false;
    unset($_SESSION["name"]);
    unset($_SESSION["userID"]);
    unset($_SESSION["errorLogin"]);
    echo "<script>alert('User has been logged out.')</script>";

    header ('Location: index.php'); // go to index page


?>
