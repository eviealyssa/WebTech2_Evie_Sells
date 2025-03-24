<!doctype html>
<html lang="en">
<head>
    <!-- <link rel="stylesheet" href="style.css" type="text/css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>An Introduction to PHP</title>
  <meta name="description" content="Web Technologies Activity Introducing PHP server-side scripting language">
  <meta name="author" content="Joe Bloggs">
  <meta property="og:title" content="An Introduction to PHP">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Web Technologies Activity Introducing PHP server-side scripting language"> -->


</head>

<body>

    <?php 
        // hostname, username, passwor, datbase name
        $connection = mysqli_connect("localhost", "easells", "st4QR5wdvQ", "easells");

        if (mysqli_connect_errno())
        {
            echo "<script> alert(ERROR: could not connect to database." . mysqli_connect_error().")</script>";
        }
    ?>

</body>
