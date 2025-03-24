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
     <link rel="stylesheet" href="styling\loginRegisterStyle.css" type= "text/css">
     <link rel="stylesheet" href="styling\headFootStyle.css" type= "text/css">

</head>

<body onload="errorAlert()">
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
                    <li><a href="index.html" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.html" target="_self" class="navLinks">Products</a></li>
                </ul>
            </div>

            <!-- login menu icon for desktop / tablet -->
            <a href="login.php" class="splitNav loginNavIcon"><img src="images\other\login sybol nav.png" alt="Login" height="50"></a>

            <!-- cart menu icon for desktop / tablet -->
            <a href="cart.html" class="splitNav cartNavIcon"><img src="images\other\shopping-cart-image.svg" alt="Cart" height="50"></a>

            <!-- adding in hamburg menu icon for mobile users -->
            <a class="mobileMenuIcon splitNav" onclick="toggleHamburgerNav()"><img src="images\other\hamburger-menu-icon.svg" alt="Menu" height="50"></a>

            <!-- mobile navigation links -->
            <div id="mobileNavSection">
                <ul class="mobileNavLinksList">
                    <li><a href="index.html" target="_self" class="navLinks">Home</a></li>
                    <li><a href="products.html" target="_self" class="navLinks">Products</a></li>
                    <li><a href="cart.html" target="_self" class="navLinks">Cart</a></li> 
                    <li><a href="login.php" target="_self" class="navLinks activePage">Login</a></li> 
                </ul>
            </div> 

        </nav>
    </header>

    <!-- sets to null -->
    <?php $_SESSION["errorLogin"] = null;?> 

    <!-- https://www.w3schools.com/howto/howto_css_login_form.asp -->
    <form id="login" action="loginActionPage.php" method="post">

        <div id="loginImage">
        <img id="loginAvatarImg" src="images\other\loginImageAvatar.webp" alt="login avatar" height="80" >
        </div>


        <section id="loginSection" class="container">
            <p>Enter your username and password to proceed:</p>
            
            <p><label>Username:</label>
            <input type="text" name="username" autocomplete="on" required></p>
            
            <p><label>Password:</label>
            <input type='password' name="password" autocomplete="on" required></p>
            
            <p><input type="submit" name="Log Me In"></p>

            <input type="checkbox" checked="checked" name="remember"> Remember me</label> <!-- MIGHT GET RID OFF !!! -->
        </section>

        <section id="forgotAndRegister" class="container">
            <button type="button" class="cancelbtn">Cancel</button>
            <!-- https://stackoverflow.com/questions/57915180/can-a-span-be-made-into-a-clickable-link -->
            <span class="password">Forgot <a href="#">password?</a></span> <!-- ADD IN LINK !!! -->
            <span class="register">Not got an account? <a href="register.php">Register Now</a></span>
        </section>
        
    </form>

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

        // determines if/what alert is displayed, based on the value of $_SESSION["errorLogin"]
        function errorAlert()
        {
            <?php
                session_start();
                if ($_SESSION["errorLogin"] != null || $_SESSION["errorLogin"] != "")
                {
                    if ($_SESSION["errorLogin"] == "UserNotFound")
                    {
                        // https://www.geeksforgeeks.org/how-to-pop-an-alert-message-box-using-php/
                        echo 'alert("User Not Found");'; 
                    }
                    else
                    {
                        // https://www.geeksforgeeks.org/how-to-pop-an-alert-message-box-using-php/
                        echo 'alert("Incorrect Password");';
                    }
                }
            ?>
        }
    </script>
</body>


</html>