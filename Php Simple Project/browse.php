<?php
error_reporting(E_ALL ^ E_NOTICE);
//index.php
 require 'dbconfig/config.php';
 //$query="SELECT * FROM booking";
 //$result=mysqli_query($con,$query);
 session_start();
                if(isset($_GET['page']))
                {
                    $page=$_GET['page'];
                }
                else
                {
                    $page=1;
                }
                $num_per_page=04;
                $start_from=($page-1)*04;

                $sqll="SELECT * FROM file limit $start_from,$num_per_page";
                $resultt=$con->query($sqll);


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

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/browse_25.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
      $(function () {

      $("#slider-range").slider({

      range: true,
      min: 0,
      max: 120,
          values: [0, 120],
      step:10,
      slide: function( event, ui ) {
          $("#amount").val(ui.values[0] + " - " + ui.values[1]);
          $("#minimum").val( ui.values[0]);
          $("#maximum").val(+ui.values[1]);

          }

    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
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
                <h3 class="uText">Hi <?php   echo$_SESSION['username']  ?>,<br /> am poza misto pt tine!</h3>
            </div>
            <div class="image_user">
                <img src="img/ava.png" class="avabro"/>
            </div>
        </div>
        <div class="buttons_container">
            <form class="myform" action="browse.php" method="post">
                        <input name="back_button" type="submit" id="back_button" value="Back"/>

        <!-- <a href="booking.php"><input name="booking_button" type="button" id="booking_button" value="Show bookings"/></a> -->

    </form>
        <?php
        if(isset($_POST['back_button']))
        {

        header('location:homepage.php');
        }

        // if(isset($_POST['booking_button']))
        // {
        //  $_SESSION['username']=$username;
        //     header('location:booking.php');
        // }
        ?>
        </div>
    </div>
    <div class="conttt">
        <div class=" filter_column">
            <center><p id="text"><b>  Side</b></p></center>

            <!--//PRICE////////////////////////////////////////////-->
            <div class="list-group filterSide">
                <input type="hidden" id="minimum" value="0" />
                <input type="hidden" id="maximum" value="120" />

                <p>
                  <label class="leftMargin" for="amount">Pentru ca marimea conteaza:</label>

                  <input type="text" class="shiftItem" id="amount" readonly style="border:0; color:#00ACC1;  font-weight:bold;">
                </p>

                <div id="slider-range">
                    <div id="custom-handle" class="ui-slider-handle product_check"></div>
                    <div id="custom-handle" class="ui-slider-handle product_check"></div>

                </div>


            </div>
            <!--/////////////////////////////////////////////////-->

            <div class="list-group filterSide">
                <h5 class="leftMargin">Nume pozik</h5>
                <?php
                $sql="SELECT DISTINCT title FROM file ORDER BY title";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>

                <div class="list-group-item shiftItem">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input product_check" value="<?= $row['title'];?>" id="title" />
                            <?= $row['title'];?>
                        </label>
                    </div>

                </div>
                  <?php } ?>


            </div>
            <!--/////////////////////////////////////////////////-->


            <div class="list-group filterSide">
                <h5 class="leftMargin">Format</h5>
                <?php
                $sql="SELECT DISTINCT format FROM file ORDER BY format";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){
                ?>

                <div class="list-group-item  shiftItem">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input product_check" value="<?= $row['format'];?>" id="format" />
                            <?= $row['format'];?>
                        </label>
                    </div>

                </div>
                  <?php } ?>


            </div>
            <!--/////////////////////////////////////////////////-->


        </div>
        <div class="menu_columnX col-lg-9">
            <center> <p id="text"><b>Pozici Menu</b></p> </center>

            <div class="filter_data" id="result">
                <div class="menu_buttons">
                 <?php

                $pr_query="SELECT * FROM file";
                $pr_result=$con->query($pr_query);
                $total_record=mysqli_num_rows($pr_result);
                //echo $total_record;

                $total_page=ceil($total_record/$num_per_page);
                //echo $total_page;
                if($page>1)
                {
                echo"<div class='butt_pag'><a href='browse.php?page=".($page-1)." class='butt_pag''> Prev</a></div>";
                }

                for($i=1;$i<$total_page;$i++)
                {
                    $i=(int)$i;
                    echo"<div class='butt_pag'><a href='browse.php?page=".$i." '> $i</a></div>";
                }

                if($i>$page)
                {
                    $varrr=(int)($page+1);
                echo"<div class='butt_pag'><a href='browse.php?page=".($varrr)." class='btn btn-danger''> Next</a></div>";
                }

                ?>
            </div>
                <?php




                while($row=$resultt->fetch_assoc()){
                ?>

                <div   class="cell">

                      <p  align="center"> <strong> <a href="#" class="cellTitle"><?= $row['title'] ?></a></strong></p>
                      <div class="cell-content">
                          <p class="product_text">
                          Size : <?=$row['size']?>  <br/>
                          Format : <?=$row['format']?><br/>
                          Link : <?=$row['path']?><br/>
                          Genre : <?=$row['genre']?><br/>
                          </p>

                          <div class="div-book">
                              <p id="demo"></p>
                               <div class="button-position">
                                        <form  method="post">
                                          <input class="selectedElem" type="button"  name=" <?php echo$_SESSION['username'] ?>"  value="Sterge-o Now"  id="<?php echo $row['title']  ?> " class="btn btn-info btn-xs view_data"/>

                                        </form>

                               </div>
                          </div>

                    </div>
                </div>
                <?php


              }

                ?>

                <?php
                if(array_key_exists('stergereMethod',$_POST)){
                  //stergere();
                }
                function stergere($title){

                  echo $title;
                  alert($title);
                }
                {
                  // code...
                }
                 ?>



            </div>


        </div>
    </div>
<?php
$username=$_SESSION['username'];
 ?>
    <!--////////////////// MODAL ///////////////////////-->
    <script type="text/javascript">
      $(document).ready(function () {
        $(".selectedElem").click(function () {
          //alert( $(this).attr("id"));
          let delete_rez = $(this).attr("id");
          var actionn = 'data';
          var user = $(this).attr("name");
          // alert(user);
          // alert(delete_rez);
          $.ajax({
              url: 'delete.php',
              method: 'POST',
              data: { actionn:actionn, delete_rez: delete_rez},
              success: function (response) {

                  $("#result").html(response);


              }
          });
        });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {



            $(".product_check").click(function () {

                var action = 'data';
                var title = get_filter_text('title');
                var format = get_filter_text('format');
                var minimum = $('#minimum').val();
                var maximum = $('#maximum').val();
                var start_from = $('#start_from').val();
                var num_per_page = $('#num_per_page').val();

                //window.alert(minimum);
                //window.alert(maximum);
                $.ajax({
                    url: 'action.php',
                    method: 'POST',
                    data: { action: action, title: title, format:format, minimum:minimum, maximum:maximum, start_from:start_from, num_per_page:num_per_page },
                    success: function (response) {
                        $("#result").html(response);
                        $("#loader").hide();
                    }
                });

            });

            function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function () {
                  // alert($(this).val());
                    filterData.push($(this).val());
                });
                return filterData;
            }

            //function myFunction(){
            //    document.getElementById("demo").innerHTML = "Hello World";
            //    document.querySelector(".background-modal").style.display = "flex";
            //}

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

<!--<div class="background-modal">
        <div class="modal-content">
            <div class="close"><h3 class="close-text"><button class="butt_css" onclick="mFunction()"> <p class="exit_butt">+ </p></button></h3></div>

            <div class="mod_content">
                <div class="mod_id_box">
                     <div class="roomid_text">The ID of the selected room is:</div>
                    <div id="roomid_modal">

                    </div>
                </div>
            </div>

        </div>
</div>-->
<div id="dataModal" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Booking Details</h4>
                </div>
                <div class="modal-body" id="employee_detail">
                    <div class="bodyM">
                            <div class="roomid_text"> <?php   echo$_SESSION['username']  ?>, the ID of the selected room is:</div>
                            <div id="roomid"></div>
                        </div>
                    <form action="browse.php" class="date-modal" method="post">
                        <input name="roomid" type="hidden" id="hiddenID" value="0" />
                        <div><input name="check-in" type="text" id="check-in" placeholder="check-in" /></div>
                        <div><input name="check-out" type="text" id="check-out" placeholder="check-out" /></div>
                        <div ><input name="buy_button" class="buy_button" type="submit" id="submit" value="Buy" /></div>
                    </form>
                    <?php

                    if(isset($_POST['buy_button']))
                    {
                    $username=$_SESSION['username'];
                    $roomid=$_POST['roomid'];
                    $check_in=$_POST['check-in'];
                    $check_out=$_POST['check-out'];
                    $query="INSERT INTO rez VALUES('$username','$roomid','$check_in','$check_out')";
                    $query_run=mysqli_query($con,$query);
                    if($query_run)
                         {

                          echo'<script type="text/javascript"> alert("Your booking was received!")</script>';

                         }
                         else
                         {
                                echo'<script type="text/javascript"> alert("Error!")</script>';
                         }
                    }
                    ?>

                    </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
           </div>
      </div>
 </div>
<script>
    $(document).ready(function () {
        $(".view_data").click(function () {
            var room_id = $(this).attr("id");
            //var user = echo$_SESSION['username'];
            $("#hiddenID").val(room_id);
            //$('#dataModal').modal("show");
            $('#roomid').html(room_id);

            var minDate = new Date();
        });
    });
</script>
<script>
        function myFunction() {

            document.querySelector(".background-modal").style.display = "flex";
            var room_id = $(this).attr("id");
            $('#roomid_modal').html(room_id);
        }
    </script>
     <script>
        function mFunction(){

                document.querySelector(".background-modal").style.display = "none";
            }
    </script>
