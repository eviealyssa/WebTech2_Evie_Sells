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
     <link rel="stylesheet" href="styling/loginStyle.css" type= "text/css">
</head>

<body>

<!-- https://www.w3schools.com/howto/howto_css_login_form.asp -->
    <form id="login" action="action_page.php" method="post">

        <div id="loginImage">
        <img id="loginAvatarImg" src="media\other\loginImageAvatar.webp" alt="login avatar" height="80" >
        </div>


        <section id="loginSection" class="container">
            <p>Enter your username and password to proceed:</p>
            
            <p><label>Username:</label>
            <input type="text" name="username" required></p>
            
            <p><label>Password:</label>
            <input type='password' name="password" required></p>
            
            <p><input type="submit" name="Log Me In"></p>

            <input type="checkbox" checked="checked" name="remember"> Remember me</label>
        </section>

        <section id="forgotAndRegister" class="container">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="password">Forgot <a href="#">password?</a></span> <!-- ADD IN LINK !!! -->
            <span class="register">Not got an account? <a href="register.php">Register Now</a></span>
        </section>
        
    </form>

</body>


</html>