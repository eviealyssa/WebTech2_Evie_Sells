<!doctype html>
<html>
<head>
    <!-- link to the stylesheets -->
    <!-- <link rel="stylesheet" href="styling/style.css" type= "text/css"> -->
<!-- <link rel="stylesheet" href="styling/headFootStyle.css" type= "text/css">     -->

    <!-- setting up project -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evie Sells - UCLan Shop</title>
</head>

<body>
    <?php 

        session_start();
        require_once 'conn.php';
    
        $myUsername = htmlspecialchars($_POST["username"]);
        $myPassword = htmlspecialchars($_POST["password"]);
    
        $query ="SELECT * from tbl_users WHERE user_email = '$myUsername'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
    
        if ($count == null) 
        {
            $_SESSION["errorLogin"] = "UserNotFound";
            header ('Location: login.php'); //fail state: username does not exist, back to login page
        }
        else
        {
            $record = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $dbPassword = $record["user_pass"];
            if  (password_verify($_POST["password"], $dbPassword)) //($mypassword == $dbpassword) //
            {
                $_SESSION["logged"] = true;
                $_SESSION["name"] = $record["user_full_name"];
                $_SESSION["errorLogin"] = null;
                header ('Location: index.php');
            }
            else
            {
                $_SESSION["errorLogin"] = "IncorrectPass";
                header ('Location: login.php'); //fail state: password does not match,
            }//end if
        }//end if       
    ?>

    

</body>
</html>