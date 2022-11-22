<?php

$con =mysqli_connect("localhost","root","") or die("Unable to connect");
mysqli_select_db($con,"hotel");

$connect = new PDO("mysql:host=localhost;dbname=hotel", "root", "");

?>
