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
            echo "ERROR: could not connect to database: <br> " . mysqli_connect_error();
        }
        else
        {
            echo "Connected to database. <br>";
        }

        // $query = "SELECT title FROM modules ORDER BY title";
        
        // $result = mysqli_query($connection, $query);
        // $count = mysqli_num_rows($result);

        // echo "Number of modules: $count <br>";

        // echo "<ol>";
        // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        // {

        //     echo "<li>". $row["title"] . "</li>";
        //     echo '<br>';
        // }

        // echo "</ol>";



        // //$query = "SELECT title FROM modules ORDER BY title";
        // $query2 = "SELECT title FROM modules WHERE title='Computer Systems and Security' OR title='Games Concepts' OR title='Programming' OR title='Introduction to Networking'  ORDER BY title";
        
        // $result2 = mysqli_query($connection, $query2);
        // $count2 = mysqli_num_rows($result2);

        // echo "Number of modules: $count2 <br>";

        // echo "<ol>";
        // while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
        // {

        //     echo "<li>". $row2["title"] . "</li>";
        //     echo '<br>';
        // }

        // echo "</ol>";




    ?>

</body>
