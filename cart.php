<?php
    session_start();

    function increaseQuantity()
    {
        $productId = $_POST["increaseQuantity"];
        if (isset($_SESSION['shoppingCart'][$productId])) {
            $_SESSION['shoppingCart'][$productId]['product_quantity'] += 1;
        }
    }

    function decreaseQuantity()
    {
        $productId = $_POST["decreaseQuantity"];
        if (isset($_SESSION['shoppingCart'][$productId])) {
            if ( $_SESSION['shoppingCart'][$productId]['product_quantity'] == 1)
            {
                unset( $_SESSION['shoppingCart'][$productId]); // remove from cart
            }
            else
            {
                $_SESSION['shoppingCart'][$productId]['product_quantity'] -= 1;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- link to stylesheets -->
    <link rel="stylesheet" href="styling\headFootStyle.css" type= "text/css">
    <link rel="stylesheet" href="styling\cartStyle.css" type= "text/css">
</head>

<body onresize="changeFillerSize()"> 
    <header> 
         <!-- navigation bar -->
        <nav>
             <!-- adding in logo - alternative text = - ACCESSIBILITY -->
            <div class="logo">
                <img src="images\logo.svg" alt="UCLan logo" height="65" >
            </div>
            
            <!-- navigation links -->
            <!-- tablet and laptop navigation links - clear links = ACCESSIBILITY-->
            <div id="navSection">
                <ul class="navLinksList">
                    <li><a href="index.php" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.php" target="_self" class="navLinks">Products</a></li>
                </ul>
            </div>

            <!-- cart menu icon for desktop / tablet -->
            <a href="cart.php" class="splitNav cartNavIcon"><img src="images\other\shopping-cart-image.svg" alt="Cart" height="50"></a>

            <!-- login menu icon for desktop / tablet -->
            <a href="login.php" class="splitNav loginNavIcon"><img src="images\other\login sybol nav.png" alt="Login" height="50"></a>

            <!-- adding in hamburg menu icon for mobile users -->
            <a class="mobileMenuIcon splitNav" onclick="toggleHamburgerNav()"><img src="images\other\hamburger-menu-icon.svg" alt="Menu" height="50"></a>

            <!-- mobile navigation links -->
            <div id="mobileNavSection">
                <ul class="mobileNavLinksList">
                    <li><a href="index.php" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.php" target="_self" class="navLinks">Products</a></li>
                    <li><a href="cart.php" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks">Login</a></li> 
                </ul>
            </div> 
        </nav>
    </header>

    <main>

        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>


        <?php
            if (!empty($_SESSION["shoppingCart"]))
            {
                // if items in cart - display
                $totalPrice = 0;

                echo "<section id='itemCartContainer'>"; // open

                foreach ($_SESSION["shoppingCart"] as $product_id=>$item) // loop through cart and display each item
                {
                    $totalPrice += $item["product_price"] * $item['product_quantity'];

                    echo '<div class="itemCartCard">
                            <div class="itemImage">
                                <img src="' . $item["product_image"] . '" alt="' . $item["product_title"] . '" style="width: 75%">
                            </div> 
                            <div class="itemCartInfo">
                                <h2 class="productName">' . $item["product_title"] . '</h2>
                                <h3 class="productPrice">£' . $item["product_price"] . '</h3>
                            </div> 
                            <div class="itemCartQuanity">
                               <h2 class="itemCartQuantityText">Quantity</h2>
                               <h2 class="itemCartQuantityInfo">' . $item["product_quantity"] .'</h2>
        
                               <div class="quantityBtnsContainer">

                                    <form method="POST" action="">
                                        <input type="hidden" name="increaseQuantity" value='.$item["product_id"].'>
                                        <button class="quantityBtn" type="submit">+</button>
                                    </form>

                                    <form method="POST" action="">
                                        <input type="hidden" name="decreaseQuantity" value='.$item["product_id"].'>
                                        <button class="quantityBtn" type="submit">-</button>
                                    </form>
                               </div>
                           </div>
                        
                        </div>
                    ';
                }
                echo "</section>"; // close
                echo "
                    <h2> Total: $totalPrice 
                    <button id='totalPrice'>Checkout</button>
                    ";

                echo "<button id='clearCart' onclick='clearCart()'>  Clear cart </button>";                
            }
            else{
                echo "<h1 id='bagEmptyText'>Your cart is empty</h1>"; // if bag is empty - display message
            }

            // If add to increase quantity button clicked,
            if (isset($_POST["increaseQuantity"]))
            {
                increaseQuantity(); // go to function
                unset($_POST["increaseQuantity"]); // unset variable
                $_POST["increaseQuantity"] = array();
            }

            // If add to decrease quantity button clicked,
            if (isset($_POST["decreaseQuantity"]))
            {
                decreaseQuantity(); // go to function
                unset($_POST["decreaseQuantity"]); // unset variable
                $_POST["increaseQuantity"] = array();
            }

        ?>

        <!-- reactive to fill page so footer is always at the bottom of the page, under the content -->
        <div id="fillerBox"></div>



    </main>

    <!-- Footer - splits into a reactive grid -->
    <footer>
        <div class="contactInfo">
            <h2 class="footH2">Contact Info:</h2>
            <p class="footP">
                Name: Evie Sells
                <br>
                Email: <a id="emailAddress" href="mailto:EASells@uclan.ac.uk">EASells@uclan.ac.uk</a>
                <br>
                Reg.No: 21255921
            </p>
        </div>

        <div class="assignmentDetails">
            <h2 class="footH2">Details:</h2>
            <p class="footP">
                CO1707: Web Technologies
                <br>
                Assignment 1: Web Application
            </p>
        </div>

        <div class="FindSU">
            <h2 class="footH2">Find the SU:</h2>
            <p class="footP">University of Central Lancashire Students' Union,
                <br>
                Fylde Road, Preston. PR1 7BY
            </p>
        </div>

        <div class="socialimagesIcons">
            <h2 class="footH2">Stay in touch with the SU!</h2>

            <div class="iconsFooter">
                <a href="https://www.facebook.com/uclanstudentsunion/">
                    <img src="images\social_media_icons\facebook-social-media-icon.svg" alt="Facebook icon" height="40">
                </a>

                <a href="https://www.tiktok.com/@uclansu">
                    <img src="images\social_media_icons\tiktok-social-media-icon.svg" alt="TikTok icon" height="40">
                </a>

                <a href="https://www.instagram.com/uclansu/">
                    <img src="images\social_media_icons\instagram-social-media-icon.svg" alt="Instagram icon" height="40">
                </a>

                <a href="https://x.com/i/flow/login?redirect_after_login=%2FUCLanSU">
                    <img src="images\social_media_icons\x-social-media-black-icon.svg" alt="X icon" height="40">
                </a>
            </div>
        </div>
    </footer>

    <?php

        function clearCart()
        {
            // set cart to empty
            $_SESSION["shoppingCart"] = []; // cart has been cleared

            // reload page
            header("Location: cart.php"); 
        }
    ?>


    <!-- script - JS -->
    <script>

        // Open / Close hamburger navigation function
        function toggleHamburgerNav()
        {
            // get navSection and set as linksNav
            var navigationSection = document.getElementById("mobileNavSection");
            // If nav shown, hide
            if (navigationSection.style.display === "block") {
                navigationSection.style.display = "none";
            } 
            // If nav hidden, show
            else {
                navigationSection.style.display = "block";
            }
        }


        // determines and sets the size of the filler box
        function changeFillerSize()
        {
            var pageSize = window.innerHeight;
            
           
           

            if (!document.getElementById("itemCartContainer")) 
            {
                var containerSize = document.getElementById("bagEmptyText").offsetHeight  ?? 0;
            }
            else
            {
                var containerSize = document.getElementById("itemCartContainer").offsetHeight  ?? 0;
                var totalPrice = document.getElementById('totalPrice').offsetHeight  ?? 0;
                containerSize += totalPrice;
            }

            // get height of all breakpoints
            var breakHeight = 0;
            const breakPoints = document.getElementsByClassName("breakPoint");
            for (let i = 0; i < breakPoints.length; i++) {
                let temp = breakPoints[i].offsetHeight;
                breakHeight = breakHeight + temp;
            }

            var headerHeight = document.getElementsByTagName("header")[0].offsetHeight;

            var footerHeight = document.getElementsByTagName("footer")[0].offsetHeight;

            var toTake = footerHeight + headerHeight + breakHeight + containerSize;

            var fillerBoxSize = (pageSize - toTake);


            if (toTake > 0){
                document.getElementById("fillerBox").style.height = fillerBoxSize + "px";
            }

        }

        //ensures footer is always at the bottom of the page
        changeFillerSize();

    </script>

</body>
</html>
