<?php
    session_start();
    require 'dbconfig/config.php';


?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color:#7f8c8d">

    <div id="main-wrapper">
        <center><h2>Login Form</h2></center>
        <center><img src="img/ava.png" class="avatar"/></center>

    <form class="myform" action="index.php" method="post">
        <label><b>Username</b></label><br >
        <input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br >
        <label><b>Password</b></label><br >
        <input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br >
        <input name="submit_button" type="submit" id="login_button" value="Login"/><br >
        <a href="register.php"><input type="button" id="register_button" value="Register"/></a>

    </form>
    <?php
    
        if(isset($_POST['submit_button']))
        {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $query="select * from user WHERE username='$username' AND password='$password'";
        $query_run=mysqli_query($con,$query);

        if(mysqli_num_rows($query_run)>0)
        {
            //echo'<script type="text/javascript"> alert("User identified")</script>';
            $_SESSION['username']=$username;
            header('location:homepage.php');
        }
        else
        {
            echo'<script type="text/javascript"> alert("Username or password are incorrect")</script>';
        
        }
        }
    ?>

    </div>

</body>
</html>

