<?php 
        session_start();
        require_once 'conn.php';

        $orderDate = date('Y-m-d'); // gets the timestamp in the format = (yyyy-mm-dd) - https://www.w3schools.com/php/func_date_date_format.asp


        // get user id
        $userId = $_SESSION["userID"];

        // get product id's
        if (!empty($_SESSION["shoppingCart"]))
        {
            $productIds = "";

            foreach ($_SESSION["shoppingCart"] as $product_id=>$item) // loop through cart and display each item
            {
                // repeat product id for each product in cart
                $productsToAdd = str_repeat($item["product_id"], $item["product_quantity"]);
                $productIds = $productIds . ", ".$productsToAdd;
            }
        }

        // https://www.w3schools.com/sql/sql_insert.asp

        $insertStmt = $connection->prepare("INSERT INTO tbl_orders (order_date, user_id, product_ids)
         VALUES (?, ?, ?)"); // prepare

        $insertStmt->bind_param("sss", $orderDate, $userId, $productIds); // bind params

        // execuet the statement
        if($insertStmt->execute())
        {
            echo "<script>alert('Order has been sucessfully created')</script>"; // success message
            unset($_SESSION["shoppingCart"]); // unset cart

            header ('Location: index.php'); // to index page
        }
        else
        {
            echo "<script>alert(Error has occurred, please try again.)</script>"; // error message
            //header ('Location: cart.php');
        }

        // close
        $insertStmt->close();
        $connection->close();
    ?>