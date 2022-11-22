<?php
        require 'dbconfig/config.php';

        if(isset($_POST['room_id']))
        {
            $output='caca';
            //$caca=$_POST['caca'];
            $query="SELECT * FROM booking WHERE RoomID=' ".$_POST['room_id']." ' ";
            $result=$con->query($query);
            $row=$result->fetch_assoc();
            $output.='
             <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = $result->fetch_assoc())  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row["HotelName"].'</td>  
                </tr>  
               
                <tr>  
                     <td width="30%"><label>Price</label></td>  
                     <td width="70%">'.$row["Price"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>ID</label></td>  
                     <td width="70%">'.$row["RoomID"].'</td>  
                </tr>  
                  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
        }
        //echo $output;
?>      