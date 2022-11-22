<?php
   require 'dbconfig/config.php';
   session_start();
   $user = $_SESSION['username'];

   if(isset($_POST['actionn'])){

    $sql_del="DELETE FROM file WHERE ";

        if(isset($_POST['delete_rez'])){

        $del=$_POST['delete_rez'];
        echo'<script type="text/javascript"> alert("'.$del.'")</script>';
        $sql_del .="title ='$del'";
        }

        $result1=$con->query($sql_del);
        $output='';
        $sql="SELECT * FROM file Where username='".$user."' ";
        $result=$con->query($sql);

            echo'<script type="text/javascript"> alert("Your file was deleted!")</script>';
        }
        else
        {
            $output="<h3> No Data Found! </h3>";
        }
         echo $output;


?>
