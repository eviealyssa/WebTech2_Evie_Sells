<!-- 
Evie Sells
Reg No. 21255921
Email: EASells@uclan.ac.uk 
-->

<!-- ACCESSIBILITY - declare the language -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- link to stylesheets -->
     <link rel="stylesheet" href="styling\headFootStyle.css" type= "text/css">
     <link rel="stylesheet" href="styling\indexStyle.css" type= "text/css">

</head>

<body>
    <?php
    // opens php session
        session_start();
        require_once 'conn.php';
    ?>

<header> 
        <!-- Semantic Elements - ACCESSIBILITY
         Semantic elements clearly states what the content is, they are used to clearly define the parts of the web page.
         For example header and nav. These tell both the browser and developer exactly what that section is for.        
        -->

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
                    <li><a href="index.php" target="_self" class="navLinks activePage">Home</a></li>
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
                    <li><a href="index.php" target="_self" class="navLinks activePage">Home</a></li>
                    <li><a href="products.php" target="_self" class="navLinks">Products</a></li>
                    <li><a href="cart.php" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks">Login</a></li> 
                </ul>
            </div> 

        </nav>
        <!-- header - title -->
        <div class="breakPoint"></div>
        <h1>Welcome to UCLan's Student Union Shop</h1>
        <div class="breakPoint"></div>

        <?php
        if (isset($_SESSION["name"])) 
        {
            echo "<h1> Welcome Back " . $_SESSION["name"] . "<h1>";
        }
        ?>
    </header>

    <main> <!-- Clearly defines which is the main part of the web page  -->
        <div class="breakPoint"></div> <!-- adds a space to the page to break things up   -->
        <div class="breakPoint"></div>

        <article> <!-- This section provides an introduction to the website -->
            <h2 class="h2Title">Shop Now!</h2>
            <p id="homeText">
                Browse UCLan's official branded merchandise.
                <br>
                Elevate your looks with branded apparel, crafted for comfort and style.
            </p>
        </article>
        <div class="breakPoint"></div>

        <?php
            // display offers
            $offerQuery ="SELECT * from tbl_offers";
            $offerResult = mysqli_query($connection, $offerQuery);
            $offerCount = mysqli_num_rows($offerResult);

            echo "<section id='offerCardSection'>"; // open parent tag

            if ($offerCount == null) 
            {
                echo "offers not found";
                echo '
                    <div class="offerCard">
                        <h3>No Offers At The Moment</h3>
                    </div>              
                ';
            }
            else
            {
                while ($offerRow = $offerResult->fetch_assoc()) {
                    echo '
                    <div class="offerCard">
                        <h3>' . $offerRow['offer_title'] . '</h3>
                        <p>' . $offerRow['offer_dec'] . '</h3>
                    </div>              
                    ';
                }
                echo "</section>"; // close parent tag

            }//end if      
        ?>
        
        <div class="breakPoint"></div>
        
        <!-- title  -->
        <h2 class="h2Title">Discover UCLan</h2>

        <!-- section 1 - displays mp4 and text taken from the following page https://www.uclan.ac.uk/open-days -->
        <section id="homeSection1">
            <!-- alternative text (title) in case it doesn't load - ACCESSIBILITY -->
            <div class="homeSection1VideoContainer ">
                <iframe id="welcomeVideoMp4" width="40" height="320" allowfullscreen title="Video About UCLan"
                    src= 'images/video/video.mp4'>
                </iframe>
            </div>
            
            <div id="homeSection1Text">
                <!-- use of headings - ACCESSIBILITY -->
                <h2>Discover your passion</h2>
                <h3>Attend an open day </h3>
                <p>An Open Day gives you the chance to visit a campus in person. You can get a feel for the place and meet current students and staff. 
                    It's the perfect way to get a taste of university life.
                    <br>
                    <a href="https://www.uclan.ac.uk/open-days" target="_blank" >Register now</a>
                </p>
            </div>
        </section>

        <div class="breakPoint"></div>

        <!-- section 2 - displays youTube video and a brief description, taken from the videos description -->
        <section id="homeSection2">
            <!-- use of headings - ACCESSIBILITY -->
            <div id="homeSection2Text">
                <h2>About Preston</h2>
                <h3>Discover your new home</h3>
                <p>Hidden gems, the natural beauty of the great outdoors, vibrant nightlife and foodie culture. 
                    Whatever you’re looking for, it’s all waiting for you here in Preston.
                    <br>
                    <a href="https://www.uclan.ac.uk/campuses/preston" target="_blank" >Find Out More</a>
                </p>
            </div>

            <div class="homeSection2VideoContainer ">
                <!-- alternative text (title) in case it doesn't load - ACCESSIBILITY -->
                <iframe id="welcomeVideoYT" width="70" height="320" allowfullscreen title="About Preston Campus"
                    src="https://youtube.com/embed/EI_lco-qdw8">
                </iframe>
            </div>
        </section>

        <div class="breakPoint"></div>

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