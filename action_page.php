<!doctype html>
<html>
<head>
    <!-- link to the stylesheets -->
    <!-- <link rel="stylesheet" href="styling/style.css" type= "text/css"> -->
<link rel="stylesheet" href="styling/headFootStyle.css" type= "text/css">    

    <!-- setting up project -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evie Sells - UCLan Shop</title>
</head>

<body>

    <p>Hello <?php echo $_POST['username'];?> <p>

    <!-- check to see if password = password -->
    <?php
        if ($_POST['password'] == "password")
        {
            echo '<p>The password is not secure</p>';
        }
        

        // get value of radio button and set as background
        // if($_POST['colour'] == "red")
        // {
        //     echo'<body style="background-color: red">';
        // }
        // else if ($_POST['colour'] == "green")
        // {
        //     echo'<body style="background-color: green">';
        // }
        // else{
        //     echo'<body style="background-color: blue">';
        // }
       
    ?>

    

</body>
</html>