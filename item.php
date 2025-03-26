<!-- 
Evie Sells
Reg No. 21255921
Email: EASells@uclan.ac.uk 
-->

<?php
    session_start();
    require_once 'conn.php';

    // get selected id
   // $productID = isset($_GET["itemId"]) ? $_GET["itemId"] : "";

    if (isset($_GET['itemId'])) {
        $itemId = $_GET['itemId']; // Get the div ID
        //echo "You are viewing: " . htmlspecialchars($itemId); // Echo the div ID

        // Prepare SQL statement with a placeholder `?`
        $itemSql = "SELECT * FROM tbl_products WHERE product_id = ?";
        // Prepare the statement
        $itemStmt = $connection->prepare($itemSql);

        if ($itemStmt) {
            // Bind the parameter ( "s" means string type)
            $itemStmt->bind_param("s", $itemId);
            
            // Execute the statement
            $itemStmt->execute();
            
            // Get the result
            $itemDetails = $itemStmt->get_result();

            
        } else {
            echo "Failed to prepare statement: " . $connection->error;
        }
    } else {
        echo "Error has occurred";
    }

?>

<!-- ACCESSIBILITY - declare the language -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- link to stylesheets -->
    <link rel="stylesheet" href="styling\headFootStyle.css" type= "text/css">
    <link rel="stylesheet" href="styling\itemStyle.css" type= "text/css">

</head>

<body> 
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
            <a href="cart.html" class="splitNav cartNavIcon"><img src="images\other\shopping-cart-image.svg" alt="Cart" height="50"></a>

            <!-- login menu icon for desktop / tablet -->
            <a href="login.php" class="splitNav loginNavIcon"><img src="images\other\login sybol nav.png" alt="Login" height="50"></a>

            <!-- adding in hamburg menu icon for mobile users -->
            <a class="mobileMenuIcon splitNav" onclick="toggleHamburgerNav()"><img src="images\other\hamburger-menu-icon.svg" alt="Menu" height="50"></a>

            <!-- mobile navigation links -->
            <div id="mobileNavSection">
                <ul class="mobileNavLinksList">
                    <li><a href="index.php" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.php" target="_self" class="navLinks">Products</a></li>
                    <li><a href="cart.html" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks">Login</a></li> 
                </ul>
            </div> 
        </nav>
    </header>

    <main> <!-- Clearly defines which is the main part of the web page  -->

        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>

        <?php

            if (isset($_GET['itemId'])) {
                $itemId = $_GET['itemId']; // Get the div ID
                echo "You are viewing: " . htmlspecialchars($itemId); // Echo the div ID
            } else {
                echo "No ID was sent!";
            }
        ?>

        <div id="itemContainer">
            <?php while ($item = $itemDetails->fetch_assoc()) 
            {
                // adds the products to the page by querying the database base based on product type.
                // an id is assigned to each div, equivalent to the item id from the database.
                echo '<h1 id="itemTitle">' . $item["product_title"] . '</h1>';
                echo '
                    <div id="itemCard"'. $item["product_id"] . '">
                        <div id="itemImage">
                            <img src="' . $item["product_image"] . '" alt="' . $item["product_title"] . '" style="width: 45%">
                        </div> 
                        <h2 id="productName">' . $item["product_title"] . '</h2>
                        <h3 id="productPrice">£' . $item["product_price"] . '</h3>
                        <p id="productDescription">'. $item["product_desc"] . '</p>
                        <button class="addToBagBtn" onclick="addToCart(this)">Add to Cart</button>
                    </div>
                ';
                // Close the statement
                $itemStmt->close();
            }?>
        </div>


        <div id="reviewContainer">
            

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

        // adds selected item to the cart
        function addToCart(button)
        {
            var divId = button.parentElement.id; // gets the id of the div
            console.log("id = ", divId);
        }

        function backToPage()
        {
            //window.location.href = "item.php?itemId=" + itemId;
            // go to product page
            window.open("products.php", "_self");
        }

        <?php

        ?>
    </script>

</body>


</html>