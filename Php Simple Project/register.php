<?php
    require 'dbconfig/config.php';


?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color:#757575">

    <div id="main-wrapper">
        <center><h2>Sign Up Form</h2></center>
        <center><img src="img/ava.png" class="avatar"/></center>

    <form class="myform" action="register.php" method="post">
        <label><b>Username</b></label><br >
        <input name="username" type="text" class="inputvalues" placeholder="Enter username" required/><br >
        
        <label><b>Password</b></label><br >
        <input name="password" type="password" class="inputvalues" placeholder="Enter password" required/><br >
        
        <label><b>Confirm Password</b></label><br >
        <input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required/><br >
        
        <input name="submit_button" type="submit" id="signup_button" value="Sign Up"/><br >
        <a href="index.php"> <input type="button" id="back_button" value="<<Back"/></a>

    </form>
        <?php
            if(isset($_POST['submit_button']))
            {
                 //echo'<script type="text/javascript"> alert("Works")</script>';

                $username=$_POST['username'];
                $password=$_POST['password'];
                $cpassword=$_POST['cpassword'];

                if($password==$cpassword)
                {
                    $query="select * from user  WHERE Username='$username'";
                    $query_run=mysqli_query($con,$query);

                    if(mysqli_num_rows($query_run)>=1)
                    {
                        echo'<script type="text/javascript"> alert("Username already exists")</script>';

                    }
                    else
                    {
                        $query="insert into  `user` (`Username`, `Password`) values('$username','$password')";
                         $query_run=mysqli_query($con,$query);

                         if($query_run)
                         {

                          echo'<script type="text/javascript"> alert("User register. Go to login page")</script>';

                         }
                         else
                         {
                                echo'<script type="text/javascript"> alert("Error!")</script>';
                         }
                    }

                 }

            }
        ?>
    </div>

</body>
</html>

