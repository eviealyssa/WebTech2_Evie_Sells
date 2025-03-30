<!-- 
Evie Sells
Reg No. 21255921
Email: EASells@uclan.ac.uk 
-->

<?php
    session_start();
    require_once 'conn.php';

    // get selected filter
    // https://www.w3schools.com/php/php_if_shorthand.asp
    $productType = isset($_GET["productType"]) ? $_GET["productType"] : ""; // using short hand if else

    // Prepare Query
    $sql = "SELECT * FROM tbl_products";
    if (!empty($productType)) // if type has been selected
    {
        $sql .= " WHERE product_type = ?"; // add where clause, if productType is not empty
        $stmt = $connection->prepare($sql); // prepare query
        $stmt->bind_param("s", $productType); // bind param
    } else {
        $stmt = $connection->prepare($sql); // if no type (all)
    }
    $stmt->execute(); // execute query
    $result = $stmt->get_result(); // get the result



    // adds selected item to cart
    function addToCart()
    {
        if (!isset($_SESSION["shoppingCart"])) { // if not set, create variable
            $_SESSION["shoppingCart"] = [];
        }
    
        // https://phppot.com/php/simple-php-shopping-cart/
    
        // https://stackoverflow.com/questions/62906258/shopping-cart-using-php-session
    
        // https://www.geeksforgeeks.org/what-is-the-use-of-symbol-in-php/
    
        // Check if the addToCart is set
        if (isset($_POST['addToCart'])) {
            // get variables from product form
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
        echo "<script>alert('Item has been added to the cart');</script>"; // success message
    }
    
?>

<!-- ACCESSIBILITY - declare the language -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- link to stylesheets -->
     <link rel="stylesheet" href="styling\headFootStyle.css" type= "text/css">
     <link rel="stylesheet" href="styling\productsStyle.css" type= "text/css">

</head>

<body> 
    <!-- showProducts -->
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
                    <li><a href="products.php" target="_self" class="navLinks activePage">Products</a></li>
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
                    <li><a href="products.php" target="_self" class="navLinks activePage">Products</a></li>
                    <li><a href="cart.php" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks">Login</a></li> 
                </ul>
            </div> 
        </nav>
        <!-- header - title -->
        <div class="breakPoint"></div>
        <h1>Products</h1>
        <div class="breakPoint"></div>
    </header>

    <main> <!-- Clearly defines which is the main part of the web page  -->
        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>

        <!-- Product Filters -->
        <!-- use a form to get filter data -->
        <div id="productFiltersBox">
            <h3>Filter by Type: </h3>
            <ul class="productFiltersList">
                <!-- ? is a ternary operator, essentially a short-hand if statement -->
                <li onclick="filterProducts('')" class="filterList <?= empty($productType) ? 'activeFilter' : '' ?>">All</li>
                <li onclick="filterProducts('UCLan Logo Tshirt')" class="filterList <?= $productType == 'UCLan Logo Tshirt' ? 'activeFilter' : '' ?>">Tshirt</li>
                <li onclick="filterProducts('UCLan Hoodie')" class=" filterList <?= $productType == 'UCLan Hoodie' ? 'activeFilter' : '' ?>">Hoodies</li>
                <li onclick="filterProducts('UCLan Logo Jumper')" class=" filterList <?= $productType == 'UCLan Logo Jumper' ? 'activeFilter' : '' ?>">Jumpers</li>
            </ul>
        </div>


        <div class="breakPoint"></div>

        <!-- scroll to top button -->
        <button id="scrollToTopBtn" onclick="scrollToTop()">To Top</button>

        <div id="productContainer">
            <?php while ($row = $result->fetch_assoc()) 
            {
                // adds the products to the page by querying the database base based on product type.
                // an id is assigned to each div, equivalent to the item id from the database.
                // a form is used to add the item to the cart whenbutton is pressed.
                echo '
                    <div class="productCard"'. $row["product_id"] . '">
                        <img class ="productImage" src="' . $row["product_image"] . '" alt="' . $row["product_title"] . '" style="width: 100%"> 
                        <h2 class="productName">' . $row["product_title"] . '</h2>
                        <h3 class="productPrice">£' . $row["product_price"] . '</h3>
                        <p class="productDescription">'. $row["product_desc"] . '</p>
                        <a class="readMoreLink" onclick="toItemPage(' . $row["product_id"] . ')">' . "Read more..." . '</a>


                        <form method="POST" action="">
                            <input type="hidden" name="addToCart" value="add">
                            <input type="hidden" name="product_image" value="' . $row["product_image"] . '">
                            <input type="hidden" name="product_id" value="' . $row["product_id"] . '">
                            <input type="hidden" name="product_title" value="' . $row["product_title"] . '">
                            <input type="hidden" name="product_price" value="' . $row["product_price"] . '">
                            <button class="addToBagBtn" type="itemAddedToCart">Add to Cart</button>
                        </form>
                    </div>
                ';
            }
            
            // If add to cart button clicked,
            if (isset($_POST["addToCart"]))
            {
                addToCart(); // go to addtoCart function
            }
            
            ?>
        </div>
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
                Reg.No: 21255921</p>
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


<!-- script - JS -->
    <script>
        
        // filters products, encode type to url
        function filterProducts(type) {
            window.location.href = "?productType=" + encodeURIComponent(type);
        }

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

        // sets scroll height to 0,0
        function scrollToTop()
        {
            sessionStorage.setItem("scrollHeightPP", 0);
            window.scrollTo(0,0);
        }

        // go to item page, adding item id to the url
        function toItemPage(itemId)
        {
            window.location.href = "item.php?itemId=" + encodeURIComponent(itemId);
        }

        <?php

        ?>
    </script>

</body>
</html>