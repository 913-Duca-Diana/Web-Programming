<?php
    require 'dbconfig/config.php';



                //$resultt=$con->query($sqll);

    if(isset($_POST['action'])){


        $sql="SELECT * FROM file Where title!=''";
        $sql_limit="SELECT * FROM file  Where title!=''  ";
        if(isset($_POST['minimum'] , $_POST['maximum']) && !empty($_POST['minimum']) && !empty($_POST['maximum']) ){
            $sql.=" AND size BETWEEN '".$_POST['minimum']."' AND '".$_POST['maximum']."'";
            $sql_limit.=" AND size BETWEEN '".$_POST['minimum']."' AND '".$_POST['maximum']."'";
            // echo $_POST['minimum'];
            // echo $_POST['maximum'];

        }
        //echo'<script type="text/javascript"> alert("'.$_POST['title'].'")</script>';

        if(isset($_POST['title'])){
          //echo'<script type="text/javascript"> alert("'.$_POST['title'].'")</script>';
            $title=implode("','",$_POST['title']);
            $sql .="AND title IN('".$title."')";
            $sql_limit .="AND title IN('".$title."')";
        }

        if(isset($_POST['format'])){
            $format=implode("','",$_POST['format']);
            $sql .="AND format IN('".$format."')";
            $sql_limit .="AND format IN('".$format."')";
        }

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
        $sql_limit.=" limit $start_from,$num_per_page";
        $output='';
        $result=$con->query($sql);
        $total_record=mysqli_num_rows($result);

        $total_page=ceil($total_record/$num_per_page);
                //echo $total_page;
                if($total_page>0){

                 $output.="<div class='menu_buttons'>";
                if($page>1)
                 {
                        $output.="<div class='butt_pag'><a href='browse.php?page=".($page-1)." class='butt_pag''> Prev</a></div>";
                 }

                        for($i=1;$i<$total_page;$i++)
                        {
                            $i=(int)$i;
                            $output.="<div class='butt_pag'><a href='browse.php?page=".$i." '> $i</a></div>";
                        }

                        if($i>$page)
                        {
                            $varrr=(int)($page+1);
                        $output.="<div class='butt_pag'><a href='browse.php?page=".($varrr)." class='btn btn-danger''> Next</a></div>";
                        }
                        $output.="</div>";
                }


        $result_limit=$con->query($sql_limit);
        $total_record_limit=mysqli_num_rows($result_limit);
        if($total_record>0){
            while($row=$result_limit->fetch_assoc()){
                $output .='<div   class="cell">
                      <p align="center"> <strong> <a href="#" class="cellTitle">'. $row['title'] .'</a></strong></p>
                       <div class="cell-content">
                      <p class="product_text">
                      Title : '.$row['title'].' <br/>
                      Format : '.$row['format'].'<br/>
                      size : '.$row['size'].'<br/>
                      </p>
                          </div>
                      </div>';
            }
        }
        else
        {
            $output="<h3> No Data Found! </h3>";
        }

        echo $output;
    }

?>
<script>
    $(document).ready(function () {
        $(".view_data").click(function () {
            var room_id = $(this).attr("id");
            //var user = echo$_SESSION['username'];
            $('#dataModal').modal("show");
            $('#roomid').html(room_id);
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
