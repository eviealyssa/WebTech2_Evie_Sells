<?php
    session_start();
    if (!isset($_SESSION["shoppingCart"])) {
        $_SESSION["shoppingCart"] = [];
    }

    // https://phppot.com/php/simple-php-shopping-cart/

    // https://stackoverflow.com/questions/62906258/shopping-cart-using-php-session

    // https://www.geeksforgeeks.org/what-is-the-use-of-symbol-in-php/

    // Check if the addToCart is set
    if (isset($_POST['addToCart'])) {
        $cartAction = $_POST['addToCart'];
        $product_id = $_POST['product_id'];
        $product_title = $_POST['product_title'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        if (isset($_POST['product_quantity'])) // if quantity is already set
        {
            $product_quantity = $_POST['product_quantity']; // assign value
        }
        else
        {
            $product_quantity = 1; // if quantity is not set, assign it to 1
        }

        if ( $cartAction == "add")
        {
            // add item to cart
            if (isset($_SESSION["shoppingCart"][$product_id])) // if cart already exists, and item is already in it, add item by assigning key value pairs
            {
                $_SESSION["shoppingCart"][$product_id]["product_quantity"] += $product_quantity; // increase quanitity
            }
            else
            {
                $_SESSION["shoppingCart"][$product_id] =  // if item is not already in cart, add as a key-value array
                [
                    "product_id" =>$product_id,
                    "product_title" =>$product_title,
                    "product_price" =>$product_price,
                    "product_image" =>$product_image,
                    "product_quantity" =>$product_quantity,
                ];
            }
        }
    }

    // redirect back to previous page (item)
    //header("Location: item.php"); 
    //exit();
?>