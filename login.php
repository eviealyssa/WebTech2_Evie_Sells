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
</head>

<body onload="errorAlert()">

    <!-- sets to null -->
    <?php $_SESSION["errorLogin"] = null;?> 

    <!-- https://www.w3schools.com/howto/howto_css_login_form.asp -->
    <form id="login" action="loginActionPage.php" method="post">

        <div id="loginImage">
        <img id="loginAvatarImg" src="media\other\loginImageAvatar.webp" alt="login avatar" height="80" >
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


    <script>
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