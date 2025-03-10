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

<body>

<!-- https://www.w3schools.com/howto/howto_css_login_form.asp -->


    <h1>Register Now</h1>

    <form id="registerForm" action="registerActionPage.php" method="post" onsubmit="return checkPasswords()">

        <section id="registerSection" class="container">
            <p>Enter your details below:</p>
            
            <p><label>Full Name:</label>
            <input type="text" name="fullName" required></p>

            <p><label>Email:</label>
            <input type="text" name="email" required></p>

            <p><label>Address:</label>
            <input type="text" name="address" required></p>
            
            <p><label>Password:</label>
            <input type='password' name="password" required></p>

            <p><label>Confirm Password:</label>
            <input type='password' name="confirmPassword" required></p>
            
            <p><input type="submit" name="Sign Up"></p>

        </section>
    </form>

    <script>

        function checkPasswords()
        {
            var passwordData = document.forms["registerForm"]["password"].value;
            var confirmPasswordData = document.forms["registerForm"]["confirmPassword"].value;

            if (passwordData != confirmPasswordData) // if passwords don't match, display error and return false;
            {
                alert("Passwords must match!");
                return false;
            }
            else // if password and confirm password match, return true
            {
                return true;
            }


        }

    </script>

</body>


</html>