<!-- 
Evie Sells
Reg No. 21255921
Email: EASells@uclan.ac.uk 
-->

<?php
    session_start();
    require_once 'conn.php';

    // get item details from products table
    if (isset($_GET['itemId'])) {
        $itemId = $_GET['itemId']; // Get the div ID

        $itemSql = "SELECT * FROM tbl_products WHERE product_id = ?";
        $itemStmt = $connection->prepare($itemSql);

        if ($itemStmt) 
        {
            $itemStmt->bind_param("s", $itemId);
            $itemStmt->execute();
            $itemDetails = $itemStmt->get_result();
        } 
        else {
            echo "Failed to prepare statement: " . $connection->error;
        }

    } else {
        echo "Error has occurred";
    }


    // get review details from review table	
    if (isset($_GET['itemId'])) {
        $reviewId = $_GET['itemId']; // Get the div ID

        $reviewSql = "SELECT * FROM tbl_reviews WHERE product_id = ?";
        $reviewStmt = $connection->prepare($reviewSql);

        if ($reviewStmt) 
        {
            $reviewStmt->bind_param("s", $reviewId);
            $reviewStmt->execute();
            $reviewDetails = $reviewStmt->get_result();
        } 
        else {
            echo "Failed to prepare statement: " . $connection->error;
        }
    } else {
        echo "Error has occurred";
    }



    function addToCart()
    {
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
        echo "<script>alert('Item has been added to the cart');</script>";
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
                    <li><a href="cart.html" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks">Login</a></li> 
                </ul>
            </div> 
        </nav>
    </header>

    <main>

        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>

        <div id="itemContainer">
            <?php while ($item = $itemDetails->fetch_assoc()) 
            {
                // adds the product to the page by querying the database base based on product id.
                echo '<h1 id="itemTitle">' . $item["product_title"] . '</h1>';
                echo '
                    <div id="itemCard"'. $item["product_id"] . '">
                        <div id="itemImage">
                            <img src="' . $item["product_image"] . '" alt="' . $item["product_title"] . '" style="width: 45%">
                        </div> 
                        <h2 id="productName">' . $item["product_title"] . '</h2>
                        <h3 id="productPrice">£' . $item["product_price"] . '</h3>
                        <p id="productDescription">'. $item["product_desc"] . '</p>


                        <form method="POST" action="">
                            <input type="hidden" name="addToCart" value="add">
                            <input type="hidden" name="product_image" value="' . $item["product_image"] . '">
                            <input type="hidden" name="product_id" value="' . $item["product_id"] . '">
                            <input type="hidden" name="product_title" value="' . $item["product_title"] . '">
                            <input type="hidden" name="product_price" value="' . $item["product_price"] . '">
                            <button class="addToBagBtn" type="itemAddedToCart">Add to Cart</button>
                        </form>
                    </div>
                ';
                // Close the statement
                $itemStmt->close();

                // If add to cart button clicked,
                if (isset($_POST["addToCart"]))
                {
                    addToCart(); // go to addtoCart function
                }
            }?>
        </div>

        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>

        <div id="reviewContainer">
            <?php 
            $totalReviewScore = 0;
            $totalReviewCount = 0;
            while ($review= $reviewDetails->fetch_assoc()) 
                {
                    // get user name
                    $userReviewId = $review["user_id"]; // Get the review user id

                    $userSql = "SELECT user_full_name FROM tbl_users WHERE user_id = ?";
                    $userStmt = $connection->prepare($userSql);

                    if ($userStmt) 
                    {
                        $userStmt->bind_param("i", $userReviewId);
                        $userStmt->execute();
                        $userDetails = $userStmt->get_result();
                        $nameFull= $userDetails->fetch_assoc();
                        $name = $nameFull["user_full_name"];
                        // replaces all but the first two letters with *
                        $reviewUserName = substr_replace($name,(str_repeat("*", (strlen($name)-2))) ,2);
                    } 
                    else {
                        echo "Failed to prepare statement: " . $connection->error;
                    }
                    echo '
                        <div id="reviewCard"'. $review["review_id"] . '">
                            <h2 id="reviewName">' . $review["review_title"] . '</h2>
                            <h3 id="reviewRating">Rating: ' . str_repeat("⭐",$review["review_rating"]) . '</h3>
                            <p id="reviewDesc">'. $review["review_desc"] . '</p>
                            <p id="reviewUser"> Review By '. $reviewUserName . ' at ' . $review["review_timestamp"] .'</p>
                        </div>
                    ';
                    
                    $totalReviewCount += 1; // increment count
                    $totalReviewScore +=$review["review_rating"]; // increment rating
                }

                if ($totalReviewCount != 0)
                {
                    // calculate and display average rating
                    $averageRating = $totalReviewScore / $totalReviewCount;
                    echo "AVERAGE RATING = $averageRating";
                }
                
            ?>
        </div>

        <?php if (isset($_SESSION["name"])){ ?>
            <div id="writeReviewContainer">
                <h2>Create your own review! </h2>
                <form id="writeReviewForm" action="" method="post" onsubmit="">
                    <section id="reviewSection">
                        <p>Enter your details below:</p>
                        
                        <p><label>Review Title:</label>
                        <input type="text" name="reviewTitle" required></p>

                        <p><label>Review Description:</label>
                        <input type="text" name="reviewDesc" required></p>

                        <h3>Rating: </h3>
                        <p><label>1 Star:</label>
                        <input type="radio" name="reviewRating" required></p>
                        <p><label>2 Star:</label>
                        <input type="radio" name="reviewRating" required></p>
                        <p><label>3 Star:</label>
                        <input type="radio" name="reviewRating" required></p>
                        <p><label>4 Star:</label>
                        <input type="radio" name="reviewRating" required></p>
                        <p><label>5 Star:</label>
                        <input type="radio" name="reviewRating" required></p>
                    
                        <p><input type="submit" name="submitReview"></p>

                    </section>
                </form>
                
            </div>

        <?php }else{ ?>
            <h2>Log in to write a review of your own.</h2>
        <?php }?>


        


        
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
    </script>

</body>
</html>