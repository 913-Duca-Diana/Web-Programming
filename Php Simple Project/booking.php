<?php
        require 'dbconfig/config.php';
        session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Registration Page</title>





      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="css/booking_2.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>
<body>
    <div class="containerr">
        <div class=" head-buttons">
            <div class="head-body">
                <form class="myform" action="booking.php" method="post">
                    <a href="browse.php"><input name="back_button" type="button" id="back_button" value="Back"/></a>
                    <div class="delete">
                        <!--<input class="product " onclick="DeleteFunction" name="delete_button"  type="button" id="delete_button" value="Delete"/>-->
                    </div>
                </form>
                <div class="label"><label> Hi <?php   echo$_SESSION['username']  ?> , press the delete button after checking the booking wanted to be deleted</label></div>
            </div>
        </div>
        <div class="data-body">
            <div class="data">
                <?php
                    $user=$_SESSION['username'];
                $sql="SELECT * FROM rez where username_id='$user'";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>
                <div   class="cell">

                      <div class="cell-content">
                          <p class="product_text">
                          RoomID : <?=$row['room_id']?>  <br/>
                          Check-In : <?=$row['check_in']?><br/>
                          Check-Out : <?=$row['check_out']?><br/>
                          </p>
                          <div class="div-book">
                               <div class="button-position">
                                   <form class="myform" action=" booking.php" method="post">
                                        <input  class="delete_button"  name="delete_button"  type="submit" id="delete_button" value="Delete"/>
                                        <input name="username" type="hidden" id="username" value="<?= $row['username_id']?>" />
                                        <input name="room" type="hidden" id="room" value="<?= $row['room_id']?>" />

                                   </form>
                               </div>
                          </div>

                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
        if(isset($_POST['back_button']))
        {

        header('location:browse.php');
        }?>

<?php

if(isset($_POST['delete_button']))
{
    $username=$_POST['username'];
    $room=$_POST['room'];

    $query="delete from rez where username_id='$username' and room_id='$room'";
    $query_run=mysqli_query($con,$query);

    //if($query_run)
    //{

    //    echo'<script type="text/javascript"> alert("Booking deleted")</script>';

    //}
    //else
    //{
    //    echo'<script type="text/javascript"> alert("Error!")</script>';
    //}


    $output='';
    $query_2="SELECT * FROM rez WHERE username_id='$username'";
    $query_run1=mysqli_query($con,$query_2);
    if(mysqli_num_rows($query_run1)>=0){
            while($row=$result->fetch_assoc()){
                $output.='
                         <div   class="cell">

                      <div class="cell-content">
                          <p class="product_text">
                          RoomID : '.$row['room_id'].' <br/>
                          Check-In : '.$row['check_in'].'<br/>
                          Check-Out : '.$row['check_out'].'<br/>
                          </p>
                          <div class="div-book">
                               <div class="button-position">
                                   <form class="myform" action=" booking.php" method="post">
                                        <input  class="delete_button"  name="delete_button"  type="submit" id="delete_button" value="Delete"/>
                                        <input name="username" type="hidden" id="username" value=" '.$row['username_id'].'" />
                                        <input name="room" type="hidden" id="room" value="'. $row['room_id'].'" />

                                   </form>
                               </div>
                          </div>

                    </div>
                </div>
                         ';

            }
    }
    else
        {
            $output="<h3> No Data Found! </h3>";
        }
         echo $output;
}

?>

<script type="text/javascript">
    window.alert(CCCCCCCCCCCCCCCCCC);
    function DeleteFunction() {
    $(document).ready(function () {
        window.alert(CCCCCCCCCCCCCCCCCC);


            var actionn = 'data';
            var delete_rez = get_filter_text('delete_rez');
            var username = $('#username').val();

            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: { actionn: actionn, delete_rez: delete_rez, username: username },
                success: function (response) {

                    $("#result").html(response);


                }
            });
        });
    };




    function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function () {
                    filterData.push($(this).val());
                });

                return filterData;
    }
</script>
