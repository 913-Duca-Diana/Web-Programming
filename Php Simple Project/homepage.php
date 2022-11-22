<?php

    session_start();
    require 'dbconfig/config.php';


?>

<!DOCTYPE html>
<html>
<head>
<title> HomePage</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color:#7f8c8d">

    <div id="main-wrapper">
        <center>
            <h2>Home page</h2>
            <h3>Welcome <?php   echo$_SESSION['username']  ?></h3>
        </center>
        <center><img src="img/ava.png" class="avatar"/></center>

    <form class="myform" action="homepage.php" method="post">
        <a href="browse.php"><input name="browse_button" type="button" id="bro_button" value="Browse"/></a><br >
        <input name="logout_button" type="submit" id="logout_button" value="Log Out"/><br >

    </form>
        <?php
        if(isset($_POST['logout_button']))
        {
          // Distrugem sesi ca sa nu accesam pagina dupa log out <3
        session_destroy();
        header('location:index.php');
        }

        if(isset($_POST['browse_button']))
        {
         $_SESSION['username']=$username;
            header('location:browse.php');
        }
        ?>
    </div>

</body>
</html>
