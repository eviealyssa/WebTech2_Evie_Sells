<?php 
        session_start();
        require_once 'conn.php';

        // prevents against security issues
        $timestamp = date('Y-m-d H:i:s'); // gets the timestamp in the format = (yyyy-mm-dd) - https://www.w3schools.com/php/func_date_date_format.asp
        $userId = $_SESSION["userID"];
        $productId = ($_POST["productId"]);
        $reviewTitle = htmlspecialchars($_POST["reviewTitle"]);
        $reviewDesc = htmlspecialchars($_POST["reviewDesc"]);
        $reviewRating = ($_POST["reviewRating"]);

        // https://www.w3schools.com/sql/sql_insert.asp
        $insertStmt = $connection->prepare("INSERT INTO tbl_reviews (user_id, product_id, review_title, review_desc, review_rating, review_timestamp) VALUES (?, ?, ?, ?, ?, ?)");

        $insertStmt->bind_param("iissss", $userId, $productId, $reviewTitle, $reviewDesc, $reviewRating, $timestamp); // bind params

        // execuet the statement
        if($insertStmt->execute())
        {
            echo "<script>alert(Review has been created successfully.)</script>"; // success message
            header ('Location: products.php');
        }
        else
        {
            echo "<script>alert(Error has occurred, please try again.)</script>"; // error message
            header ('Location: products.php');
        }

        // close
        $insertStmt->close();
        $connection->close();
    ?>
