<?php 

//index.php
 require 'dbconfig/config.php';
 
 session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <!--<link rel="stylesheet" href="css/browse_8.css" />-->
    
  

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/browse_13.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
      $(function () {
          
      $("#slider-range").slider({
       
      range: true,
      min: 50,
      max: 500,
          values: [50, 500],
      step:10,
      slide: function( event, ui ) {
          $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
          $("#hidden_minimum_price").val( "$" +ui.values[0]);
          $("#hidden_maximum_price").val("$" +ui.values[1]);
         
          }
          
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
      });

    

  </script>
    <style>
  
  </style>

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
   
    <div class="head_container">
        <div class="user_container">
           <div class="user_text">
                <h2><b>Browsing page</b></h2>
                <h3 class="uText">Hi <?php   echo$_SESSION['username']  ?>,<br /> we have the perfect room for you</h3>
            </div>
            <div class="image_user">
                <img src="img/ava.png" class="avabro"/>
            </div>
        </div>
        <div class="buttons_container">
            <form class="myform" action="browse.php" method="post">
                        <input name="back_button" type="submit" id="back_button" value="Back"/>

        <a href="booking.php"><input name="booking_button" type="button" id="booking_button" value="Show bookings"/></a>

    </form>
        <?php
        if(isset($_POST['back_button']))
        {
        
        header('location:homepage.php');
        }

        if(isset($_POST['booking_button']))
        {
         $_SESSION['username']=$username;
            header('location:booking.php');
        }
        ?>
        </div>
    </div>
    <div class="conttt">
        <div class=" filter_column">
            <center><p id="text"><b> Filter Side</b></p></center>

            <!--//PRICE////////////////////////////////////////////-->
            <div class="list-group filterSide">
                <p>
                  <label class="leftMargin" for="amount">Price range:</label>
                  <input type="text" class="shiftItem" id="amount" readonly style="border:0; color:#00ACC1;  font-weight:bold;">
                </p>
 
                <div id="slider-range">
                    <div id="custom-handle" class="ui-slider-handle"></div>
                    <div id="custom-handle" class="ui-slider-handle"></div>
                    <input type="hidden" id="hidden_minimum_price" value="50" />
                    <input type="hidden" id="hidden_maximum_price" value="500" />
                </div>


            </div>
            <!--/////////////////////////////////////////////////-->

            <div class="list-group filterSide">
                <h5 class="leftMargin">Hotel Name</h5>
                <?php
                $sql="SELECT DISTINCT HotelName FROM booking ORDER BY HotelName";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>
                
                <div class="list-group-item shiftItem">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input product_check" value="<?= $row['HotelName'];?>" id="hotel" />
                            <?= $row['HotelName'];?>
                        </label>
                    </div>
                        
                </div>
                  <?php } ?>
                

            </div>
            <!--/////////////////////////////////////////////////-->


            <div class="list-group filterSide">
                <h5 class="leftMargin">Number of Beds</h5>
                <?php
                $sql="SELECT DISTINCT Rooms FROM booking ORDER BY Rooms";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>
                
                <div class="list-group-item  shiftItem">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input product_check" value="<?= $row['Rooms'];?>" id="beds" />
                            <?= $row['Rooms'];?>
                        </label>
                    </div>
                        
                </div>
                  <?php } ?>
                

            </div>
            <!--/////////////////////////////////////////////////-->

         
        </div>
        <div class="menu_columnX col-lg-9">
            <center> <p id="text"><b>Hotel Menu</b></p> </center>

            <div class="filter_data" id="result">
                <?php
                    
                $sql="SELECT * FROM booking";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>

                <div   class="cell">
                      <img src="img/<?= $row['image'];?>"  class="img-responsive">
                      <p  align="center"> <strong> <a href="#" class="cellTitle"><?= $row['HotelName'] ?></a></strong></p>
                      
                      <p class="product_text">
                      Price : <?=$row['Price']?> Euro <br/>
                      Beds : <?=$row['Rooms']?><br/>
                      RoomNo : <?=$row['RoomNumber']?><br/> 
                      </p>
                      </div>
                <?php }?>
            </div>

            
        </div>
    </div>



    

    <script type="text/javascript">
        $(document).ready(function () {

            $(".product_check").click(function () {
                $("#loader").show();
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'data';
                var hotel = get_filter_text('hotel');
                var beds = get_filter_text('beds');
                var hidden_minimum_price = $("#hidden_minimum_price").val();
                var hidden_maximum_price = $("#hidden_maximum_price").val();
                
                $.ajax({
                    url: 'action.php',
                    method: 'POST',
                    data: { action: action, hotel: hotel, beds:beds, hidden_minimum_price:hidden_minimum_price, hidden_maximum_price:hidden_maximum_price },
                    success: function (response) {
                        $("#result").html(response);
                        $("#loader").hide();
                    }
                });

            });

            function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function () {
                    filterData.push($(this).val());
                });
                return filterData;
            }
            
            
        });

        


    </script>

    



  <style>
#loading
{
    text-align:center;
    background:url("img/caca.gif") no-repeat center;
    height:150px;
}
</style>

</body>

</html>
