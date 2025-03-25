<!-- 
Evie Sells
Reg No. 21255921
Email: EASells@uclan.ac.uk 
-->

<?php
    session_start();
    require_once 'conn.php';

    // get selected filter
    $productType = isset($_GET["productType"]) ? $_GET["productType"] : "";

    // Prepare Query
    $sql = "SELECT * FROM tbl_products";
    if (!empty($productType)) 
    {
        $sql .= " WHERE product_type = ?"; // add where clause, if productType is not empty
        $stmt = $connection->prepare($sql); // prepare query
        $stmt->bind_param("s", $productType); // bind param
    } else {
        $stmt = $connection->prepare($sql);
    }
    $stmt->execute(); // execute query
    $result = $stmt->get_result(); // get the result
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
            <a href="cart.html" class="splitNav cartNavIcon"><img src="images\other\shopping-cart-image.svg" alt="Cart" height="50"></a>

            <!-- login menu icon for desktop / tablet -->
            <a href="login.php" class="splitNav loginNavIcon"><img src="images\other\login sybol nav.png" alt="Login" height="50"></a>

            <!-- adding in hamburg menu icon for mobile users -->
            <a class="mobileMenuIcon splitNav" onclick="toggleHamburgerNav()"><img src="images\other\hamburger-menu-icon.svg" alt="Menu" height="50"></a>

            <!-- mobile navigation links -->
            <div id="mobileNavSection">
                <ul class="mobileNavLinksList">
                    <li><a href="index.php" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.php" target="_self" class="navLinks activePage">Products</a></li>
                    <li><a href="cart.html" target="_self" class="navLinks">Cart</a></li> 
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
                <li onclick="filterProducts('UCLan Hoodie')" class=" filterList <?= $productType == 'UCLan Hoodie' ? 'activeFilter' : '' ?>">Hoodys</li>
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
                echo '
                    <div class="productCard" id="'. $row["product_id"] . '">
                        <img src="' . $row["product_image"] . '" alt="' . $row["product_title"] . '" style="width: 100%"> 
                        <h2 class="productName">' . $row["product_title"] . '</h2>
                        <h3 class="productPrice">£' . $row["product_price"] . '</h3>
                        <p class="productDescription">'. $row["product_desc"] . '</p>
                        <a class="readMoreLink" onclick="toItemPage(' . $row["product_id"] . ')">' . "Read more..." . '</a>
                        <button class="addToBagBtn" onclick="addToCart(this)">Add to Cart</button>
                    </div>
                ';
            }?>
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
        
        // filters products
        function filterProducts(type) {
            console.log("filter products called, type = ", type);
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

        // adds selected item to the cart
        function addToCart(button)
        {
            var divId = button.parentElement.id; // gets the id of the div
            console.log("id = ", divId);
        }

        function toItemPage(itemId)
        {
            console.log("id = ", itemId);
            window.location.href = "item.php?itemId=" + itemId;
        }

        <?php

        ?>
    </script>

</body>


</html>