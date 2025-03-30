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

        // prevents against security issues
        $timestamp = date('Y-m-d H:i:s'); // gets the timestamp in the format = (yyyy-mm-dd hh:mm:ss) - https://www.w3schools.com/php/func_date_date_format.asp
        $name = htmlspecialchars($_POST["fullName"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["confirmPassword"]);
        $address = htmlspecialchars($_POST["address"]);


        // https://stackoverflow.com/questions/30279321/how-to-use-phps-password-hash-to-hash-and-verify-passwords
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // turns password to hashed version

        // https://www.w3schools.com/sql/sql_insert.asp

        $insertStmt = $connection->prepare("INSERT INTO tbl_users (user_full_name, user_address, user_email, user_pass, user_timestamp)
         VALUES (?, ?, ?, ?, ?)");

        $insertStmt->bind_param("sssss", $name, $address, $email, $hashedPassword, $timestamp); // bind params

        // execuet the statement
        if($insertStmt->execute())
        {
            echo "<script>alert(Account has been created successfully.)</script>"; // success message
            header ('Location: login.php');
        }
        else
        {
            echo "<script>alert(Error has occurred, please try again.)</script>"; // error message
            header ('Location: register.php');
        }

        // close
        $insertStmt->close();
        $connection->close();
    ?>

    

</body>
</html>