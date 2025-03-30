<!doctype html>
<html>
<head>
    <!-- setting up project -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evie Sells - UCLan Shop</title>
</head>

<body>
    <?php 

        session_start();
        require_once "conn.php";

        // get values, and ensure no special characters - prevents against sql injections
        $myUsername = htmlspecialchars($_POST["username"]);
        $myPassword = htmlspecialchars($_POST["password"]);
    
        $userSql = "SELECT * from tbl_users WHERE user_email = ?"; // create statement
        $userStmt = $connection->prepare($userSql); // prepare

        if ($userStmt) 
        {
            $userStmt->bind_param("s", $myUsername); // bind
            $userStmt->execute(); // execute
            $userDetails = $userStmt->get_result(); // get result
            
            while ($user= $userDetails->fetch_assoc()) // fetch reviews
            {

                $dbPassword = $user["user_pass"];
                if  (password_verify($_POST["password"], $dbPassword)) //($mypassword == $dbpassword) //
                {
                    // set variables
                    $_SESSION["logged"] = true;
                    $_SESSION["name"] = $user["user_full_name"];
                    $_SESSION["userID"] = $user["user_id"];
                    $_SESSION["errorLogin"] = null;
                    header ('Location: index.php');
                }
                else
                {
                    $_SESSION["errorLogin"] = "IncorrectPass";
                    header ('Location: login.php'); //fail state: password does not match,
                }//end if
            }
        } 
        else {
            echo "Failed to prepare statement: " . $connection->error; // error
            header ('Location: login.php'); //fail state: username does not exist, back to login page
        }

    ?>

    

</body>
</html>