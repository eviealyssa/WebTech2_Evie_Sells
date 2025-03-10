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

    <?php
    // opens php session
        session_start();
    ?>


    <h1>INDEX</h1>
    <p>Hello <?php echo $_SESSION["name"];?> <p>

    <!-- <form id="login" action="action_page.php" method="post">

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
            <span class="password">Forgot <a href="register.php">password?</a></span>
            <span class="register">Not got an account? <a href="#">Register Now</a></span>
        </section>
        
    </form> -->

</body>


</html>